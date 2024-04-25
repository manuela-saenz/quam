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
          // Si el botón existe, procede a agregar el elemento span
          if (botonCart) {
            // Verifica si el elemento span con ID "cartItem" ya existe dentro del botón
            var spanElement = document.getElementById("cartItem");

            // Si el elemento span no existe, entonces lo crea y lo agrega al botón
            if (!spanElement) {
              spanElement = document.createElement("span");
              spanElement.id = "cartItem";
              spanElement.className =
                "cart-section-quantity rounded-pill position-absolute center-all text-white";
              spanElement.textContent = ""; // Agrega el texto dinámico aquí
              botonCart.appendChild(spanElement);
            }
          }

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
    $("#subtotal, #total").html("$" + value);
  } else {
    alert("Hubo un problema con la operación.");
  }
}

function trashItem(id, idVariant) {
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
  trashItem(id, idVariant);
});

var clickTimeout;

$(document).on("click", ".qtyminus , .qtyplus", function () {
  clearTimeout(clickTimeout);

  var container = $(this).parent().parent().parent();
  var quantityInput = container.find("#singleProductQuantity");
  var currentQuantity = parseInt(quantityInput.val());
  var originalPrice = parseFloat(
    container.find("#price").text().replace("$", "").replace(",", "")
  );
  // var originalRegularPrice = parseFloat(
  //   container.find("#regular_price").text().replace("$", "").replace(",", "")
  // );
  var priceOriginal = parseInt(container.find("#priceUnit").data("price"));
  let operacion;
  if ($(this).hasClass("qtyminus")) {
    if (currentQuantity > 1) {
      // console.log(originalPrice * (parseInt(quantityInput.val()) - 1), "total");
      operacion = originalPrice * (parseInt(quantityInput.val()) - 1);
      currentQuantity = currentQuantity - 1;
      quantityInput.val(currentQuantity);
      originalPrice = originalPrice - priceOriginal;
      // originalRegularPrice = originalRegularPrice - priceOriginal;
      // container
      //   .find("#price")
      //   .text("$" + originalPrice.toLocaleString("en-US", {}));
      // container
      //   .find("#regular_price")
      //   .text("$" + originalRegularPrice.toLocaleString("en-US", {}));
    }
  } else if ($(this).hasClass("qtyplus")) {
    if (currentQuantity >= 1) {
      // console.log(originalPrice * (parseInt(quantityInput.val()) + 1), "total");
      operacion = originalPrice * (parseInt(quantityInput.val()) + 1);
      currentQuantity = currentQuantity + 1;
      quantityInput.val(currentQuantity);
      originalPrice = originalPrice + priceOriginal;
      // originalRegularPrice = originalRegularPrice + priceOriginal;
      // container
      //   .find("#price")
      //   .text("$" + originalPrice.toLocaleString("en-US", {}));
      // container
      //   .find("#regular_price")
      //   .text("$" + originalRegularPrice.toLocaleString("en-US", {}));
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
        // if (priceElement[0].innerText !== "") {
        //   var price = parseFloat(
        //     priceElement[0].innerText.replace(/[^0-9\.]/g, "")
        //   );
        //   total += price;
        // }
      }
    });
  }

  var formattedTotal = totalGeneral.toLocaleString("es-CO");
  $("#subtotal, #total").html("$" + formattedTotal);

  clickTimeout = setTimeout(function () {
    var finalQuantity = quantityInput.val();
    var trashCart = container.find("#trash_cart");
    var id = trashCart.data("id");
    var variant = trashCart.data("variant");
    var idProduct = variant == 0 ? id : variant;
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
          console.log(value);
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
  $("#add-sprod-favs").on("click", function (e) {
    e.preventDefault();
    var productId = $(".variation_id").val();
    productId =
      productId == undefined || productId == 0
        ? $("[name='add-to-cart']")[0].value
        : productId;

    $.ajax({
      url: ajaxUrl,
      method: "POST",
      data: {
        action: "add_product_to_favorites",
        prodid: productId,
      },
      success: function (res) {
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

    $.ajax({
      url: ajaxUrl,
      method: "POST",
      data: {
        action: "delete_favorite_product",
        prodid: prodid,
      },
      success: function (res) {
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
initFavoritesPanelDelete();

initAddToFavoriteButton();
