// <!-- ENCABEZADO --> //
$(window).on("scroll load resize", function () {
  var scroll = $(window).scrollTop();
  if (scroll >= 30) {
    $("header").addClass("sticky-header");
  } else {
    $("header").removeClass("sticky-header");
  }
});

$(".menu-btn").on("click", function () {
  $(this).toggleClass("close");
  $(".mobile-menu").toggleClass("show-menu");
  $(".info-contact").toggleClass("infoshow-menu");
});

$(".mobile-menu a").on("click", function () {
  $(".mobile-menu").removeClass("show-menu");
  $(".menu-btn").removeClass("close");
  $(".info-contact").removeClass("infoshow-menu");
  header.removeClass("sticky-header");
  $("body").removeClass("no-scroll");
});

$("body").on("click", function () {
  $(".mobile-menu").removeClass("show-menu");
  $(".info-contact").removeClass("show-menu");
});

$(".menu-btn , .mobile-menu").on("click", function (e) {
  e.stopPropagation();
});

$(window).on("load resize", function () {
  if ($(window).width() <= 1200) {
    $(".mobile-menu").on("click", function () {
      $("body").toggleClass("no-scroll");
    });
  }
});

// <!------------------------ modal description single product ------------------------>//
//  $('.product-actions').on('click', function () {
//   $('.product-actions').toggleClass('show-bag')
// })

// $(document).ready(function(){
//   alert($(window).width());
// })

// <--------- cuntificador ---------->
/**
 * cuntificador del producto.
 */

function initQuantity() {
  $(".quantity.product").on("click", ".plus", function (e) {
    let $input = $(this).parent().find("input");
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $(".quantity.product").on("click", ".minus", function (e) {
    let $input = $(this).parent().find("input");
    var val = parseInt($input.val());
    if (val > 1) {
      $input.val(val - 1).change();
    }
  });
}

$(".cfvsw-swatches-option, .btn-step-next button").on("click", function () {
  $(window).scrollTop(0);
});

function initQuantitySingle() {
  $(".quantity").on("click", ".plus", function (e) {
    let $input = $(this).prev("input.qtySingle");
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $(".quantity").on("click", ".minus", function (e) {
    let $input = $(this).next("input.qtySingle");
    var val = parseInt($input.val());
    if (val > 0) {
      $input.val(val - 1).change();
    }
  });
}

initQuantity();

// -------- quitar productos del  carrito-----------

$(".shopping-bag-offcanvas .select-bag a.remove").click(function (event) {
  event.preventDefault();
  $(this).closest(".select-bag").remove(); // Remueve el elemento con la clase select-bag más cercano al enlace clickeado
});

$(window).on("load resize", function () {
  if ($(window).width() <= 991) {
    $(".product-actions").addClass("offcanvas offcanvas-bottom");
  } else {
    $(".product-actions").removeClass("offcanvas offcanvas-bottom");
  }
});

$(".open-selector , .add-fav").on("click", (event) => {
  event.preventDefault();
});

$(".woocommerce-ordering select").on("change", function () {
  $("#infoProducts").addClass("loading");
});

$(".woocommerce-ordering-price button").on("click", function () {
  $("#infoProducts").addClass("loading");
});

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

// Función para obtener los parámetros de la URL
function getUrlParams() {
  var params = {};
  var urlParams = new URLSearchParams(window.location.search);
  for (const [key, value] of urlParams) {
    params[key] = value;
  }

  return params;
}

// obtener los filtros aplicados
function showAppliedFilters() {
  console.log(params);
  var params = getUrlParams();
  var appliedFiltersDiv = document.getElementById("appliedFilters");
  var filtersHtml = "";

  // Verificar si hay filtros aplicados
  var hasFilters = false;
  for (var key in params) {
    if (params[key] !== "") {
      hasFilters = true;
      break;
    }
  }

  // Si hay filtros aplicados, mostrar el div
  if (hasFilters) {
    appliedFiltersDiv.style.display = "flex";

    filtersHtml += '<div class="d-flex flex-wrap align-items-center">';
    // Mostrar los filtros aplicados
    for (var key in params) {
      if (params[key] !== "") {
        if (key === "min_price" || key === "max_price") {
          continue; // Saltar los parámetros de precio
        }
      }
    }

    // Unir los valores de min_price y max_price bajo el nombre "Precio"
    var minPrice = params["min_price"] || "";
    var maxPrice = params["max_price"] || "";

    filtersHtml += "</div>";

    // Mostrar el botón para restablecer los filtros
    filtersHtml +=
      '<button type="button" class="quam-btn" onclick="resetFilters()">Restablecer filtros</button>';
    appliedFiltersDiv.innerHTML = filtersHtml;
  } else {
    appliedFiltersDiv.style.display = "none";
  }

  // Mostrar por defecto el color seleccionado
  var filterColor = params["filter_color"];
  if (filterColor) {
    var inputColor = document.querySelector('select[name="filter_color"]');
    if (inputColor) {
      inputColor.value = filterColor;
    }
  }

  // Mostrar por defecto la talla seleccionada
  var filterTalla = params["filter_talla"];
  if (filterTalla) {
    var inputTalla = document.querySelector('select[name="filter_talla"]');
    if (inputTalla) {
      inputTalla.value = filterTalla;
    }
  }

  // Mostrar por defecto el valor mínimo de precio
  var filterMinPrice = params["min_price"];
  if (filterMinPrice) {
    var inputMinPrice = document.querySelector('input[name="min_price"]');
    if (inputMinPrice) {
      inputMinPrice.value = filterMinPrice;
    }
  }

  // Mostrar por defecto el valor máximo de precio
  var filterMaxPrice = params["max_price"];
  if (filterMaxPrice) {
    var inputMaxPrice = document.querySelector('input[name="max_price"]');
    if (inputMaxPrice) {
      inputMaxPrice.value = filterMaxPrice;
    }
  }
}

// Función para restablecer los filtros
function resetFilters() {
  var url = window.location.href;

  // Remover los parámetros específicos de la URL
  url = url.replace(
    /([&?]filter_color=|&filter_talla=|&min_price=|&max_price=|orderby=)[^&]*/g,
    ""
  );

  // Redirigir a la URL sin los parámetros especificados
  window.location.href = url;
}

// Llamar a la función al cargar la página
showAppliedFilters();

// validar cambios en el submit filtro
function handleFormSubmit() {
  clearCurrencyFormat(document.getElementById("min_price"));
  clearCurrencyFormat(document.getElementById("max_price"));

  if (document.getElementById("min_price").value === "") {
    var placeholderValue = document.getElementById("min_price").placeholder;
    var numericValue = placeholderValue.replace("Min:", "").trim();
    document.getElementById("min_price").value = numericValue;
  }

  if (document.getElementById("max_price").value === "") {
    var placeholderValueMax = document.getElementById("max_price").placeholder;
    var numericValueMax = placeholderValueMax.replace("Min:", "").trim();
    document.getElementById("max_price").value = numericValue;
  }
}

document
  .getElementById("filterForm")
  .addEventListener("submit", function (event) {
    handleFormSubmit();
  });

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
// filtro
