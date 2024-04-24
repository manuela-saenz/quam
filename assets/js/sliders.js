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
var swiper = new Swiper(".generationSwiper", {
  navigation: {
    nextEl: ".generation-arrows.next",
    prevEl: ".generation-arrows.prev",
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
      spaceBetween: 20,
      loop: true,
      slidesPerView: 1,
    },
  },
  effect: "creative",
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
      translate: ["52%", 0, 0],
    },
  },

  // on: {

  //   init: function () {
  //     var swiperWrapperWidth = $('.timelineSwiper .swiper-wrapper').width();
  //     var swiperSlideWidth = '-' + (($('.timelineSwiper .swiper-slide .line .img-fit').width() / 2) * 50 / 100) + 'px';
  //     $('.timeline-midline').css('width', swiperWrapperWidth)
  //     $('.timeline-midline').css('left', swiperSlideWidth)
  //   },
  //   slideChange: (sw) => {
  //     if (sw.realIndex == 0) {
  //       var swiperSlideWidth = '-' + (($('.timelineSwiper .swiper-slide .line .img-fit').width() / 2) * 50 / 100) + 'px';
  //       $('.timeline-midline').css('left', swiperSlideWidth)
  //     }
  //   },
  //   setTranslate: (sw) => {
  //     var swiperSlideWidth = ($('.timelineSwiper .swiper-slide .line .img-fit').width() / 2) * 50 / 100;
  //     if (sw.realIndex == 0) {
  //       console.log('primer slide')
  //       $('.timeline-midline').css('left', sw.translate - swiperSlideWidth)
  //     } else {
  //       $('.timeline-midline').css('left', sw.translate)
  //     }

  //   }
  // },

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
var swiper = new Swiper(".SingProducts", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,

  breakpoints: {
    1200: {
      direction: "vertical",

    },
  },
});

// --------- active cards --------------------






(function () {

  'use strict';

  // breakpoint where swiper will be destroyed
  // and switches to a dual-column layout
  const breakpoint = window.matchMedia('(min-width:765px)');

  // keep track of swiper instances to destroy later
  let mySwiper;


  const breakpointChecker = function () {

    // if larger viewport and multi-row layout needed
    if (breakpoint.matches === false) {

      // clean up old instances and inline styles when available
      if (mySwiper !== undefined) mySwiper.destroy(true, true);

      // or/and do nothing
      return;

      // else if a small viewport and single column layout needed
    } else if (breakpoint.matches === true) {

      // fire small viewport version of swiper
      return enableSwiper();

    }

  };
  let allowScroll = false
  const enableSwiper = function () {
   
    mySwiper = new Swiper(".SingProducts2", {
      spaceBetween: 10,
      mousewheel: true,
      slidesPerView: "auto",
      scrollbar: {
        el: ".swiper-scrollbar",
      },
      navigation: {
        nextEl: ".SingProducts-button-next",
        prevEl: ".SingProducts-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
      breakpoints: {
        1200: {
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

    // desplazamiento hacia abajo cuando haga scroll en el ultimo slide
    $(mySwiper.el).on('wheel', function (e) {
        if (allowScroll) {
           // si se desplaza hacia abajo cuando este parado sobre el ultimo slide
          if(e.originalEvent.deltaY >= 0){
            let valueToScroll = (($(window).height() - e.originalEvent.screenY )  + 100);
            // si el valor que retorna screenY es negativo
            if(e.originalEvent.screenY <= 0){
              valueToScroll = e.originalEvent.screenY * -1;
            } 
            mySwiper.allowSlidePrev = false;
            $(window).scrollTop(valueToScroll)
          } else {
            if($(window).scrollTop() > 0){
              $(window).scrollTop(0)
              mySwiper.allowSlidePrev = false;
            } 
            mySwiper.allowSlidePrev = true;
          }
        }
    })
  };


  // keep an eye on viewport size changes
  breakpoint.addListener(breakpointChecker);

  // kickstart
  breakpointChecker();



})();
