// <!-- ENCABEZADO --> //
$(window).on("scroll load resize", function () {
  var scroll = $(window).scrollTop();
  if (scroll >= 30) {
    $('header').addClass("sticky-header");
  } else {
    $('header').removeClass("sticky-header");
  }
});

$('.menu-btn').on('click', function () {
  $(this).toggleClass('close')
  $('.mobile-menu').toggleClass('show-menu')
  $('.info-contact').toggleClass('infoshow-menu')
})

$('.mobile-menu a').on('click', function () {
  $('.mobile-menu').removeClass('show-menu')
  $('.menu-btn').removeClass('close')
  $('.info-contact').removeClass('infoshow-menu')
  header.removeClass('sticky-header');
  $('body').removeClass('no-scroll');
})

$("body").on("click", function () {
  $('.mobile-menu').removeClass('show-menu')
  $('.info-contact').removeClass('show-menu')
})

$(".menu-btn , .mobile-menu").on("click", function (e) {
  e.stopPropagation()
});

$(window).on("load resize", function () {
  if ($(window).width() <= 1200) {
    $('.mobile-menu').on('click', function () {
      $('body').toggleClass('no-scroll');
    })
  }
})



// <!------------------------ modal description single product ------------------------>//
//  $('.product-actions').on('click', function () {
//   $('.product-actions').toggleClass('show-bag')
// })



// <--------- cuntificador ---------->
/**
 * cuntificador del producto.
 */

function initQuantity() {

  $('.quantity.product').on('click', '.plus', function (e) {
    let $input = $(this).parent().find('input');
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $('.quantity.product').on('click', '.minus',
    function (e) {
      let $input = $(this).parent().find('input');
      var val = parseInt($input.val());
      if (val > 1) {
        $input.val(val - 1).change();
      }
    });

}

$('.cfvsw-swatches-option, .btn-step-next button').on('click', function(){
  $(window).scrollTop(0)
})

function initQuantitySingle() {

  $('.quantity').on('click', '.plus', function (e) {
    let $input = $(this).prev('input.qtySingle');
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $('.quantity').on('click', '.minus',
    function (e) {
      let $input = $(this).next('input.qtySingle');
      var val = parseInt($input.val());
      if (val > 0) {
        $input.val(val - 1).change();
      }
    });

}


initQuantity();

// -------- quitar productos del  carrito-----------

$('.shopping-bag-offcanvas .select-bag a.remove').click(function (event) {
  event.preventDefault();
  $(this).closest('.select-bag').remove(); // Remueve el elemento con la clase select-bag más cercano al enlace clickeado
});


$(window).on('load resize', function () {
  if ($(window).width() <= 991) {
    $('.product-actions').addClass('offcanvas offcanvas-bottom')
  } else {
    $('.product-actions').removeClass('offcanvas offcanvas-bottom')
  }
})

$('.open-selector , .add-fav').on('click', (event) => {
  event.preventDefault();
});



$('.woocommerce-ordering select').on('change', function(){
  $('#infoProducts').addClass('loading');
})

// precios filtro
function formatCurrency(input) {
  // Eliminar todos los caracteres que no sean dígitos
  var value = input.value.replace(/\D/g, '');

  // Si el valor es vacío, retornar
  if (!value) return;

  // Formatear como número con separadores de miles
  var formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  // Agregar símbolo de dólar
  formattedValue = '$' + formattedValue;

  // Asignar el valor formateado de nuevo al campo de entrada
  input.value = formattedValue;
}

function clearCurrencyFormat(input) {
  // Eliminar símbolo de dólar y puntos
  var value = input.value.replace(/[$.]/g, '');

  // Si el valor es vacío, mostrar el placeholder
  if (!value) {
      input.value = '';
      input.placeholder = input.getAttribute('placeholder');
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

// Función para mostrar los filtros aplicados en el div
function showAppliedFilters() {
  var params = getUrlParams();
  var appliedFiltersDiv = document.getElementById('appliedFilters');
  var filtersHtml = '';

  // Verificar si hay filtros aplicados
  var hasFilters = false;
  for (var key in params) {
      if (params[key] !== '') {
          hasFilters = true;
          break;
      }
  }

  // Si hay filtros aplicados, mostrar el div
  if (hasFilters) {
      appliedFiltersDiv.style.display = 'flex';

      filtersHtml += '<ul class="d-flex flex-wrap align-items-center">';
      // Mostrar los filtros aplicados
      for (var key in params) {
          if (params[key] !== '') {
              if (key === 'min_price' || key === 'max_price') {
                  continue; // Saltar los parámetros de precio
              }
              var filterName = key.replace('filter_', ''); // Eliminar el prefijo 'filter_'
              filtersHtml += '<li><strong>' + filterName + ':</strong> ' + params[key] + '</li>';
          }
      }

      // Unir los valores de min_price y max_price bajo el nombre "Precio"
      var minPrice = params['min_price'] || '';
      var maxPrice = params['max_price'] || '';
      if (minPrice && maxPrice) {
          filtersHtml += '<li><strong>Precio:</strong> ' + minPrice + ' - ' + maxPrice + '</li>';
      } else if (minPrice) {
          filtersHtml += '<li><strong>Precio mínimo:</strong> ' + minPrice + '</li>';
      } else if (maxPrice) {
          filtersHtml += '<li><strong>Precio máximo:</strong> ' + maxPrice + '</li>';
      }
      
      filtersHtml += '</ul>';

      // Mostrar el botón para restablecer los filtros
      filtersHtml += '<button type="button" class="quam-btn" onclick="resetFilters()">Restablecer filtros</button>';

      appliedFiltersDiv.innerHTML = filtersHtml;
  } else {
      appliedFiltersDiv.style.display = 'none';
  }
}

// Función para restablecer los filtros
function resetFilters() {
  var url = window.location.href;
  
  // Remover los parámetros específicos de la URL
  url = url.replace(/([&?]filter_color=|&filter_talla=|&min_price=|&max_price=)[^&]+/g, '');
  
  // Redirigir a la URL sin los parámetros especificados
  window.location.href = url;
  console.log(url);
}

// Llamar a la función al cargar la página
showAppliedFilters();