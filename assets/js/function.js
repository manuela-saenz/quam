// <!-- Parseando los valores que llegan de Woocomerce desde etiquetas   -->
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

    var quantity = form.find("input.input-text.qty.text").val();
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
            }
          }
          $(".offcanvas-body.ordenList.cart").empty();
          $(".offcanvas-body.ordenList.cart").html(res.html);
          var subtotal = res.subtotal;
          var totalString = res.total;
          var subvalue = getTotalValue(subtotal);
          var value = getTotalValue(totalString);

          discountValue(res);
          $("#cartItem").text(res.counter);
          $("#subtotal").html("$" + subvalue);
          $("#total").html("$" + value);

          $(".alert.alert-success.add-to-cart-message.d-none").show();

          var alertElement = $("#showAlertAddCart");
          alertElement.removeClass("d-none").show();

          setTimeout(function () {
            alertElement.hide().addClass("d-none");
          }, 2000);
        }
      },
    });
  });
});

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
            botonCart.removeChild(spanElement);
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
        ? $("[name='add-to-cart']")[0].value
        : productId;

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

        $(".add-fav").addClass("active-fav");

        var spanElement = document.getElementById("favoritesCounter");

        if (!spanElement) {
          spanElement = document.createElement("span");
          spanElement.id = "favoritesCounter";
          spanElement.className =
            "cart-section-quantity rounded-pill position-absolute center-all text-white";
          spanElement.textContent = "";
          botonFav.appendChild(spanElement);
        }

        $("#favoritesCounter").text(res.counter);
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
      $("#favoritesCounter").text(res.counter);
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
  $(".add-fav").removeClass("active-fav");
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
