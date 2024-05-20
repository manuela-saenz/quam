// Función para obtener el valor de un parámetro de la URL
function getQueryParam(param) {
    var params = new URLSearchParams(window.location.search);
    return params.get(param);
}

// Función para actualizar los selects según la categoría seleccionada
function updateSelectsForCategory(selectedValue, resetSelects = false) {
    categoryContents.forEach(function(content) {
        if (content.dataset.currentCat === selectedValue) {
            content.style.display = "block";
            var attributeDivs = content.querySelectorAll('div[data-options]');
            attributeDivs.forEach(function(attributeDiv) {
                var selectElement = attributeDiv.querySelector('select');
                var options = JSON.parse(attributeDiv.dataset.options);
                var attributeName = attributeDiv.dataset.name.toLowerCase();

                // Limpiar las opciones anteriores del select
                selectElement.innerHTML = `<option value="" disabled selected>Selecciona ${attributeName}</option>`;

                for (var key in options) {
                    if (options.hasOwnProperty(key)) {
                        var option = document.createElement("option");
                        option.value = options[key];
                        option.textContent = options[key];
                        selectElement.appendChild(option);
                    }
                }

                if (!resetSelects) {
                    // Marcar la opción seleccionada basada en el parámetro de la URL
                    var queryValue = getQueryParam(`filter_${attributeName}`);
                    if (queryValue) {
                        selectElement.value = queryValue;
                    }
                }
            });
        } else {
            content.style.display = "none";
        }
    });
}

// Función para actualizar la URL cuando se envía el formulario
function updateURL(event) {
    event.preventDefault();
    var selectedCategory = selectElement.value || document.querySelector("#category-filter option[selected]").value;
    selectedCategory = selectedCategory.replace(/ñ/g, 'n'); // Reemplazar 'ñ' por 'n'

    var params = new URLSearchParams();
    var nuevoFiltroSelects = document.querySelectorAll('#container-filters select');

    // Obtener los valores seleccionados en los nuevos filtros
    nuevoFiltroSelects.forEach(function(select) {
        var dataName = select.getAttribute('data-name').toLowerCase();
        var selectedOption = select.value;
        if (selectedOption) {
            params.append(`filter_${dataName}`, selectedOption);
        }
    });

    // Añadir valores de los campos de precio a los parámetros si han sido modificados
    var minPriceInput = document.getElementById("min_price");
    var maxPriceInput = document.getElementById("max_price");
    var minPrice = minPriceInput.value.replace(/[^\d]/g, ''); // Remover símbolos y dejar números
    var maxPrice = maxPriceInput.value.replace(/[^\d]/g, ''); // Remover símbolos y dejar números

    if (minPriceInput.value) {
        params.append("min_price", minPrice);
    }
    if (maxPriceInput.value) {
        params.append("max_price", maxPrice);
    }

    var currentURL = window.location.href.split('/categoria-producto/')[0];
    var newURL = `${currentURL}/categoria-producto/${selectedCategory}/?${params.toString()}`;
    window.location.href = newURL;
}

// Nuevo filtro
document.addEventListener("DOMContentLoaded", function() {
    var categoriesContainer = document.getElementById("categories-container");
    var dataOptions = {};

    // Recorrer todos los divs con el atributo data-current-cat
    var categoryDivs = categoriesContainer.querySelectorAll("div[data-current-cat]");
    categoryDivs.forEach(function(categoryDiv) {
        var category = categoryDiv.getAttribute("data-current-cat");
        dataOptions[category] = {};

        // Recorrer todos los divs con el atributo data-name dentro del div de la categoría
        var attributeDivs = categoryDiv.querySelectorAll("div[data-name]");
        attributeDivs.forEach(function(attributeDiv) {
            var name = attributeDiv.getAttribute("data-name");
            var options = JSON.parse(attributeDiv.getAttribute("data-options"));
            dataOptions[category][name] = options;
        });
    });

    // Manejar el evento onchange del select
    const categoria = document.getElementById('category-filter');
    const contenedorFiltros = document.getElementById('container-filters');

    categoria.addEventListener('change', () => {
        const categoriaSeleccionada = categoria.value;
        const datosCategoria = dataOptions[categoriaSeleccionada];

        // Limpiar el contenido del contenedor de filtros
        contenedorFiltros.innerHTML = '';

        // Crear select para cada tipo de filtro y agregar opciones
        for (let tipoFiltro in datosCategoria) {
            if (datosCategoria.hasOwnProperty(tipoFiltro)) {
                const filtroDiv = document.createElement('div');
                filtroDiv.classList.add('cont-select-box', 'position-relative', 'd-flex', 'align-items-center');

                const label = document.createElement('label');
                label.textContent = `${tipoFiltro}:`;

                const select = document.createElement('select');
                select.classList.add('select-box', 'input-box', 'p-1');
                select.setAttribute('data-name', tipoFiltro);

                const opciones = datosCategoria[tipoFiltro];

                // Agregar la opción "Selecciona una opción" como primer elemento en el select
                const optionPlaceholder = document.createElement('option');
                optionPlaceholder.setAttribute('value', '');
                optionPlaceholder.setAttribute('disabled', 'disabled');
                optionPlaceholder.setAttribute('selected', 'selected');
                optionPlaceholder.textContent = `Selecciona ${tipoFiltro}`;
                select.appendChild(optionPlaceholder);

                for (let clave in opciones) {
                    if (opciones.hasOwnProperty(clave)) {
                        const opcion = opciones[clave];
                        const optionElement = document.createElement('option');
                        optionElement.setAttribute('value', opcion);
                        optionElement.textContent = opcion;
                        select.appendChild(optionElement);
                    }
                }

                // Crear el div de flecha
                const flechaDiv = document.createElement('div');
                flechaDiv.classList.add('cont-flecha');

                const flechaLabel = document.createElement('label');
                flechaLabel.setAttribute('for', 'color-filter');

                const arrowDiv = document.createElement('div');
                arrowDiv.classList.add('arrow');

                flechaLabel.appendChild(arrowDiv);
                flechaDiv.appendChild(flechaLabel);

                filtroDiv.appendChild(label);
                filtroDiv.appendChild(select);
                filtroDiv.appendChild(flechaDiv);
                contenedorFiltros.appendChild(filtroDiv);
            }
        }
    });

    // Simular el evento onchange para cargar los datos de la categoría inicialmente seleccionada
    categoria.dispatchEvent(new Event('change'));
});

// Actualizar selects en la carga inicial de la página
var selectElement = document.getElementById("category-filter");
var form = document.getElementById("filterForm");
var categoryContents = document.querySelectorAll(".category-content");

var initialSelectedValue = selectElement.value || document.querySelector("#category-filter option[selected]").value;
updateSelectsForCategory(initialSelectedValue);

// Actualizar selects cuando cambia la categoría seleccionada
selectElement.addEventListener("change", function() {
    var selectedValue = selectElement.value;
    updateSelectsForCategory(selectedValue, true); // Reset selects to default options
});

// Manejar el submit del formulario
form.addEventListener("submit", updateURL);
