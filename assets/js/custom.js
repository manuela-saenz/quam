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

  $(window).on("load resize", function(){
    if( $(window).width() <= 1200){
     $('.mobile-menu').on('click', function () {
       $('body').toggleClass('no-scroll');
     })
    }
   })

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
            slidesPerView: 1.2,
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
            slidesPerView: 1.2,
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
  var swiper2 = new Swiper(".SingProducts2", {
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

function initQuantity()
{
  
	$('.quantity').on('click', '.plus', function(e) {
		let $input = $(this).prev('input.qty');
		let val = parseInt($input.val());
		$input.val( val+1 ).change();
	});

	$('.quantity').on('click', '.minus', 
		function(e) {
		let $input = $(this).next('input.qty');
		var val = parseInt($input.val());
		if (val > 0) {
			$input.val( val-1 ).change();
		} 
	});

}

function initQuantitySingle()
{
  
	$('.quantity').on('click', '.plus', function(e) {
		let $input = $(this).prev('input.qtySingle');
		let val = parseInt($input.val());
		$input.val( val+1 ).change();
	});

	$('.quantity').on('click', '.minus', 
		function(e) {
		let $input = $(this).next('input.qtySingle');
		var val = parseInt($input.val());
		if (val > 0) {
			$input.val( val-1 ).change();
		} 
	});

}


initQuantity();
initQuantitySingle();
