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
      let $input = $(this).next('input.qty');
      var val = parseInt($input.val());
      if (val > 0) {
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
  event.preventDefault();
  $(this).closest('.select-bag').remove(); // Remueve el elemento con la clase select-bag más cercano al enlace clickeado
});


$(window).on('load resize', function(){
  if($(window).width() <= 991){
    $('.product-actions').addClass('offcanvas offcanvas-bottom')
  } else{
    $('.product-actions').removeClass('offcanvas offcanvas-bottom')
  }
})

const elemento = document.getElementById('box-draggable');

let inicioY = 0;

elemento.addEventListener('touchstart', iniciarToque, false);
elemento.addEventListener('touchmove', moverToque, false);
elemento.addEventListener('touchend', terminarToque, false);

// Función que se ejecuta cuando el toque inicia
function iniciarToque(evento) {
    const toque = evento.touches[0]; 
    inicioY = toque.clientY;
}

$('.product-actions').on('click', function (evento) {
  evento.preventDefault();
});

function moverToque(evento) {
    evento.preventDefault(); 
    
    const toque = evento.touches[0]; 
    const deltaY = toque.clientY - inicioY;
    elemento.style.transform = `translateY(${deltaY}px)`;
    console.log(deltaY)
}

// Función que se ejecuta cuando el toque termina
function terminarToque(evento) {
  // evento.preventDefault(); 
  const toque = evento.changedTouches[0]; 
  const deltaY = toque.clientY - inicioY; 
  const wh = window.innerHeight - 250; 
  if (deltaY <= -30) {
    elemento.style.transform = `translateY(-${wh}px)`;
} else if (deltaY >= 30) {
    elemento.style.transform = `translateY(0px)`;
}
}


