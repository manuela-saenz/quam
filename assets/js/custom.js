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

jQuery(function ($) {
  let paged = 2; // Comienza desde la segunda página
  let loading = false;

  function loadMoreProducts() {
    console.log("loadMoreProducts");
      if (loading) return;
      loading = true;
      console.log("loading");

      $.ajax({
          type: "POST",
          url: ajaxUrl,
          data: {
              action: "load_more_products",
              paged: paged
          },
          beforeSend: function () {
              $("#product-list").append('<div class="loading">Cargando más productos...</div>');
          },
          success: function (response) {
              $(".loading").remove();
              if ($.trim(response) !== '') {
                  $("#product-list").append(response);
                  paged++;
                  $(document.body).trigger("wc_fragments_refreshed");
                  $(document.body).trigger("wc_variation_form");
                  loading = false;

                  const productElements = document.querySelectorAll('li[data-variants]');

                  productElements.forEach(productElement => {
                      const colorButtons = productElement.querySelectorAll('.color-circle');
                      const sizeButtonsContainer = productElement.querySelector('.size-selection');
                      const productImage = productElement.querySelector('.product-image');
                      let selectedColor = null;
                      let selectedSize = null;
                
                      colorButtons.forEach(button => {
                          button.addEventListener('click', function() {
                              // Remover la clase activa de otros botones
                              colorButtons.forEach(btn => btn.classList.remove('active-color'));
                              this.classList.add('active-color');
                
                              selectedColor = this.getAttribute('data-color');
                              selectedSize = null; // Resetear la talla seleccionada
                              updateSizeButtons(productElement);
                              updateProductImage(productElement); // Actualizar la imagen al seleccionar el color
                          });
                      });
                
                      function updateSizeButtons(productElement) {
                          const variants = JSON.parse(productElement.getAttribute('data-variants'));
                          console.log(variants);
                          // Filtrar variantes por color seleccionado
                          const sizesForColor = variants
                              .filter(variant => variant.color === selectedColor)
                              .map(variant => variant.size);
                          console.log(sizesForColor);
                          const uniqueSizes = [...new Set(sizesForColor)]; // Obtener tallas únicas
                
                          // Limpiar el contenedor de tallas
                          sizeButtonsContainer.innerHTML = '';
                
                          if (uniqueSizes.length > 0) {
                              uniqueSizes.forEach(size => {
                                  const sizeButton = document.createElement('button');
                                  sizeButton.classList.add('size-circle');
                                  sizeButton.setAttribute('data-size', size);
                                  sizeButton.textContent = size;
                
                                  sizeButton.addEventListener('click', function() {
                                      document.querySelectorAll('.size-circle').forEach(btn => btn.classList.remove('active-size'));
                                      this.classList.add('active-size');
                
                                      selectedSize = this.getAttribute('data-size');
                                      updateSelectedVariation(productElement);
                                  });
                
                                  sizeButtonsContainer.appendChild(sizeButton);
                              });
                          }
                      }
                
                      function updateProductImage(productElement) {
                          if (selectedColor) {
                              const variants = JSON.parse(productElement.getAttribute('data-variants'));
                              const selectedVariant = variants.find(variant => variant.color === selectedColor);
                
                              if (selectedVariant) {
                                  console.log('Selected Variation Image URL:', selectedVariant.image_url);
                                  // Cambiar la imagen del producto
                                  productImage.src = selectedVariant.image_url;
                              }
                          }
                      }
                
                      function updateSelectedVariation(productElement) {
                          if (selectedColor && selectedSize) {
                              const variants = JSON.parse(productElement.getAttribute('data-variants'));
                              const selectedVariant = variants.find(variant => variant.color === selectedColor && variant.size === selectedSize);
                
                              if (selectedVariant) {
                                  console.log('Selected Variation ID:', selectedVariant.id);
                                  // Aquí puedes realizar cualquier otra acción necesaria con el ID de la variación seleccionada
                              }
                          }
                      }
                  });
              } else {
                  $(window).off("scroll"); // Detiene la carga si ya no hay más productos
              }
          }
      });
  }

  $(window).on("scroll", function () {
      if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
          loadMoreProducts();
      }
  });
});
