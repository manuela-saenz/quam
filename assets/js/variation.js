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
    var productVariations = form.data("product_variations");
    var color = $("select#pa_color").val();
    var talla = $("select#pa_talla").val();
    var data = {};
    var quantity = form.find("input.input-text.qty.text").val();

    if (productVariations === undefined || productVariations.length === 0) {
      var submitValue = $(
        ".single_add_to_cart_button.quam-btn.blue.button.alt"
      ).val();
      data = {
        action: "woocommerce_ajax_add_to_cart",
        product_id: submitValue,
        quantity: quantity,
      };
    } else {
      productVariations.forEach((variation) => {
        if (
          variation.attributes.attribute_pa_color === color &&
          variation.attributes.attribute_pa_talla === talla
        ) {
          data = {
            action: "woocommerce_ajax_add_to_cart",
            product_id: variation.variation_id,
            quantity: quantity,
          };
        }
      });
    }

    console.log(data);
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: data,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status === "success") {
          // updateCartContents(res);
          document
            .querySelector(".offcanvas.offcanvas-end.shopping-bag-offcanvas")
            .classList.add("show");
          $(".ordenList").html(res.html);
          var totalString = res.total;
          var value = getTotalValue(totalString);

          $("#subtotal, #total").html("$" + value);
        }
      },
    });
  });
});

function updateCartContents(succes) {
  if (succes.status === "success") {
    $(".ordenList").html(succes.html);
    var totalString = succes.total;
    var value = getTotalValue(totalString);
    $("#subtotal, #total").html("$" + value);
  } else {
    alert("Hubo un problema con la operación.");
  }
}

function trashItem(id) {
  var data = {
    action: "woocommerce_remove_cart_item",
    cart_item_key: id,
  };

  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: data,
    success: function (response) {
      var res = JSON.parse(response);
      if (res.status === "success") {
        updateCartContents(res);
        console.log(res);
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
  trashItem(id);
});

function updatePriceTimeReal() {
  var total = 0;

  $("p#price").each(function () {
    var price = parseFloat($(this).text().replace("$", "").replace(",", ""));
    total += price;
  });

  console.log(total);
}

var clickTimeout;

$(document).on("click", ".qtyminus, .qtyplus", function () {
  clearTimeout(clickTimeout);

  var container = $(this).closest(".select-bag.d-flex.bg-white");
  var quantityInput = container.find("#singleProductQuantity");
  var currentQuantity = parseInt(quantityInput.val());
  var originalPrice = parseFloat(
    container.find("#price").text().replace("$", "").replace(",", "")
  );
  var originalRegularPrice = parseFloat(
    container.find("#regular_price").text().replace("$", "").replace(",", "")
  );
  var priceOriginal = parseInt(container.find("#priceUnit").data("price"));

  if ($(this).hasClass("qtyminus") && currentQuantity > 1) {
    currentQuantity = currentQuantity - 1;
    quantityInput.val(currentQuantity);
    originalPrice = originalPrice - priceOriginal;
    originalRegularPrice = originalRegularPrice - priceOriginal;
    container
      .find("#price")
      .text("$" + originalPrice.toLocaleString("en-US", {}));
    container
      .find("#regular_price")
      .text("$" + originalRegularPrice.toLocaleString("en-US", {}));
  } else if ($(this).hasClass("qtyplus")) {
    currentQuantity = currentQuantity + 1;
    quantityInput.val(currentQuantity);
    originalPrice = originalPrice + priceOriginal;
    originalRegularPrice = originalRegularPrice + priceOriginal;
    container
      .find("#price")
      .text("$" + originalPrice.toLocaleString("en-US", {}));
    container
      .find("#regular_price")
      .text("$" + originalRegularPrice.toLocaleString("en-US", {}));
  }
  $(".quam-btn").prop("disabled", true);

  var total = 0;

  $(".select-bag.d-flex.bg-white").each(function () {
    var priceElement = $(this).find(".d-flex.align-items-center.price p#price");
    var price = parseFloat(priceElement[0].innerText.replace(/[^0-9\.]/g, "")); // Esto elimina cualquier carácter que no sea un número o un punto
    total += price;
  });

  var formattedTotal = total.toLocaleString('es-CO');
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
  $("#add-sprod-favs").on("click", function (e) {
    e.preventDefault();

    var prodid = $(this).data("product-id");
    var sessionName = "prodsfavs";

    var loaderContainer = $("#prodSingleLoader_" + prodid);

    loaderContainer.removeClass("hide-loader");

    if ($(this).hasClass("single-prod-addfav")) {
      $(this)
        .children("i")
        .addClass("icon-like")
        .removeClass("icon-like_outline");
    }

    $.ajax({
      url: ajaxUrl,
      method: "POST",
      data: {
        action: "add_product_to_favorites",
        prodid: prodid,
      },
      success: function (res) {
        loaderContainer.addClass("hide-loader");
        var res = JSON.parse(res);
        $("#favoritesPanelHead").html(res.html);
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

function initFavoritesPanel() {
  $(".borrar-favorito").on("click", function () {
    var prodid = $(this).data("prodid");

    $.ajax({
      url: ajaxUrl,
      method: "POST",
      data: {
        action: "delete_favorite_product",
        prodid: prodid,
      },
      success: function (res) {
        $("#favoritesPanelHead").html(res["html"]);
        if (res["counter"] < 1) {
          $("#favoritesCounter").addClass("d-none");
        } else {
          $("#favoritesCounter").text(res["counter"]).removeClass("d-none");
        }
        initFavoritesPanel();
      },
    });
  });
}

initAddToFavoriteButton();
