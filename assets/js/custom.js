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

$('.open-selector').on('click', (event) => {
  console.log('funciona')
  event.preventDefault();
});

const elemento = document.querySelector('#box-draggable');

let inicioY = 0;
let isUp = false;
let moving
elemento.addEventListener('touchstart', iniciarToque, false);
elemento.addEventListener('touchmove', moverToque, false);
elemento.addEventListener('touchend', terminarToque, false);

elemento.style.marginTop = `-${document.querySelector('.main-box').offsetHeight + 48}px`;
const wh = window.innerHeight - 250;

function iniciarToque(evento) {
  const toque = evento.touches[0];
  inicioY = toque.clientY;
  if (isUp) {
    console.log('toque arriba hacia abajo', inicioY)
  } else {
    console.log('toque abajo hacia arriba:', inicioY)
  }
}
function positionDownIdetifier(deltaY) {
  if (deltaY <= -30) {
    isUp = true;
  } else {
    isUp = false;
  }
}

function positionTopIdetifier(deltaY) {
  if (deltaY >= 30) {
    isUp = false;
  } else {
    isUp = true;
  }
}

function moverToque(evento) {
  evento.preventDefault();
  const toque = evento.touches[0];
  const movingDeltaY = toque.clientY - inicioY;
  if (isUp) {
    console.log(movingDeltaY + wh)
    elemento.style.transform = `translateY(${movingDeltaY + wh * -1}px)`;
  } else {

    console.log(inicioY, '-', toque.clientY, '=', movingDeltaY)
    elemento.style.transform = `translateY(${movingDeltaY}px)`;
  }


}


function terminarToque(evento) {
  // evento.preventDefault(); 
  const toque = evento.changedTouches[0];
  const deltaY = toque.clientY - inicioY;
  positionDownIdetifier(deltaY);
  if (isUp) {
    positionTopIdetifier(deltaY);
    elemento.style.transform = `translateY(-${wh}px)`;
  } else {
    elemento.style.transform = `translateY(0px)`;
  }

}






