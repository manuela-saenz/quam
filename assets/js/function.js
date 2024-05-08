function getTotalValue(totalString) {
  var match = totalString.match(
    /<span class="woocommerce-Price-currencySymbol">[^<]*<\/span>&nbsp;(\d+\.?\d*)/
  );
  var value = match ? match[1] : null;
  return value;
}

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

    // Inserta el HTML antes de la llamada AJAX
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
      success: function (response) {
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
          var totalString = res.total;
          var value = getTotalValue(totalString);
          $("#cartItem").text(res.counter);
          $("#subtotal, #total").html("$" + value);

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

function trashItem(id, idVariant, tbodyElementCheckout) {
  var data = {
    action: "woocommerce_remove_cart_item",
    cart_item_key: idVariant,
    product_id: id,
  };

  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: data,
    success: function (response) {
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
      } else {
        alert("Hubo un problema al eliminar el producto del carrito.");
      }
    },
    error: function () {
      alert("Hubo un error con la solicitud AJAX.");
    },
  });
}

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
  var originalPrice = parseFloat(
    container.find("#price").text().replace("$", "").replace(",", "")
  );
  var priceOriginal = parseInt(container.find("#priceUnit").data("price"));
  let operacion;
  if ($(this).hasClass("qtyminus")) {
    console.log(currentQuantity);
    if (currentQuantity > 1) {
      operacion = originalPrice * (parseInt(quantityInput.val()) - 1);
      currentQuantity = currentQuantity - 1;
      quantityInput.val(currentQuantity);
      originalPrice = originalPrice - priceOriginal;
    }
  } else if ($(this).hasClass("qtyplus")) {
    if (currentQuantity >= 1) {
      operacion = originalPrice * (parseInt(quantityInput.val()) + 1);
      currentQuantity = currentQuantity + 1;
      quantityInput.val(currentQuantity);
      originalPrice = originalPrice + priceOriginal;
    }
  }

  if (currentQuantity > 1) {
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
    var formattedTotal = totalGeneral.toLocaleString("es-CO");
    $("#subtotal, #total").html("$" + formattedTotal);
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

    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: data,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status === "success") {
          var totalString = res.total;
          var value = getTotalValue(totalString);
          $(".quam-btn").prop("disabled", false);
          if (window.location.href.indexOf("bolsa-de-compras") > -1) {
            $(".woocommerce-Price-amount.amount").text("$ " + value);
          }
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

var botonFav = document.getElementById("bottonFav");
function initAddToFavoriteButton() {
  $("#add-sprod-favs , .add-fav").on("click", function (e) {
    e.preventDefault();
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
        if (!sessionFav.includes(productId)) {
          sessionFav.push(Number(productId));
          localStorage.setItem("sessionFav", JSON.stringify(sessionFav));
        }
        $("#add-sprod-favs").addClass("active-fav");
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
        }, 2000);
      },
    });
  });
}

function initFavoritesPanelDelete() {
  $(document).on("click", "#trash_fav", function () {
    var prodid = $(this).data("id");
    var sessionFav = JSON.parse(localStorage.getItem("sessionFav")) || [];
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
            botonFav.removeChild(spanElement);
          }
        }
        $("#favoritesCounter").text(res.counter);
        $(".offcanvas-body.ordenListFav.fav").html(res.html);
      },
    });
  });
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

// <!-- validar los campos identificacion -->
function verificarCamposLlenos() {
  var todosLlenos = true;

  inputForms.forEach(function (inputForm) {
    if (inputForm.value.trim() === "") {
      todosLlenos = false;
    }
  });
  return todosLlenos;
}

function actualizarEstadoBoton() {
  var botonEnviar = document.getElementById("boton-id");
  botonEnviar.disabled = !verificarCamposLlenos();
}

var inputForms = document.querySelectorAll(".input-form-name input");
inputForms.forEach(function (inputForm) {
  inputForm.addEventListener("input", function () {
    actualizarEstadoBoton();
  });
});

actualizarEstadoBoton();

// validar campos de ubicacion
function verificarCamposLlenosUbicacion() {
  var todosLlenosLocation = true;

  inputFormsLocation.forEach(function (inputForm) {
    if (inputForm.value.trim() === "") {
      todosLlenosLocation = false;
    }
  });

  return todosLlenosLocation;
}

function actualizarEstadoBotonLocation() {
  var botonEnviar = document.getElementById("boton-lo");
  botonEnviar.disabled = !verificarCamposLlenosUbicacion();
}

var inputFormsLocation = document.querySelectorAll(
  ".input-form-location input"
);
inputFormsLocation.forEach(function (inputForm) {
  inputForm.addEventListener("input", function () {
    actualizarEstadoBotonLocation();
  });
});

actualizarEstadoBotonLocation();
