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



