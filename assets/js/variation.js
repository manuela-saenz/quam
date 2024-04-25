function getTotalValue(totalString) {
  var match = totalString.match(
    /<span class="woocommerce-Price-currencySymbol">[^<]*<\/span>&nbsp;(\d+\.?\d*)/
  );
  var value = match ? match[1] : null;
  return value;
}

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
          $(".offcanvas-body.ordenList.cart").html(res.html);
          var totalString = res.total;
          var value = getTotalValue(totalString);
          $("#cartItem").text(res.counter);
          $("#subtotal, #total").html("$" + value);
          // Muestra el mensaje de éxito
          $(".alert.alert-success.add-to-cart-message.d-none").show();

          var alertElement = $("#showAlertAddCart");
          console.log(alertElement)
          alertElement.removeClass("d-none").show();

          // Oculta el mensaje de éxito después de 5 segundos y añade la clase 'd-none'
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

$(".qtyminus , .qtyplus").on("click", function () {
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
    console.log(originalPrice * (parseInt(quantityInput.val()) - 1), 'total')
    operacion = originalPrice *  (parseInt(quantityInput.val()) - 1);
    // currentQuantity = currentQuantity - 1;
    // quantityInput.val(currentQuantity);
    originalPrice = originalPrice - priceOriginal;
    // originalRegularPrice = originalRegularPrice - priceOriginal;
    // container
    //   .find("#price")
    //   .text("$" + originalPrice.toLocaleString("en-US", {}));
    // container
    //   .find("#regular_price")
    //   .text("$" + originalRegularPrice.toLocaleString("en-US", {}));
  } else if ($(this).hasClass("qtyplus")) {
    console.log(originalPrice *  (parseInt(quantityInput.val()) + 1), 'total')
    operacion = originalPrice *  (parseInt(quantityInput.val()) + 1);
    // currentQuantity = currentQuantity + 1;
    // quantityInput.val(currentQuantity);
    originalPrice = originalPrice + priceOriginal;
    // originalRegularPrice = originalRegularPrice + priceOriginal;
    // container
    //   .find("#price")
    //   .text("$" + originalPrice.toLocaleString("en-US", {}));
  //   container
  //     .find("#regular_price")
  //     .text("$" + originalRegularPrice.toLocaleString("en-US", {}));
  }
  $(".quam-btn").prop("disabled", true);

  var total = 0;
    var getTotal = parseInt($('#total').text().replace("$", "").replace(",", "")) 
    console.log(getTotal)
    getTotal += operacion;
  // $(".mini-cart-product-card").each(function () {
  //   var priceElement = $(this).find("#price");
  //   if (priceElement[0] !== undefined) {
  //     if (priceElement[0].innerText !== "") {
  //       var price = parseFloat(
  //         priceElement[0].innerText.replace(/[^0-9\.]/g, "")
  //       );
  //       total += price;
  //     }
  //   }
  // });

  var formattedTotal = getTotal.toLocaleString("es-CO");
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

function initAddToFavoriteButton() {
  $("#add-sprod-favs , .add-fav").on("click", function (e) {
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
        console.log(res.counter);
        $("#favoritesCounter").text(res.counter);
        $(".offcanvas-body.ordenList.fav").html(res.html);
        var alertElement = $("#showAlertAddFav");
          console.log(alertElement)
          alertElement.removeClass("d-none").show();

          // Oculta el mensaje de éxito después de 5 segundos y añade la clase 'd-none'
          setTimeout(function () {
            alertElement.hide().addClass("d-none");
          }, 2000);
        // $("#favoritesCounter").text(res["counter"]).removeClass("d-none");
        // initFavoritesPanel();

        // $("#tiendaAddProductToCartAlert").addClass("show");
        // setTimeout(function () {
        //   $("#tiendaAddProductToCartAlert").removeClass("show");
        // }, 3500);
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
        $("#favoritesCounter").text(res.counter);
        console.log(res.html);
        $(".offcanvas-body.ordenList.fav").html(res.html);
      },
    });
  });
}
initFavoritesPanelDelete();

initAddToFavoriteButton();
