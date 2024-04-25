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

var waitToScroll;
var waitToInit;

function initDragBox() {
  elemento.addEventListener('touchstart', iniciarToque, false);
  elemento.addEventListener('touchmove', moverToque, false);
  elemento.addEventListener('touchend', terminarToque, false);
}
function disableDragBox() {
  elemento.removeEventListener('touchstart', iniciarToque, false);
  elemento.removeEventListener('touchmove', moverToque, false);
  elemento.removeEventListener('touchend', terminarToque, false);
}



if (!contentScrollable) {
  initDragBox();
}
$('.mobile-container').scrollTop(1)


function scrollEnable() {
  if (contentScrollable) {
    let initscroll = false;
    console.log('initscroll', initscroll)
    $('.mobile-container').on('touchstart', function () {
      initscroll = true;
      console.log('initscroll', initscroll)
    });

    $('.mobile-container').on('touchmove', function (e) {
      clearTimeout(waitToInit);
      console.log('estado de scroll dentro de caja', e.currentTarget.scrollTop)
      if (e.currentTarget.scrollTop == 0) {
        contentScrollable = false;
        console.log('apagar')
        initDragBox();

      } else {
        contentScrollable = true;
        console.log('prender')
        disableDragBox();
      }

    })

  }
}

elemento.style.marginTop = `-${mainBoxHeight}px`;

function positionDownIdentifier(deltaY) {
  if (deltaY <= -30) {
    elemento.style.transform = `translateY(-${wh}px)`;
    isUp = true;
    contentScrollable = true;
    console.log('se puede hacer scroll')
    scrollEnable()
    setTimeout(() => {
      $('.mobile-container').scrollTop(1)
    }, 500)
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
  clearTimeout(waitToScroll);
  console.log('estado de scroll', contentScrollable)
}

function moverToque(evento) {

  evento.preventDefault();
  const toque = evento.touches[0];
  const movingDeltaY = toque.clientY - inicioY;
  contentScrollable = false;
  scrollEnable();
  if (isUp) {
    elemento.style.transform = `translateY(${movingDeltaY + wh * -1}px)`;
  } else {
    elemento.style.transform = `translateY(${movingDeltaY}px)`;
  }
  console.log('estado de scroll', contentScrollable)
}

function terminarToque(evento) {
  const toque = evento.changedTouches[0];
  const deltaY = toque.clientY - inicioY;
  if (isUp) {
    positionTopIdentifier(deltaY);
  } else {
    positionDownIdentifier(deltaY);
  }
}


