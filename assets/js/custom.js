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
  header.toggleClass('sticky-header');
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



// <--------- color de ropa ---------->

$(".product-var input").on("click", function () {
  varcolor = $(this).attr("id");
  $(".color-name").empty();
  $(".color-name").html(varcolor);

  $(".product .swiper-wrapper").empty();
});



// <--------- cuntificador ---------->
/**
 * cuntificador del producto.
 */

function initQuantity() {

  $('.quantity').on('click', '.plus', function (e) {
    let $input = $(this).prev('input.qty');
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $('.quantity').on('click', '.minus',
    function (e) {
      let $input = $(this).parent().find('input.qty');
      var val = parseInt($input.val());
      if (val > 1) {
        $input.val(val - 1).change();
      }
    });

}

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
initQuantitySingle();

// -------- quitar productos del  carrito-----------

$('.shopping-bag-offcanvas .select-bag a.remove').click(function (event) {
  // event.preventDefault();
  $(this).closest('.select-bag').remove(); // Remueve el elemento con la clase select-bag más cercano al enlace clickeado
});


$(window).on('load resize', function () {
  if ($(window).width() <= 991) {
    $('.product-actions').addClass('offcanvas offcanvas-bottom')
  } else {
    $('.product-actions').removeClass('offcanvas offcanvas-bottom')
  }
})

$('.product-actions , .variations_form').on('click', (event) => {
  // event.preventDefault();
});

const drawer = $('#box-draggable'); // Seleccionar el drawer
let drawerOpen = false; // Controlar el estado de apertura del drawer
let startY = 0; // Posición Y inicial del touchstart

// Configuración inicial del drawer
drawer.css({
  transform: 'translateY(0%)', // Inicialmente fuera de la vista (abajo)
  transition: 'transform 0.3s ease', // Transición suave para los movimientos del drawer
});


$(drawer).on('touchstart', function (event) {
  // event.preventDefault();
  const touch = event.touches[0];
  startY = touch.clientY; // Almacenar la posición Y inicial
});


// Evento touchmove
$(drawer).on('touchmove', function (event) {
  // event.preventDefault(); // Prevenir el comportamiento predeterminado
  const touch = event.touches[0];
  const currentY = touch.clientY; // Posición Y actual
  const deltaY = currentY - startY; // Diferencia entre la posición actual e inicial

  // Calcular la posición del drawer en función de deltaY
  let translateY;
  if (!drawerOpen && deltaY < 0) {
    // Si el drawer está cerrado y el movimiento es hacia arriba
    translateY = event.touches[0].clientY - startY;
    drawer.css('transform', `translateY(${translateY}%)`);
  } else if (drawerOpen && deltaY > 0) {
    // Si el drawer está abierto y el movimiento es hacia abajo
    translateY = Math.max(0, 100 - (deltaY / window.innerHeight * 100));
    drawer.css('transform', `translateY(${translateY}%)`);
  }
});


$(drawer).on('touchend', function (event) {
  // event.preventDefault();
  const touch = event.changedTouches[0];
  const endY = touch.clientY;
  const deltaY = endY - startY; // Diferencia entre la posición final e inicial

  // Decidir si abrir o cerrar el drawer según deltaY
  if (!drawerOpen && deltaY < -50) {
    // Abrir el drawer si está cerrado y el swipe fue hacia arriba
    drawer.css('transform', 'translateY(0)');
    drawerOpen = true;
  } else if (drawerOpen && deltaY > 50) {
    // Cerrar el drawer si está abierto y el swipe fue hacia abajo
    drawer.css('transform', 'translateY(100%)');
    drawerOpen = false;
  }
});






