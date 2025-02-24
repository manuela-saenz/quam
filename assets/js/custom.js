const images = document.querySelectorAll("img[data-src]");

const observerImages = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const img = entry.target;
      img.src = img.getAttribute("data-src");
      observerImages.unobserve(img);
    }
  });
});

images.forEach((img) => {
  observerImages.observe(img);
});

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

$(".entry-summary .cfvsw-swatches-option, .btn-step-next button").on("click", function () {
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

$("#boton-id").on("click", function () {
  setTimeout(function () {
    var labels = $(".container_payment_method label");
    $("#payment_method_payulatam").prop("checked", true);
    var button = $(".woocommerce-checkout-payment button:submit");
    button.text("Realizar mi pedido con PayU");
    labels.on("click", function (e) {

      var labelText = $(this).text().trim();

      if (labelText === "PayU Latam") {
        button.attr("id", "PayU_Latam");
        button.text("Realizar mi pedido con PayU");
      }
      if (labelText === "Paga a cuotas") {
        button.attr("id", "Paga_addi");
        button.text("Realizar mi pedido con Addi");
      }
      if (labelText === "Pago contra entrega") {
        button.attr("id", "Pago_contra_entrega");
        button.text("Realizar mi pedido contra entrega");
      }
    });
  }, 200);
});

// Rastreo de paquetes
document
  .getElementById("track-package-link")
  .addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("track-package-form").style.display = "flex";
  });

function trackPackage() {
  var trackingCode = document.getElementById("tracking-code").value;
  var trackingUrl = "https://tracking.melonn.com/" + trackingCode;
  window.open(trackingUrl, "_blank");
}

function hideTracking() {
  document.getElementById("track-package-form").style.display = "none";
}

// borrar texto tabla

// jQuery(function ($) {
//   let paged = 2; // Comienza desde la segunda página
//   let loading = false;

//   function loadMoreProducts() {
//     console.log("loadMoreProducts");
//       if (loading) return;
//       loading = true;
//       console.log("loading");

//       $.ajax({
//           type: "POST",
//           url: ajaxUrl,
//           data: {
//               action: "load_more_products",
//               paged: paged
//           },
//           beforeSend: function () {
//               $("#product-list").append('<div class="loading">Cargando más productos...</div>');
//           },
//           success: function (response) {
//               $(".loading").remove();
//               if ($.trim(response) !== '') {
//                   $("#product-list").append(response);
//                   paged++;
//                   loading = false;
//               } else {
//                   $(window).off("scroll"); // Detiene la carga si ya no hay más productos
//               }
//           }
//       });
//   }

//   $(window).on("scroll", function () {
//       if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
//           loadMoreProducts();
//       }
//   });
// });
