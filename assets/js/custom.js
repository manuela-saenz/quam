// const images = document.querySelectorAll("img[data-src]");

// const observer = new IntersectionObserver((entries) => {
//   entries.forEach((entry) => {
//     if (entry.isIntersecting) {
//       const img = entry.target;
//       img.src = img.getAttribute("data-src");
//       observer.unobserve(img);
//     }
//   });
// });
// images.forEach((img) => {
//   observer.observe(img);
// });

// <!-- ENCABEZADO --> //
$(window).on("scroll load resize", function () {
  var scroll = $(window).scrollTop();
  if (scroll >= 30) {
    $("header").addClass("sticky-header");
  } else {
    $("header").removeClass("sticky-header");
  }
});

$(".menu-btn").on("click", function () {
  $(this).toggleClass("close");
  $(".mobile-menu").toggleClass("show-menu");
  $(".info-contact").toggleClass("infoshow-menu");
});

$(".mobile-menu a").on("click", function () {
  $(".mobile-menu").removeClass("show-menu");
  $(".menu-btn").removeClass("close");
  $(".info-contact").removeClass("infoshow-menu");
  header.removeClass("sticky-header");
  $("body").removeClass("no-scroll");
});

$("body").on("click", function () {
  $(".mobile-menu").removeClass("show-menu");
  $(".info-contact").removeClass("show-menu");
});

$(".menu-btn , .mobile-menu").on("click", function (e) {
  e.stopPropagation();
});

$(window).on("load resize", function () {
  if ($(window).width() <= 1200) {
    $(".mobile-menu").on("click", function () {
      $("body").toggleClass("no-scroll");
    });
  }
});

// <!------------------------ modal description single product ------------------------>//
//  $('.product-actions').on('click', function () {
//   $('.product-actions').toggleClass('show-bag')
// })

// $(document).ready(function(){
//   alert($(window).width());
// })

// <--------- cuntificador ---------->
/**
 * cuntificador del producto.
 */

function initQuantity() {
  $(".quantity.product").on("click", ".plus", function (e) {
    let $input = $(this).parent().find("input");
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $(".quantity.product").on("click", ".minus", function (e) {
    let $input = $(this).parent().find("input");
    var val = parseInt($input.val());
    if (val > 1) {
      $input.val(val - 1).change();
    }
  });
}

$(".cfvsw-swatches-option, .btn-step-next button").on("click", function () {
  $(window).scrollTop(0);
});

function initQuantitySingle() {
  $(".quantity").on("click", ".plus", function (e) {
    let $input = $(this).prev("input.qtySingle");
    let val = parseInt($input.val());
    $input.val(val + 1).change();
  });

  $(".quantity").on("click", ".minus", function (e) {
    let $input = $(this).next("input.qtySingle");
    var val = parseInt($input.val());
    if (val > 0) {
      $input.val(val - 1).change();
    }
  });
}

initQuantity();

// -------- quitar productos del  carrito-----------

$(".shopping-bag-offcanvas .select-bag a.remove").click(function (event) {
  event.preventDefault();
  $(this).closest(".select-bag").remove(); // Remueve el elemento con la clase select-bag más cercano al enlace clickeado
});

$(window).on("load resize", function () {
  if ($(window).width() <= 991) {
    $(".product-actions").addClass("offcanvas offcanvas-bottom");
  } else {
    $(".product-actions").removeClass("offcanvas offcanvas-bottom");
  }
});

$(".open-selector , .add-fav").on("click", (event) => {
  event.preventDefault();
});

$(".woocommerce-ordering select").on("change", function () {
  $("#infoProducts").addClass("loading");
});

$(".woocommerce-ordering-price button").on("click", function () {
  $("#infoProducts").addClass("loading");
});

// $(window).on('load', function() {
// jQuery(document).ready(function ($) {

$('#boton-id').on("click" , function (){
  console.log($(".container_payment_method label").length,"log");
  // setTimeout(function() {
   

    // console.log(payULatamLabel);
    setTimeout(function() { 
      
      var labels = $(".container_payment_method label");
      // var payULatamLabel = labels.filter(function() {
      //   return $(this).text().trim() === "PayU Latam";
      // });
      // payULatamLabel.trigger("click");
      $('#payment_method_payulatam').prop('checked',true)
      var button = $(".woocommerce-checkout-payment button:submit"); 
      button.text("Paga con PayU");
      labels.on("click", function (e) {
        console.log("click",e);
        var labelText = $(this).text().trim();
      
        if (labelText === "PayU Latam") {
          button.attr("id", "PayU_Latam");
          button.text("Paga con PayU");
        }
        if (labelText === "Paga a cuotas") {
          button.attr("id", "Paga_addi");
          button.text("Paga con Addi");
        }
        if (labelText === "Pago contra entrega") {
          button.attr("id", "Pago_contra_entrega");
          button.text("Pago contra entrega");
        }
      });
    }, 200);

  
  // }, 3000);
});
// filtro
