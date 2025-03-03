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

$(".entry-summary .cfvsw-swatches-option, .btn-step-next button").on(
  "click",
  function () {
    $(window).scrollTop(0);
  }
);

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

function initAddToFavoriteButton() {
  $(".add-fav").on("click", function (e) {
    e.preventDefault();

    $(this).addClass("adding");

    var productId = $(".variation_id").val();
    productId =
      productId == undefined || productId == 0
        ? $("[name='add-to-cart']")[0]
          ? $("[name='add-to-cart']")[0].value
          : undefined
        : productId;

    if (productId == undefined || productId == 0) {
      productId = $(this).data("product-id");
    }

    var sessionFav = JSON.parse(localStorage.getItem("sessionFav")) || [];

    $.ajax({
      url: ajaxUrl,
      method: "POST",
      data: {
        action: "add_product_to_favorites",
        prodid: productId,
      },
      success: function (res) {
        $(".add-fav").removeClass("adding");

        if (!sessionFav.includes(Number(productId))) {
          sessionFav.push(Number(productId));
          localStorage.setItem("sessionFav", JSON.stringify(sessionFav));
        } else {
          deleteFavoriteSameContext(productId);
          var alertElement = $("#showAlertDeleteFav");
          alertElement.removeClass("d-none").show();

          setTimeout(function () {
            alertElement.hide().addClass("d-none");
          }, 2200);
          return;
        }

        // Verifica si existe el elemento con el data-product-id especificado
        if ($(".add-fav[data-product-id='" + productId + "']").length > 0) {
          // Si existe, agrega la clase al elemento específico
          $(".add-fav[data-product-id='" + productId + "']").addClass(
            "active-fav"
          );
        } else {
          // Si no existe, agrega la clase a todos los elementos con la clase add-fav
          $(".add-fav").addClass("active-fav");
        }

        var spanElement = document.getElementById("favoritesCounter");

        if (!spanElement) {
          spanElement = document.createElement("span");
          spanElement.id = "favoritesCounter";
          spanElement.className =
            "cart-section-quantity rounded-pill position-absolute center-all text-white";
          spanElement.textContent = "";
          botonFav.appendChild(spanElement);
        }

        $("#favoritesCounter").text(res.counter).removeClass("d-none");
        $(".offcanvas-body.ordenListFav.fav").html(res.html);
        var alertElement = $("#showAlertAddFav");
        alertElement.removeClass("d-none").show();

        setTimeout(function () {
          alertElement.hide().addClass("d-none");
        }, 2200);
      },
    });
  });
}

// borrar texto tabla

function getCategoryFromURL() {
  const url = window.location.href; // Obtiene la URL actual
  const regex = /categoria-producto\/([^\/]+)/; // Expresión regular para capturar la categoría después de "categoria-producto/"
  const match = url.match(regex);
  
  if (match && match[1]) {
      return match[1]; // Devuelve la categoría encontrada
  }
  return null; // Devuelve null si no encuentra la categoría
}

// Uso
function getCategoryFromURL() {
  const url = window.location.href; // Obtiene la URL actual
  const regex = /categoria-producto\/([^\/]+)/; // Expresión regular para capturar la categoría después de "categoria-producto/"
  const match = url.match(regex);
  
  if (match && match[1]) {
      return match[1]; // Devuelve la categoría encontrada
  }
  return null; // Devuelve null si no encuentra la categoría
}


jQuery(function ($) {
  let paged = 2; // Comienza desde la segunda página
  let loading = false;

  function loadMoreProducts() {
    if (loading) return;
    loading = true;
    const category = getCategoryFromURL();


    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: {
        action: "load_more_products",
        paged: paged,
        slug: category,
      },
      beforeSend: function () {
        let placeholders = '';
        for (let i = 0; i < 8; i++) {
            placeholders += `
                <div class="col-lg-3 col-sm-6 col-6 product type-product post-146 status-publish first outofstock has-post-thumbnail shipping-taxable purchasable product-type-variation loading" data-id="toastCardLoad">
                    <div class="CardProducts w-100 placeholder-glow">
                        <div class="img-contain placeholder w-100"></div>
                        <div class="info-highlights opacity-25">
                            <h5 class="col-12 placeholder md-2"></h5>
                            <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                                <p class="mb-0 d-flex gap-2 placeholder col-6"></p>
                            </div>
                        </div>
                    </div>
                </div>`;
        }
        $('#product-list').append(placeholders);
       
      },
      success: function (response) {
        $(".loading").remove();
        if ($.trim(response) !== "") {
          $("#product-list").append(response);
          paged++;
          $(document.body).trigger("wc_fragments_refreshed");
          $(document.body).trigger("wc_variation_form");
          loading = false;
          const productElements =
            document.querySelectorAll("li[data-variants]");

          productElements.forEach((productElement) => {
            const colorButtons =
              productElement.querySelectorAll(".color-circle");
            const sizeButtonsContainer =
              productElement.querySelector(".size-selection");
            const productImage = productElement.querySelector(".product-image");
            let selectedColor = null;
            let selectedSize = null;

            colorButtons.forEach((button) => {
              button.addEventListener("click", function () {
                // Remover la clase activa de otros botones
                colorButtons.forEach((btn) =>
                  btn.classList.remove("active-color")
                );
                this.classList.add("active-color");

                selectedColor = this.getAttribute("data-color");
                selectedSize = null; // Resetear la talla seleccionada
                updateSizeButtons(productElement);
                updateProductImage(productElement); // Actualizar la imagen al seleccionar el color
              });
            });

            function updateSizeButtons(productElement) {
              const variants = JSON.parse(productElement.getAttribute('data-variants'));
          
              // Filtrar variantes por color seleccionado y convertir tallas a mayúsculas
              let sizesForColor = variants
                  .filter(variant => variant.color === selectedColor)
                  .map(variant => variant.size.toUpperCase());
          
              // Orden específico S, M, L, XL
              const sizeOrder = ["S", "M", "L", "XL"];
              const uniqueSizes = [...new Set(sizesForColor)].sort((a, b) => sizeOrder.indexOf(a) - sizeOrder.indexOf(b));
          
              // Limpiar el contenedor de tallas
              sizeButtonsContainer.innerHTML = '';
          
              if (uniqueSizes.length > 0) {
                  uniqueSizes.forEach(size => {
                      const sizeButton = document.createElement('button');
                      sizeButton.classList.add('size-circle');
                      sizeButton.setAttribute('data-size', size);
                      sizeButton.textContent = size; // Asegurar que se muestre en mayúsculas
          
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
                const variants = JSON.parse(
                  productElement.getAttribute("data-variants")
                );
                const selectedVariant = variants.find(
                  (variant) => variant.color === selectedColor
                );

                if (selectedVariant) {
                  productImage.src = selectedVariant.image_url;
                }
              }
            }

            function updateSelectedVariation(productElement) {
              if (selectedColor && selectedSize) {
                const variants = JSON.parse(
                  productElement.getAttribute("data-variants")
                );
                const selectedVariant = variants.find(
                  (variant) =>
                    variant.color === selectedColor &&
                    variant.size === selectedSize.toLowerCase()
                );

                if (selectedVariant) {
                  console.log("Selected Variation ID:", selectedVariant.id);

                  // Buscar el botón "Add to Cart" dentro de productElement
                  const addToCartButton = productElement.querySelector(
                    ".add_to_cart_button"
                  );

                  if (addToCartButton) {
                    // Agregar la clase 'cfvsw_variation_found'
                    addToCartButton.classList.add("cfvsw_variation_found");

                    // Actualizar el atributo data-variation_id con el ID de la variación seleccionada
                    addToCartButton.setAttribute(
                      "data-variation_id",
                      selectedVariant.id
                    );
                  }
                }
              }
            }
          });
          
          initAddToFavoriteButton();
          var buttons = document.querySelectorAll(".add_to_cart_button");

          buttons.forEach(function (button) {
            button.addEventListener("click", function (event) {
              var variationId = button.getAttribute("data-variation_id");
              var productId = button.getAttribute("data-product_id");
              button.classList.add("loading");
              var id = variationId ? variationId : productId;
              setTimeout(function () {
                addProductToCartCustom(id, 1, buttons);
              }, 1500);
            });
          });
        } else {
          $(window).off("scroll"); // Detiene la carga si ya no hay más productos
        }
      },
    });
  }

  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= $(document).height() / 2.5) {
        loadMoreProducts();
    }
});

});
