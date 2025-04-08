// observer del slider de productos relacionados para carga de imagenes

// const relatedSlider = document.querySelector("#related-swiper");
// const sliderObserve = new IntersectionObserver((entries) => {
//   const entry = entries[0];
//   if (entry.isIntersecting) {
//     if (entry.target.id === 'related-swiper') {
//       let slides = $('#related-swiper .swiper-slide');
//         slides.each(function() {
//           let slide = $(this);
//           slide.find('img').attr('src', $(this).find('img').attr('data-slide-src'));
//         })
//     }
//   }
// });
// sliderObserve.observe(relatedSlider);

$(document).ready(function () {
  // Obtener el elemento del pie de página
  var footer = document.querySelector('.sm-floating-box');
  //console.log('footer', footer);

  // Variables para almacenar la posición inicial del toque y la posición del pie de página
  var startY, endY;
  var startHeight = 0;
  var scrollable;

  // Establecer una altura mínima para el pie de página
  var minHeight = 150;

  handleResize();

  // Agregar un listener para el evento touchstart en el pie de página
  footer.addEventListener('touchstart', function (event) {
    // Obtener la posición inicial del toque
    startY = event.touches[0].clientY;
    // Obtener la altura inicial del pie de página
    startHeight = footer.offsetHeight;

    // Habilitar el drag sólo si no tiene scroll la página
    scrollable = footer.scrollTop === 0;
  });

  // Agregar un listener para el evento touchmove en el pie de página
  footer.addEventListener('touchmove', function (event) {
    // Calcular la distancia del desplazamiento vertical
    var deltaY = event.touches[0].clientY - startY;

    if (!footer.classList.contains('expanded') || (scrollable && deltaY >= 0)) {
      // Calcular la nueva altura del pie de página
      var newHeight = startHeight - deltaY;

      // Actualizar la altura del pie de página si es mayor que la altura mínima y menor que la altura máxima
      if (newHeight > minHeight && newHeight < getFooterHeight()) {
        footer.style.height = newHeight + 'px';
      }

      // Evitar el desplazamiento predeterminado del documento
      event.preventDefault();

    }
  });

  footer.addEventListener('touchend', function (e) {
    if (scrollable && footer.scrollTop === 0) {
      endY = e.changedTouches[0].clientY;

      // Tolerancia para cambio de modo
      var delta = 45;
      if (!footer.classList.contains('expanded')) {
        delta *= -1;
      }


      if (endY - startY < delta) {
        footer.style.height = getFooterHeight() + 'px';
        footer.classList.add('expanded');
      } else {
        footer.style.height = '';
        footer.classList.remove('expanded');
        console.log('collapsed');
      }
    }
  });

  function getFooterHeight() {
    return window.innerHeight - document.querySelector('header').offsetHeight;
  }


  // Función para manejar el evento resize
  function handleResize() {
    // Obtener el nuevo valor de window.innerHeight
    var contentHeight = window.innerHeight - document.querySelector('header').offsetHeight - 150;
    if (window.innerWidth < 991) {
      // document.getElementById('Singleimgprincipal').style.height = contentHeight + 'px';
    } else {
      document.getElementById('Singleimgprincipal').style.height = 'unset';
    }

  }

  // Agregar un listener para el evento resize
  window.addEventListener('resize', handleResize);

});


// compartir productos
// facebook
document.getElementById('shareBtnFacebook').addEventListener('click', function () {
  console.log('clic');
  const currentUrl = window.location.href;
  const encodedUrl = encodeURIComponent(currentUrl);

  const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
  console.log(facebookShareUrl);
  window.open(facebookShareUrl, '_blank');
});
//   whatsapp
document.getElementById('shareBtnWhatsapp').addEventListener('click', function () {
  // Obtener la URL actual de la página
  const currentUrl = window.location.href;

  // Codificar la URL
  const encodedUrl = encodeURIComponent(currentUrl);

  // Crear el enlace para compartir en WhatsApp
  const whatsappShareUrl = `https://web.whatsapp.com/send?text=Mira%20este%20art%C3%ADculo%20que%20he%20encontrado:%20${encodedUrl}`;

  // Abrir la ventana de compartir en WhatsApp
  window.open(whatsappShareUrl, '_blank');
});

(function () {

  'use strict';

  // breakpoint where swiper will be destroyed
  // and switches to a dual-column layout
  const breakpoint = window.matchMedia('(min-width:991px)');

  // keep track of swiper instances to destroy later
  let mySwiper;


  const breakpointChecker = function () {

    // if larger viewport and multi-row layout needed
    if (breakpoint.matches === false) {

      // clean up old instances and inline styles when available
      if (mySwiper !== undefined) mySwiper.destroy(true, true);

      // mostrar galeria del producto una imagen bajo otra
      $('.rtwpvg-slider .swiper-wrapper').addClass('flex-column d-flex');
      var currentOptions = JSON.parse($('.rtwpvg-slider').attr('data-options'));
      currentOptions.enabled = false;
      $('.rtwpvg-slider').attr('data-options', JSON.stringify(currentOptions));


      return;


      // else if a small viewport and single column layout needed
    } else if (breakpoint.matches === true) {

      // fire small viewport version of swiper
      return enableSwiper();

    }

  };
  let allowScroll = false
  const enableSwiper = function () {

    var elemento = $('.rtwpvg-thumbnail-wrapper > div');
    var elementoDos = $('.rtwpvg-slider-wrapper > div');


    function gallerySliders() {
      var thumbSwiper = new Swiper(".SingProducts", {
        spaceBetween: 10,
        slidesPerView: 6,
        freeMode: true,
        watchSlidesProgress: true,
        observer: true,
        observeSlideChildren: true,
        breakpoints: {
          991: {
            direction: "vertical",

          },
        },
      });
      var mySwiper = new Swiper(".SingProducts2", {
        spaceBetween: 10,
        mousewheel: true,
        slidesPerView: "auto",
        observer: true,
        observeSlideChildren: true,
        scrollbar: {
          el: ".swiper-scrollbar",
        },
        navigation: {
          nextEl: ".SingProducts-button-next",
          prevEl: ".SingProducts-button-prev",
        },
        thumbs: {
          swiper: thumbSwiper,
        },
        breakpoints: {
          991: {
            direction: "vertical",
          },
        },
        // habilitar desplazamiento hacia abajo en el ultimo slide
        on: {
          slideChange: function () {
            allowScroll = false
            if (mySwiper.activeIndex === ($('.SingProducts2 .swiper-wrapper>div').length - 1)) {
              setTimeout(() => {
                allowScroll = true;
              }, 100)
            }
          },
        }

      });

      thumbSwiper.updateSlides()
      let slidesFeaturedImg = $(".SingProducts2 .swiper-wrapper .swiper-slide");
      $(mySwiper.el).on('wheel', function (e) {
        if (allowScroll || slidesFeaturedImg.length == 1) {
          // si se desplaza hacia abajo cuando este parado sobre el ultimo slide
          if (e.originalEvent.deltaY >= 0) {
            let valueToScroll = (($(window).height() - e.originalEvent.screenY) + 100);
            // si el valor que retorna screenY es negativo
            if (e.originalEvent.screenY <= 0) {
              valueToScroll = e.originalEvent.screenY * -1;
            }
            mySwiper.allowSlidePrev = false;
            $(window).scrollTop(valueToScroll)
          } else {
            if ($(window).scrollTop() > 0) {
              $(window).scrollTop(0)
              mySwiper.allowSlidePrev = false;
            }
            mySwiper.allowSlidePrev = true;
          }
        }
      })

    }

    setTimeout(() => {
      elemento.removeClass();
      elemento.addClass('SingProducts swiper');
      elementoDos.removeClass();
      elementoDos.append('<div class="swiper-scrollbar"></div>');
      elementoDos.addClass('SingProducts2 swiper');
      gallerySliders();
    }, 2000)
    var elementoDataValue = elemento.attr('data-options');
    if (elementoDataValue) {
      elementoDataValue = JSON.parse(elementoDataValue);
      elementoDataValue.direction = 'vertical';
      elemento.attr('data-options', JSON.stringify(elementoDataValue));
    }
    var elementoDosDataValue = elementoDos.attr('data-options');
    if (elementoDosDataValue) {
      elementoDosDataValue = JSON.parse(elementoDosDataValue);
      elementoDosDataValue.direction = 'vertical';
      elementoDos.attr('data-options', JSON.stringify(elementoDosDataValue));
    }

  };


  // keep an eye on viewport size changes
  breakpoint.addListener(breakpointChecker);

  // kickstart
  breakpointChecker();



})();


document.addEventListener("DOMContentLoaded", function () {
  var element0 = document.querySelector(".sm-floating-box.swipe-animation");
  if (element0) {
    setTimeout(function () {
      element0.classList.remove("swipe-animation");
    }, 500); 
  }

  setInterval(function () {
    var element = document.querySelector(".sm-floating-box");
    if (element) {
      element.classList.add("swipe-animation");
      setTimeout(function () {
        element.classList.remove("swipe-animation");
      }, 1500);
    }
  }, 15000); 
});