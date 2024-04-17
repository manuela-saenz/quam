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

    });

  };



  // keep an eye on viewport size changes
  breakpoint.addListener(breakpointChecker);

  // kickstart
  breakpointChecker();



})();




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

$('.shopping-bag-offcanvas .select-bag a.remove').click(function(event){
  event.preventDefault();
  $(this).closest('.select-bag').remove(); // Remueve el elemento con la clase select-bag más cercano al enlace clickeado
});
// <--------- Paso a paso bolsa de compra ---------->

var stepper1
var stepper2
var stepper3
var stepper4
var stepperForm

document.addEventListener('DOMContentLoaded', function () {
stepper1 = new Stepper(document.querySelector('#stepper1'))
stepper2 = new Stepper(document.querySelector('#stepper2'), {
  linear: false
})
stepper3 = new Stepper(document.querySelector('#stepper3'), {
  linear: false,
  animation: true
})
stepper4 = new Stepper(document.querySelector('#stepper4'))

  var stepperFormEl = document.querySelector('#stepperForm')
  stepperForm = new Stepper(stepperFormEl, {
    animation: true
  })

  var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
  var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
  var inputMailForm = document.getElementById('inputMailForm')
  var inputPasswordForm = document.getElementById('inputPasswordForm')
  var form = stepperFormEl.querySelector('.bs-stepper-content form')

  btnNextList.forEach(function (btn) {
    btn.addEventListener('click', function () {
      stepperForm.next()
    })
  })

  stepperFormEl.addEventListener('show.bs-stepper', function (event) {
    form.classList.remove('was-validated')
    var nextStep = event.detail.indexStep
    var currentStep = nextStep

    if (currentStep > 0) {
      currentStep--
    }

    var stepperPan = stepperPanList[currentStep]

    if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length)
    || (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
      event.preventDefault()
      form.classList.add('was-validated')
    }
  })
})
