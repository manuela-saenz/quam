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

function initLiPrice() {
  const targetNode = document.querySelector(".offcanvas-body.ordenList.cart");

  // Selecciona el contenedor de la lista de productos
  const productList = document.querySelector("#product-list");
  // Extrae el precio del primer producto en el carrito
  const firstProductCard = targetNode.querySelector(".mini-cart-product-card");
  const priceElement = firstProductCard
    ? firstProductCard.querySelector("#price ins .woocommerce-Price-amount")
    : null;
  const detectedPrice = priceElement ? priceElement.textContent.trim() : null;
  // Itera sobre los elementos <li> en la lista de productos
  const productItems = productList.querySelectorAll("li");
  productItems.forEach((productItem) => {
    const cardProduct = productItem.querySelector(".CardProducts");
    if (!cardProduct) return;

    const infoHighlights = cardProduct.querySelector("#info-highlights");
    // if (!infoHighlights) return;

    const priceSpan = infoHighlights.querySelector(
      ".price .woocommerce-Price-amount"
    );
    if (!priceSpan) return;

    const existingIns = priceSpan.parentNode.querySelector("ins");

    if (detectedPrice) {
      if (!existingIns) {
        // Agrega el nuevo <ins> después del último <span>
        priceSpan.insertAdjacentHTML(
          "beforeend",
          `<ins class="offer-price" aria-hidden="true" style="display: inline-block; margin-left: 5px;">
              <span class="woocommerce-Price-amount amount">
                <bdi><span class="woocommerce-Price-currencySymbol"></span>${detectedPrice}</bdi>
              </span>
            </ins>`
        );
      } else {
        // Si ya existe, actualiza el contenido del <ins>
        existingIns.querySelector(".woocommerce-Price-amount bdi").innerHTML = `
          <span class="woocommerce-Price-currencySymbol"></span>&nbsp;${detectedPrice}
        `;
      }
    } else if (existingIns) {
      // Si no se detecta ningún precio, elimina el <ins> existente
      existingIns.remove();
    }
  });
}
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

$(".add-to-cart-container .add-btn").on("click", function () {
  $(this)
    .parent()
    .parent()
    .parent()
    .find(".size-selection")
    .addClass("show-colors");
  $(this).addClass("hide-btn");
});
// $('.add_to_cart_button')

function selectButtonCustom(){
  const productElements = document.querySelectorAll("li[data-variants]");

  productElements.forEach((productElement) => {
    const colorButtons = productElement.querySelectorAll(".color-circle");
    const sizeButtonsContainer =
      productElement.querySelector(".size-selection");
    const productImage = productElement.querySelector(".product-image");
    const buttonAddToCart = productElement.querySelector(".add_to_cart_button");
    let selectedColor = null;
    let selectedSize = null;

    const initialColor = productElement.getAttribute("data-color-q");
    if (initialColor) {
      colorButtons.forEach((button) => {
        if (button.getAttribute("data-color") === initialColor) {
          button.classList.add("active-color");
          selectedColor = initialColor;

          updateSizeButtons(productElement);
          updateProductImage(productElement);
        }
      });
    }

    colorButtons.forEach((button) => {
      button.addEventListener("click", function () {
        colorButtons.forEach((btn) => btn.classList.remove("active-color"));
        this.classList.add("active-color");
        buttonAddToCart.classList.remove("cfvsw_variation_found");
        selectedColor = this.getAttribute("data-color");
        selectedSize = null;

        updateSizeButtons(productElement);
        updateProductImage(productElement);
      });
    });

    function updateSizeButtons(productElement) {
      const variants = JSON.parse(productElement.getAttribute("data-variants"));

      let sizesForColor = variants
        .filter((variant) => variant.color === selectedColor)
        .map((variant) => variant.size.toUpperCase());

      const sizeOrder = ["S", "M", "L", "XL"];
      const uniqueSizes = [...new Set(sizesForColor)].sort(
        (a, b) => sizeOrder.indexOf(a) - sizeOrder.indexOf(b)
      );

      sizeButtonsContainer.innerHTML = "";

      if (uniqueSizes.length > 0) {
        uniqueSizes.forEach((size) => {
          const sizeButton = document.createElement("button");
          sizeButton.classList.add("size-circle");
          sizeButton.setAttribute("data-size", size);
          sizeButton.textContent = size;

          sizeButton.addEventListener("click", function () {
            document
              .querySelectorAll(".size-circle")
              .forEach((btn) => btn.classList.remove("active-size"));
            this.classList.add("active-size");

            selectedSize = this.getAttribute("data-size");
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
          console.log('seleccionando desde lazy')
          const button = productElement.querySelector(".add_to_cart_button");
          button.setAttribute("data-variation_id", selectedVariant.id);
          addButtonCustomCartCategory(button);
        }
      }
    }
  });
}

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

function setVariantAll() {
  if (window.location.pathname === "/") return; // Evita que se ejecute en la ruta raíz

  const productList = document.getElementById("product-list");
  if (!productList) return;

  function reorderProducts() {
    const items = Array.from(productList.querySelectorAll("li[data-father]"));
    if (items.length < 2) return;

    let lastFather = null;
    let toMove = [];

    for (let i = 0; i < items.length; i++) {
      const currentFather = items[i].getAttribute("data-father");
      if (currentFather === lastFather) {
        toMove.push(items[i]);
      } else {
        lastFather = currentFather;
      }
    }
    toMove.forEach((item) => productList.appendChild(item));
  }

  const observer = new MutationObserver(() => {
    reorderProducts();
  });

  const config = { childList: true, subtree: true };
  observer.observe(productList, config);
  reorderProducts();
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
        let placeholders = "";
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
        $("#product-list").append(placeholders);
      },
      success: function (response) {
        if ($.trim(response) === "no_more_products") {
          console.log("No hay más productos para cargar.");
          $(".loading").remove();
          return;
        }
        $(".loading").remove();
        if ($.trim(response) !== "") {
          $("#product-list").append(response);
          paged++;
          $(document.body).trigger("wc_fragments_refreshed");
          $(document.body).trigger("wc_variation_form");
          loading = false;
          
        

          initAddToFavoriteButton();

          $(".add-to-cart-container .add-btn").on("click", function () {
            $(this)
              .parent()
              .parent()
              .parent()
              .find(".size-selection")
              .addClass("show-colors");
            $(this).addClass("hide-btn");
          });

          // Selecciona el contenedor que deseas observar
          const targetNode = document.querySelector(
            ".offcanvas-body.ordenList.cart"
          );

          if (!targetNode) {
            console.error("El contenedor no se encontró.");
            return;
          }
          const productList = document.querySelector("#product-list");
          const productItems = productList.querySelectorAll("li");

          // Configuración del observer
          const observer = new MutationObserver((mutationsList) => {
            for (const mutation of mutationsList) {
              if (
                mutation.type === "childList" &&
                mutation.addedNodes.length > 0
              ) {
                // Busca el primer div con la clase "mini-cart-product-card"
                const firstProductCard = targetNode.querySelector(
                  ".mini-cart-product-card"
                );
                if (firstProductCard) {
                  // Extrae el precio del elemento con ID "price"
                  const priceElement = firstProductCard.querySelector(
                    "#price ins .woocommerce-Price-amount"
                  );

                  const detectedPrice = priceElement
                    ? priceElement.textContent.trim()
                    : null;

                  productItems.forEach((productItem) => {
                    const cardProduct =
                      productItem.querySelector(".CardProducts");
                    const infoHighlights =
                      cardProduct.querySelector("#info-highlights");
                    const priceSpan = infoHighlights.querySelector(
                      ".price .woocommerce-Price-amount"
                    );
                    const existingIns =
                      priceSpan.parentNode.querySelector("ins");

                    if (detectedPrice) {
                      if (!existingIns) {
                        // Agrega el nuevo <ins> después del último <span>, simulando que está después del ::after
                        priceSpan.insertAdjacentHTML(
                          "beforeend",
                          `<ins class="offer-price" aria-hidden="true" style="display: inline-block; margin-left: 5px;">
                      <span class="woocommerce-Price-amount amount">
                        <bdi><span class="woocommerce-Price-currencySymbol"></span>${detectedPrice}</bdi>
                      </span>
                    </ins>`
                        );
                      } else {
                        // Si ya existe, actualiza el contenido del <ins>
                        existingIns.querySelector(
                          ".woocommerce-Price-amount bdi"
                        ).innerHTML = `
                    <span class="woocommerce-Price-currencySymbol"></span>&nbsp;${detectedPrice}
                  `;
                      }
                    } else if (existingIns) {
                      // Si no se detecta ningún precio, elimina el <ins> existente
                      existingIns.remove();
                    }
                  });
                }
              }
            }
          });

          // Opciones del observer
          const config = { childList: true, subtree: true };

          // Inicia el observer

          observer.observe(targetNode, config);
          setTimeout(() => {
            initLiPrice();
            selectButtonCustom();
            initProductDiscount();
          }, 500);
        } else {
          $(window).off("scroll"); // Detiene la carga si ya no hay más productos
        }
      },
    });
  }
  $(window).on("scroll", function () {
    if (
      window.location.search.indexOf("s=") === -1 &&
      window.location.search.indexOf("post_type=product") === -1 &&
      window.location.search.indexOf("filter_talla") === -1 &&
      window.location.search.indexOf("filter_color") === -1
    ) {
      const path = window.location.pathname;
      if (path.includes("categoria-producto")) {
        $(window).on("scroll", function () {
          if ($(window).scrollTop() >= $(document).height() / 4) {
            loadMoreProducts();
          }
        });
      }
    }
  });
});
