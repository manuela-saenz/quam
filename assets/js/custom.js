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


// obtener el id de la variante actual de producto y pasarlo al boton de  añadir a favoritos-carrito
$('.variation_id').on('change', function () {
  $('.add-fav , .single_add_to_cart_button').attr('data-product-id', $(this).attr('value'))
})

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
const mainBox = document.querySelector('.main-box');
const contenedorContenido = document.querySelector('.mobile-container');
const mainBoxHeight = mainBox.offsetHeight + 48;
const wh = window.innerHeight - (80 + mainBoxHeight);

let contentScrollable = false;
let inicioY = 0;
let isUp = false;
if (!contentScrollable) {
  elemento.addEventListener('touchstart', iniciarToque, false);
  elemento.addEventListener('touchmove', moverToque, false);
  elemento.addEventListener('touchend', terminarToque, false);
}
// $('.mobile-container').scrollTop(2)


function scrollEnable() {
  if (contentScrollable) {
    $('.mobile-container').on('touchmove', function (e) {
      setTimeout(() => {
        if (e.currentTarget.scrollTop <= 0) {
          contentScrollable = false;
          elemento.addEventListener('touchstart', iniciarToque, false);
          elemento.addEventListener('touchmove', moverToque, false);
          elemento.addEventListener('touchend', terminarToque, false);
        } else {
          contentScrollable = true;
        }
      }, 200)
      // console.log('start:', e.currentTarget.scrollTop, contentScrollable)

    })

  } else {
    $('.mobile-container').off('touchmove');
    elemento.removeEventListener('touchstart', iniciarToque, false);
    elemento.removeEventListener('touchmove', moverToque, false);
    elemento.removeEventListener('touchend', terminarToque, false);
  }
}


elemento.style.marginTop = `-${mainBoxHeight}px`;

function positionDownIdentifier(deltaY) {
  if (deltaY <= -30) {
    elemento.style.transform = `translateY(-${wh}px)`;
    isUp = true;
    contentScrollable = true;
  } else {
    isUp = false;
    elemento.style.transform = `translateY(0px)`;
  }

}

function positionTopIdentifier(deltaY) {
  if (deltaY >= 30) {
    isUp = false;
    elemento.style.transform = `translateY(0px)`;
  } else {
    isUp = true;
    elemento.style.transform = `translateY(-${wh}px)`;
  }
}

function iniciarToque(evento) {
  const toque = evento.touches[0];
  inicioY = toque.clientY;
}

function moverToque(evento) {
  evento.preventDefault();
  const toque = evento.touches[0];
  const movingDeltaY = toque.clientY - inicioY;
  console.log(movingDeltaY)
  // if(movingDeltaY >= 0){
  //   isUp = false
  // }
  if (isUp) {
    elemento.style.transform = `translateY(${movingDeltaY + wh * -1}px)`;
  } else {
    elemento.style.transform = `translateY(${movingDeltaY}px)`;
  }

}

function terminarToque(evento) {
  const toque = evento.changedTouches[0];
  const deltaY = toque.clientY - inicioY;
  if (isUp) {
    positionTopIdentifier(deltaY);
  } else {
    positionDownIdentifier(deltaY);
  }
  if (contentScrollable) {
    console.log('El contenido es desplazable.');
    // Deshabilitar los listeners de eventos táctiles
    elemento.removeEventListener('touchstart', iniciarToque);
    elemento.removeEventListener('touchmove', moverToque);
    elemento.removeEventListener('touchend', terminarToque);
  } else {
    contentScrollable = false;
    console.log('El contenido no es desplazable.');
  }
  scrollEnable()

  console.log(contentScrollable, 'terminarToque')

}


