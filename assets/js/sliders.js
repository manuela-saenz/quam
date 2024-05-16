// <!------------------------ Slider banner ------------------------>//
var swiper = new Swiper(".banner", {
  navigation: {
    nextEl: ".swiperBanner-button-next",
    prevEl: ".swiperBanner-button-prev",
  },
  // loop: true,
  // parallax: true,
  // autoplay: {
  //     delay: 3000,
  //     disableOnInteraction: false,
  // },
  // speed: 500,
});

// <!------------------------ Slider generation------------------------>//
var homeSwiper = new Swiper(".generationSwiper", {
  navigation: {
    nextEl: ".generation-arrows.next",
    prevEl: ".generation-arrows.prev",
  },
  effect: "creative",

  breakpoints: {
    1500: {
      slidesPerView: 3.3,
      spaceBetween: 24,
      centeredSlides: false,
      loop: false,
      creativeEffect: {
        progressMultiplier: 2,
        limitProgress: 5,
        prev: {
          shadow: false,
          translate: ["-55%", 0, 0],
          opacity: 0,
        },
        next: {
          shadow: false,
          translate: ["53%", 0, 0],
        },
      },
    },
    991: {
      slidesPerView: 2.2,
      spaceBetween: 24,
      centeredSlides: false,
      loop: false,
    },

    200: {
      spaceBetween: 20,
      loop: true,
      centeredSlides: true,
      slidesPerView: 1.3,
      creativeEffect: {
        progressMultiplier: 2,
        limitProgress: 2,
        prev: {
          shadow: false,
          translate: ["-54%", 0, 0],
          opacity: 1,
        },
        next: {
          shadow: false,
          translate: ["54%", 0, 0],
        },
      },
    },
  }

});


var swiper = new Swiper(".related-swiper", {
  centeredSlides: true,
  loop: true,
  navigation: {
    nextEl: ".generation-arrows.next",
    prevEl: ".generation-arrows.prev",
  },
  breakpoints: {
    1500: {
      slidesPerView: 4.2,
      spaceBetween: 24,
    },
    991: {
      slidesPerView: 2.2,
      spaceBetween: 24,
    },

    200: {
      spaceBetween: 20,
      loop: true,
      slidesPerView: 1.3,
    },
  },
});

// <!------------------------ Slider grupos------------------------>//

var swiper = new Swiper(".highlightsSwiper", {
  navigation: {
    nextEl: ".highlights-arrows.next",
    prevEl: ".highlights-arrows.prev",
  },
  breakpoints: {
    1500: {
      slidesPerView: 3.2,
      spaceBetween: 20,
    },
    991: {
      slidesPerView: 2.2,
      spaceBetween: 20,
    },

    200: {
      spaceBetween: 50,
      loop: true,
      slidesPerView: 1,
    },
  },
});

// <!------------------------ Slider single product------------------------>//



// --------- active cards --------------------






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

      $(mySwiper.el).on('wheel', function (e) {
        if (allowScroll) {
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
    }, 300)
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
