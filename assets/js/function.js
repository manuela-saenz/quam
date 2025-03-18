document.addEventListener("DOMContentLoaded", function () {
  const favorites = JSON.parse(localStorage.getItem("sessionFav")) || [];
  if (favorites.length === 0) return;

  $.ajax({
    url: "/wp-admin/admin-ajax.php",
    type: "POST",
    data: {
      action: "update_favs",
      favs: JSON.stringify(favorites),
    },
    success: function (response) {
      response = JSON.parse(response);
      if (response.html) {
        // Actualizar el contenido del carrito de favoritos
        $(".offcanvas-body.ordenListFav.fav").html(response.html);
      }
      if (response.count !== undefined) {
        // Actualizar el conteo de favoritos
        $("#favoritesCounter").text(response.count).removeClass("d-none");
      }

      for (var i = 0; i < favorites.length; i++) {
        $(".add-fav[data-product-id='" + favorites[i] + "']").addClass(
          "active-fav"
        );
      }
    },
    error: function (error) {
      console.error("Error al sincronizar favoritos:", error);
    },
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Función para actualizar el conteo de artículos en el carrito y mostrar los artículos
  function updateCartCount() {
    jQuery.ajax({
      url: ajaxUrl, // URL de la acción AJAX de WordPress
      type: "POST",
      data: {
        action: "update_cart_count",
      },
      success: function (response) {
        if (response.success) {
          var cartItem = document.getElementById("cartItem");
          if (response.data.count > 0) {
            cartItem.innerText = response.data.count;
            cartItem.classList.remove("d-none");
          }
          $(".ordenList").html(response.data.itemsCart);
          var totalString = response.data.total;
          var value = getTotalValue(totalString);
          if (window.location.href.indexOf("bolsa-de-compras") > -1) {
            $(".woocommerce-Price-amount.amount").text("$ " + value);
          }

          $("#subtotal, #total").html("$" + value);
        } else {
          console.log("Error:", response);
        }
      },
      error: function (xhr, status, error) {
        console.log("Error en la solicitud AJAX:", error);
      },
    });
  }

  // Llamar a la función para actualizar el conteo de artículos en el carrito

  updateCartCount();
});

function getTotalValue(totalString) {
  var match = totalString.match(
    /<span class="woocommerce-Price-currencySymbol">[^<]*<\/span>&nbsp;((\d{1,3}(\.\d{3})*(\,\d+)?)|(\d+))/
  );
  var value = match ? match[1] : null;
  return value;
}

// <!-- Agregando de manera dinámica los descuentos   -->
function discountValue(res) {
  var arrayDivs = res.coupon_details;
  var subtotalDiv = document.querySelector(
    ".offcanvas-footer .d-flex.justify-content-between.mb-2"
  );

  if (subtotalDiv) {
    var desiredClasses = new Set(
      arrayDivs.map((element) => "coupon-" + element.title.replace(/ /g, "-"))
    );

    arrayDivs.forEach((element) => {
      var className = "coupon-" + element.title.replace(/ /g, "-");
      var existingDivs = document.querySelectorAll("." + className);

      var newDivContent = `
        <p class="text-capitalize">${element.title}</p>
        <span>-<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>&nbsp;${element.value}</span> </span>`;

      if (existingDivs.length > 0) {
        existingDivs.forEach((div) => (div.innerHTML = newDivContent));
      } else {
        var newDiv = document.createElement("div");
        newDiv.className = `cart-discount d-flex justify-content-between ${className}`;
        newDiv.innerHTML = newDivContent;
        subtotalDiv.insertAdjacentElement("afterend", newDiv);
      }
    });

    var existingDiscountDivs = document.querySelectorAll(".cart-discount");
    existingDiscountDivs.forEach((div) => {
      var classes = div.className.split(" ");
      var couponClass = classes.find((cls) => cls.startsWith("coupon-"));
      if (couponClass && !desiredClasses.has(couponClass)) {
        div.remove();
      }
    });
  }

  var cartElement = document.querySelector(".offcanvas-body.ordenList.cart");
  if (cartElement && cartElement.children.length == 0) {
    var discountDiv = document.querySelector(".cart-discount");
    if (discountDiv) {
      discountDiv.remove();
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var buttons = document.querySelectorAll(".add_to_cart_button");

  buttons.forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault();
      var variationId = button.getAttribute("data-variation_id");
      var productId = button.getAttribute("data-product_id");
      button.classList.add("loading");
      var id = variationId ? variationId : productId;
      setTimeout(function () {
        addProductToCartCustom(id, 1, buttons);
      }, 1500);
    });
  });
});

// <!-- Lógica de añadir articulo al carrito   -->
var botonCart = document.getElementById("bottonCart");

jQuery(document).ready(function ($) {
  $("form.cart").on("submit", function (e) {
    e.preventDefault();

    var form = $(this);
    var productId = $(".variation_id").val();
    productId =
      productId == undefined || productId == 0
        ? $("[name='add-to-cart']")[0].value
        : productId;
    clearEmptyCart();
    var quantity = form.find("input.input-text.qty.text").val();
    addProductToCart(productId, quantity);
  });
});

function addProductToCart(productId, quantity) {
  var htmlContent =
    '<div class="mini-cart-product-card align-items-start d-flex bg-white" style="flex-direction: row;">' +
    '<div class="img-contain overflow-hidden rounded-1">' +
    '<img src="https://media2.giphy.com/media/3oEjI6SIIHBdRxXI40/200w.gif?cid=6c09b9526wp8z3xa5zpbmlfq1qdlzfalio7x1i098u3z18vx&ep=v1_gifs_search&rid=200w.gif&ct=g" alt="<?php echo esc_attr($title); ?>">' +
    "</div>" +
    '<div class="card" aria-hidden="true" style="flex-grow: 1;">' +
    '<div class="card-body">' +
    '<h5 class="card-title placeholder-glow">' +
    '<span class="placeholder col-6"></span>' +
    "</h5>" +
    '<p class="card-text placeholder-glow">' +
    '<span class="placeholder col-7"></span>' +
    '<span class="placeholder col-4"></span>' +
    '<span class="placeholder col-6"></span>' +
    '<span class="placeholder col-4"></span>' +
    "</p>" +
    "</div>" +
    "</div>" +
    "</div>";

  $(".offcanvas-body.ordenList.cart").append(htmlContent);

  var data = {
    action: "woocommerce_ajax_add_to_cart",
    product_id: productId,
    quantity: quantity,
  };

  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: data,
    success: async function (response) {
      var res = JSON.parse(response);
      if (res.status === "success") {
        if (botonCart) {
          var spanElement = document.getElementById("cartItem");

          if (!spanElement) {
            spanElement = document.createElement("span");
            spanElement.id = "cartItem";
            spanElement.className =
              "cart-section-quantity rounded-pill position-absolute center-all text-white";
            spanElement.textContent = "";
            botonCart.appendChild(spanElement);
          } else {
            spanElement.classList.remove("d-none");
          }
        }

        $(".offcanvas-body.ordenList.cart").empty();
        $(".offcanvas-body.ordenList.cart").html(res.html);
        var subtotal = res.subtotal;
        var totalString = res.total;
        var subvalue = getTotalValue(subtotal);
        var value = getTotalValue(totalString);

        discountValue(res);
        $("#cartItem").text(res.quantity);
        $("#subtotal").html("$" + subvalue);
        $("#total").html("$" + value);

        $(".alert.alert-success.add-to-cart-message.d-none").show();

        var alertElement = $("#showAlertAddCart");
        alertElement.removeClass("d-none").show();

        setTimeout(function () {
          alertElement.hide().addClass("d-none");
        }, 500);
      }
    },
  });
}

let isAddingToCart = false; // Bandera para evitar múltiples ejecuciones

function addProductToCartCustom(productId, quantity, buttons) {
  if (isAddingToCart) return; // Evita ejecutar si ya está en proceso
  isAddingToCart = true; // Activa la bandera

  var data = {
    action: "woocommerce_ajax_add_to_cart_category",
    product_id: productId,
    quantity: quantity,
  };

  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: data,
    success: async function (response) {
      var res = JSON.parse(response);
      if (res.status === "success") {
        var spanElement = document.getElementById("cartItem");
        if (spanElement.classList.contains("d-none")) {
          spanElement.classList.remove("d-none");
        }
        $(".offcanvas-body.ordenList.cart").empty().html(res.html);

        var subtotal = res.subtotal;
        var totalString = res.total;
        var subvalue = getTotalValue(subtotal);
        var value = getTotalValue(totalString);

        discountValue(res);

        buttons.forEach(function (button) {
          button.classList.remove("loading", "cfvsw_variation_found");
        });

        $("#cartItem").text(res.quantity);
        $("#subtotal").html("$" + subvalue);
        $("#total").html("$" + value);
      }

      isAddingToCart = false; // Restablece la bandera después de completar la ejecución
    },
    error: function () {
      isAddingToCart = false; // Asegura que la bandera se restablezca en caso de error
    },
  });
}

// <!-- Actualizando carrito   -->
function updateCartContents(succes) {
  if (succes.status === "success") {
    $(".ordenList").html(succes.html);
    $("#cartItem").text(succes.counter);
    var totalString = succes.total;
    var value = getTotalValue(totalString);
    if (window.location.href.indexOf("bolsa-de-compras") > -1) {
      $(".woocommerce-Price-amount.amount").text("$ " + value);
    }

    $("#subtotal, #total").html("$" + value);
  } else {
    alert("Hubo un problema con la operación.");
  }
}

// <!-- Eliminación de articulos del carrito  -->
function trashItem(id, idVariant, tbodyElementCheckout) {
  var data = {
    action: "woocommerce_remove_cart_item",
    cart_item_key: idVariant,
    product_id: id,
  };
  var blockUI = blockUICheckout();
  var button = $(".quam-btn.blue.w-100");
  button.html(
    '<div class="spinner-border text-light" role="status"><span class="sr-only">Eliminando...</span></div>'
  );
  button.css({
    "pointer-events": "none",
    opacity: "0.6",
  });

  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: data,
    success: async function (response) {
      var res = JSON.parse(response);

      if (res.status === "success") {
        updateCartContents(res);
        if (tbodyElementCheckout.length) {
          tbodyElementCheckout.remove();
        }
        if (res.counter === 0) {
          var spanElement = document.getElementById("cartItem");
          if (spanElement) {
            spanElement.classList.add("d-none");
          }
        }
        discountValue(res);

        blockUI.remove();
        if (button) {
          button.html("Finalizar compra");
          button.css({
            "pointer-events": "auto",
            opacity: "1",
          });
        }
      } else {
        alert("Hubo un problema al eliminar el producto del carrito.");
      }
    },
    error: function () {
      alert("Hubo un error con la solicitud AJAX.");
    },
  });
}

// <!-- Bloque de carga para el checkout  -->
function blockUICheckout() {
  var blockUI = $("<div>").addClass("blockUI blockOverlay").css({
    "z-index": "1000",
    border: "none",
    margin: "0px",
    padding: "0px",
    width: "100%",
    height: "100%",
    top: "0px",
    left: "0px",
    background: "rgb(255, 255, 255)",
    opacity: "0.6",
    cursor: "default",
    position: "absolute",
  });

  $(".shop_table.woocommerce-checkout-review-order-table.mb-0").append(blockUI);
  return blockUI;
}

// <!-- Lógica para selección de cantidad de productos  -->
$(document).on("click", ".remove", function () {
  var id = $(this).data("id");
  var idVariant = $(this).data("variant");
  var tbodyElementCheckout = $(this).closest("tbody");
  trashItem(id, idVariant, tbodyElementCheckout);
});

var clickTimeout;

$(document).on("click", ".qtyminus , .qtyplus", function (e) {
  e.preventDefault();
  clearTimeout(clickTimeout);

  var container = $(this).parent().parent().parent();
  var quantityInput = container.find("#singleProductQuantity");
  var currentQuantity = parseInt(quantityInput.val());

  if ($(this).hasClass("qtyminus")) {
    if (currentQuantity > 1) {
      currentQuantity = currentQuantity - 1;
      quantityInput.val(currentQuantity);
    }
  } else if ($(this).hasClass("qtyplus")) {
    if (currentQuantity >= 1) {
      currentQuantity = currentQuantity + 1;
      quantityInput.val(currentQuantity);
    }
  }

  if (currentQuantity >= 1) {
    var totalGeneral = 0;
    $(".mini-cart-product-card").each(function () {
      var priceElement = $(this).find("#price");
      var quantity = $(this).find("#singleProductQuantity");
      if (priceElement[0] !== undefined) {
        var price = parseFloat(
          priceElement[0].innerText.replace(/[^0-9\.]/g, "")
        );
        var quantity = parseInt(quantity[0].value);
        var total = price * quantity;
        totalGeneral += total;
      }
    });
  }
  if (totalGeneral !== undefined) {
    var totalWithThousandSeparator = totalGeneral.toLocaleString("de-DE", {
      minimumFractionDigits: 3,
      maximumFractionDigits: 3,
    });

    $("#subtotal").html("$" + totalWithThousandSeparator);
  }

  var clickedElement = $(this);
  var closestDiv = clickedElement.closest("div");

  // Obtener los atributos data-id y data-variant del contenedor div
  var dataIdCheckout = closestDiv.data("id");
  var dataVariantCheckout = closestDiv.data("variant");

  clickTimeout = setTimeout(function () {
    var finalQuantity = quantityInput.val();
    var trashCart = container.find("#trash_cart");
    var id = trashCart.data("id");
    var variant = trashCart.data("variant");
    var idProduct = variant == 0 ? id : variant;
    if (idProduct == undefined || idProduct == 0) {
      idProduct =
        dataVariantCheckout == 0 ? dataIdCheckout : dataVariantCheckout;
    }

    var data = {
      action: "woocommerce_ajax_add_to_cart_remplace_qty",
      quantity: finalQuantity,
      product_id: idProduct,
    };

    var style = document.createElement("style");
    style.innerHTML = `
    .loaderPrice {
      width: 25px;
      height: 25px;
      
      border: 8px solid #0000001a;
      border-radius: 50%;
      border-right-color: #002d72;
      animation: spin 1s ease infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }`;
    document.head.appendChild(style);

    $("#total").html('<div class="loaderPrice"></div>');
    // var blockUI = blockUICheckout();
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: data,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status === "success") {
          var totalString = res.total;
          var value = getTotalValue(totalString);
          discountValue(res);
          $("#total").html("$" + value);
        } else {
          alert("Hubo un problema al actualizar la cantidad del producto.");
        }
      },
      error: function () {
        alert("Hubo un error con la solicitud AJAX.");
      },
    });
  }, 500);
});

// <!-- Añadiendo a favoritos -->
var botonFav = document.getElementById("bottonFav");

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

// <!-- Eliminación de favoritos en el contexto de favoritos -->
function deleteFavorite(prodid) {
  var sessionFav = JSON.parse(localStorage.getItem("sessionFav")) || [];
  var variationId = $(".variation_id").val();
  var productId = $(".product_id").val();

  var alertElement = $("#showAlertDeleteFavT");
  alertElement.removeClass("d-none").show();

  $.ajax({
    url: ajaxUrl,
    method: "POST",
    data: {
      action: "delete_favorite_product",
      prodid: prodid,
    },
    success: function (res) {
      if (sessionFav.includes(Number(prodid))) {
        sessionFav = sessionFav.filter((item) => item !== Number(prodid));
        localStorage.setItem("sessionFav", JSON.stringify(sessionFav));
      }

      if (res.counter === 0) {
        var spanElement = document.getElementById("favoritesCounter");
        if (spanElement) {
          spanElement.parentNode.removeChild(spanElement);
        }
      }
      var button = $("#add-sprod-favs");
      if (button.hasClass("active-fav")) {
        if (Number(variationId) === prodid || Number(productId) === prodid) {
          button.removeClass("active-fav");
        }
      }

      if ($(".add-fav[data-product-id='" + prodid + "']").length > 0) {
        // Si existe, agrega la clase al elemento específico
        $(".add-fav[data-product-id='" + prodid + "']").removeClass(
          "active-fav"
        );
      }

      alertElement.hide().addClass("d-none");
      $("#favoritesCounter").text(res.counter).removeClass("d-none");
      $(".offcanvas-body.ordenListFav.fav").html(res.html);
    },
  });
}

function initFavoritesPanelDelete() {
  $(document).on("click", "#trash_fav", function () {
    var prodid = $(this).data("id");
    deleteFavorite(prodid);
  });
}

function deleteFavoriteSameContext(prodid) {
  if ($(".add-fav[data-product-id='" + prodid + "']").length > 0) {
    // Si existe, agrega la clase al elemento específico
    $(".add-fav[data-product-id='" + prodid + "']").removeClass("active-fav");
  } else {
    $(".add-fav").removeClass("active-fav");
  }
  deleteFavorite(prodid);
}

var previousValue = $(".variation_id").val();

setInterval(function () {
  var currentValue = $(".variation_id").val();
  if (currentValue != previousValue) {
    previousValue = currentValue;
    $(".add-fav , .single_add_to_cart_button").attr(
      "data-product-id",
      currentValue
    );
  }
}, 100);

initFavoritesPanelDelete();
initAddToFavoriteButton();

function clearEmptyCart() {
  var cartElement = document.querySelector(".offcanvas-body.ordenList.cart");
  cartElement.classList.remove("empty");
}

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname.indexOf("/producto/") === -1) {
    function modifyImageLi(liElement, urlToReplace) {
      var listImageCat = liElement.querySelectorAll(
        "img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail"
      );
      listImageCat.forEach(function (img) {
        var src = img.getAttribute("src");
        // console.log("src", src);
        if (src) {
          img.setAttribute("src", urlToReplace);
        }
      });
    }

    var swatchOptions = document.querySelectorAll(".cfvsw-swatches-option");
    var colorSelect = null;
    var tallaSelect = null;
    swatchOptions.forEach(function (option) {
      option.addEventListener("click", function (event) {
        event.preventDefault();
        // Verificar si el clic es automático
        if (option.dataset.autoClick === "true") {
          delete option.dataset.autoClick; // Eliminar la marca de clic automático
          return; // Salir de la función sin ejecutar el código jQuery AJAX
        }

        var dataSlug = option.getAttribute("data-slug");
        var liElement = option.closest("li");
        if (liElement) {
          var dataId = liElement.getAttribute("data-id-pub");
          var variationsForm = liElement.querySelector(
            ".cfvsw_variations_form.variations_form.cfvsw_shop_align_left.variation-function-added"
          );
          var isTallaOption = option.closest(
            '.cfvsw-swatches-container.cfvsw-shop-container[swatches-attr="attribute_pa_talla"]'
          );
          // Quitar la clase d-none del elemento con la clase cfvsw-swatches-container cfvsw-shop-container y el atributo swatches-attr="attribute_pa_talla"
          var sizeContainer = liElement.querySelector(
            '.cfvsw-swatches-container.cfvsw-shop-container[swatches-attr="attribute_pa_talla"]'
          );
          if (sizeContainer) {
            sizeContainer.classList.remove("d-none");
          }

          if (isTallaOption) {
            tallaSelect = option.getAttribute("data-slug");
          } else {
            colorSelect = dataSlug;
          }

          var productVariations = variationsForm
            ? variationsForm.getAttribute("data-product_variations")
            : null;
          var jsonProducVariations = JSON.parse(productVariations);

          var imageUrl = null;

          jsonProducVariations.forEach(function (variation) {
            var attributes = variation.attributes;
            const variationId = variation.variation_id;

            if (attributes.attribute_pa_color === dataSlug) {
              imageUrl = variation.image.url;
              modifyImageLi(liElement, imageUrl);
            }
          });
        }
      });
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    // Función para obtener el valor de un parámetro de la URL
    function getParameterByName(name) {
      var url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return "";
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // Obtener el valor de filter_color de la URL si existe
    var filterColor = getParameterByName("filter_color");
    var listItems = document.querySelectorAll("li[data-color]");

    listItems.forEach(function (liElement) {
      var dataColor = filterColor || liElement.getAttribute("data-color");
      var swatchOptions = liElement.querySelectorAll(".cfvsw-swatches-option");
      var sizeOptions = liElement.querySelectorAll(
        '.cfvsw-swatches-container.cfvsw-shop-container[swatches-attr="attribute_pa_talla"]'
      );

      // Agregar la clase d-none a los elementos con la clase cfvsw-shop-container
      sizeOptions.forEach(function (sizeOption) {
        sizeOption.classList.add("d-none");
      });

      swatchOptions.forEach(function (option) {
        var dataSlug = option.getAttribute("data-slug");
        // Comparar data-color con data-slug y agregar la clase si coinciden
        if (dataColor === dataSlug) {
          // option.dataset.autoClick = "true"; // Marcar el clic como automático
          // option.click();
          // option.classList.add("cfvsw-selected-swatch");
        } else {
          option.classList.remove("cfvsw-selected-swatch");
        }
      });
    });
  }, 1000);
});

// document.addEventListener("DOMContentLoaded", function () {
//   // Función para modificar el atributo 'src' de las imágenes
//   function modificarImagenes() {
//     var listImageCat = document.querySelectorAll(
//       "img.attachment-full.size-full, img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail"
//     );

//     // Iterar sobre cada imagen y modificar el atributo 'src'
//     listImageCat.forEach(function (img) {
//       var src = img.getAttribute("src");
//       if (src) {
//         // Reemplazar '-300x300' con una cadena vacía
//         var newSrc = src.replace("-300x300", "");
//         img.setAttribute("src", newSrc);
//       }
//     });
//   }
//   var swatchOptions = document.querySelectorAll(
//     ".cfvsw-swatches-option.cfvsw-label-option"
//   );

//   swatchOptions.forEach(function (option) {
//     option.addEventListener("click", function () {
//       // Modificar las imágenes al hacer clic
//       setTimeout(() => {
//         modificarImagenes();
//       }, 100);
//     });
//   });

//   var swatchContainers = document.querySelectorAll(
//     ".cfvsw-swatches-container, .cfvsw-shop-container"
//   );

//   swatchContainers.forEach(function (option) {
//     option.addEventListener("click", function () {
//       // Modificar las imágenes al hacer clic
//       setTimeout(() => {
//         modificarImagenes();
//       }, 100);
//     });
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  var images = document.querySelectorAll(
    ".attachment-woocommerce_thumbnail.size-woocommerce_thumbnail"
  );
  images.forEach(function (img) {
    img.addEventListener("click", function () {
      var href = img.getAttribute("data-href");
      if (href) {
        window.location.href = href;
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const productElements = document.querySelectorAll("li[data-variants]");

  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      // Verifica si el atributo de la imagen cambió
      if (mutation.type === "attributes" && mutation.attributeName === "src") {
        const image = mutation.target;
        let imageUrl = image.src;

        // Si la URL contiene -300x300, quítalo
        if (imageUrl.includes("-300x300")) {
          imageUrl = imageUrl.replace("-300x300", "");
          image.src = imageUrl; // Actualiza la URL de la imagen
        }
      }
    });
  });

  // Seleccionar la imagen a observar (en este caso, todas las imágenes en la página)
  const imagesAll = document.querySelectorAll("img");

  // Configuración del observer
  const config = { attributes: true };

  // Observar cada imagen
  imagesAll.forEach((image) => {
    observer.observe(image, config);
  });

  productElements.forEach((productElement) => {
    const colorButtons = productElement.querySelectorAll(".color-circle");
    const sizeButtonsContainer =
      productElement.querySelector(".size-selection");
    const productImage = productElement.querySelector(".product-image");
    const buttonAddToCart = productElement.querySelector(".add_to_cart_button");
    let selectedColor = null;
    let selectedSize = null;

    colorButtons.forEach((button) => {
      setTimeout(() => {
        buttonAddToCart.classList.remove("cfvsw_variation_found");
      }, 1000);

      button.addEventListener("click", function () {
        // Remover la clase activa de otros botones
        colorButtons.forEach((btn) => btn.classList.remove("active-color"));
        this.classList.add("active-color");
        buttonAddToCart.classList.remove("cfvsw_variation_found");
        selectedColor = this.getAttribute("data-color");
        selectedSize = null; // Resetear la talla seleccionada

        updateSizeButtons(productElement);
        updateProductImage(productElement); // Actualizar la imagen al seleccionar el color
      });
    });

    function updateSizeButtons(productElement) {
      const variants = JSON.parse(productElement.getAttribute("data-variants"));

      // Filtrar variantes por color seleccionado y convertir tallas a mayúsculas
      let sizesForColor = variants
        .filter((variant) => variant.color === selectedColor)
        .map((variant) => variant.size.toUpperCase());

      // Orden específico S, M, L, XL
      const sizeOrder = ["S", "M", "L", "XL"];
      const uniqueSizes = [...new Set(sizesForColor)].sort(
        (a, b) => sizeOrder.indexOf(a) - sizeOrder.indexOf(b)
      );

      // Limpiar el contenedor de tallas
      sizeButtonsContainer.innerHTML = "";

      if (uniqueSizes.length > 0) {
        uniqueSizes.forEach((size) => {
          const sizeButton = document.createElement("button");
          sizeButton.classList.add("size-circle");
          sizeButton.setAttribute("data-size", size);
          sizeButton.textContent = size; // Asegurar que se muestre en mayúsculas

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
});
