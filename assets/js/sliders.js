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
    1200: {
      slidesPerView: 2.6,
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






