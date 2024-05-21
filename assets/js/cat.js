// Función para obtener el valor de un parámetro de la URL

$('#cat-selector').on('change', function () {
    var cat_attr = $('#categories-attributes-full [data-cat-name="' + $(this).val() + '"] div').attr('data-attributes');
    var cat_max = $('#categories-attributes-full [data-cat-name="' + $(this).val() + '"] div').attr('data-max-price');
    var cat_min = $('#categories-attributes-full [data-cat-name="' + $(this).val() + '"] div').attr('data-min-price');

    $('#cat-attributes').empty();
    $('#cat-attributes').html(filterSelects(JSON.parse(cat_attr)));
    $('#cat-attributes').next('.cont-select-box').find('#max_price').attr('placeholder', "Max: " + cat_max + "");
    $('#cat-attributes').next('.cont-select-box').find('#min_price').attr('placeholder', "Min: " + cat_min + "");
    // filterSelects(JSON.parse(cat_attr))
})

$('#filterForm select').on('change', function (e) {
    updateURL()
})
function filterSelects(attributes) {
    var html = '';
    $.each(attributes, function (attributeName, options) {
        html += '<div class="cont-select-box">';
        html += '<label>' + attributeName + '</label>';
        html += '<div class="select-box input-box">';
        html += '<select class="w-100" data-name="' + attributeName.toLowerCase() + '">';
        html += '<option selected value=""> Selecciona ' + attributeName + ' </option>';
        $.each(options, function (optionValue, optionText) {
            html += '<option value="' + optionValue + '">' + optionText + '</option>';
        });
        html += '</select>';
        html += '</div>';
        html += '</div>';
    });
    return html;
}


function getQueryParam(param) {
    var params = new URLSearchParams(window.location.search);
    return params.get(param);
}

// Función para actualizar la URL cuando se envía el formulario
function updateURL(event) {
    if (event) {
        event.preventDefault();
    }
    var selectedCategory = selectElement.value || $('#cat-selector').val()

    var params = new URLSearchParams();
    var nuevoFiltroSelects = document.querySelectorAll('#cat-attributes select');

    // Obtener los valores seleccionados en los nuevos filtros
    nuevoFiltroSelects.forEach(function (select) {
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
    if (event) {
        window.location.href = newURL;
    }

}
function getQueryParams(url) {
    let params = {};
    let parser = document.createElement('a');
    parser.href = url;
    let query = parser.search.substring(1);
    let vars = query.split('&');
    for (let i = 0; i < vars.length; i++) {
        let pair = vars[i].split('=');
        params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
    }
    return params;
}
$(window).on('load', function () {
    var params = getQueryParams(window.location.href);
    for (var param in params) {
        $("select[data-name='" + param.replace('filter_', '') + "']").val(params[param]);
    }
    $('#min_price').val(params.min_price)
    $('#max_price').val(params.max_price)
})

// Actualizar selects en la carga inicial de la página
var selectElement = document.getElementById("cat-selector");
var form = document.getElementById("filterForm");

// Manejar el submit del formulario
form.addEventListener("submit", updateURL);


// precios filtro
function formatCurrency(input) {
    // Eliminar todos los caracteres que no sean dígitos
    var value = input.value.replace(/\D/g, "");

    // Si el valor es vacío, retornar
    if (!value) return;

    // Formatear como número con separadores de miles
    var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Agregar símbolo de dólar
    formattedValue = "$" + formattedValue;

    // Asignar el valor formateado de nuevo al campo de entrada
    input.value = formattedValue;
}

function clearCurrencyFormat(input) {
    // Eliminar símbolo de dólar y puntos
    var value = input.value.replace(/[$.]/g, "");

    // Si el valor es vacío, mostrar el placeholder
    if (!value) {
        input.value = "";
        input.placeholder = input.getAttribute("placeholder");
        return;
    }

    // Asignar el valor sin formato de nuevo al campo de entrada
    input.value = value;
}

function updateValue(input) {
    // Formatear el valor cuando el usuario sale del campo
    formatCurrency(input);
}

// obtener los filtros aplicados

window.addEventListener("scroll", function () {
    var scrollPosition = window.scrollY;
    var formContainer = document.querySelector(".cont-form-responsive");

    if (scrollPosition > 0) {
        if (window.innerWidth < 991) {
            formContainer.style.top = "69px";
        } else {
            formContainer.style.top = "69px";
        }
    } else {
        if (window.innerWidth < 991) {
            formContainer.style.top = "69px";
        } else {
            formContainer.style.top = "119px";
        }
    }
});

window.addEventListener("load", function () {
    var scrollPosition = window.scrollY;
    var formContainer = document.querySelector(".cont-form-responsive");

    if (scrollPosition > 0) {
        if (window.innerWidth < 991) {
            formContainer.style.top = "69px";
        } else {
            formContainer.style.top = "69px";
        }
    } else {
        if (window.innerWidth < 991) {
            formContainer.style.top = "69";
        } else {
            formContainer.style.top = "119px";
        }
    }
});

var formContainer = document.querySelector(".cont-form-responsive");
var cerrarFiltros = document.querySelectorAll(".cerrar-filtros");

cerrarFiltros.forEach(function (btn) {
    btn.addEventListener("click", function () {
        formContainer.classList.toggle("toggle");
        console.log("Button clicked:", btn);
    });
});