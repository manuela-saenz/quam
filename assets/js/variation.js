jQuery(document).ready(function ($) {
  $("form.cart").on("submit", function (e) {
    e.preventDefault();

    var form = $(this);
    var productVariations = form.data("product_variations");
    var color = $("select#pa_color").val();
    var talla = $("select#pa_talla").val();
    var data = {};
    var quantity = form.find("input.input-text.qty.text").val();

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

    console.log(data);
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: data,
      success: function (response) {
        var res = JSON.parse(response);
        console.log(res);
        if (res.status === "success") {
          // updateCartContents(res);
          document
            .querySelector(".offcanvas.offcanvas-end.shopping-bag-offcanvas")
            .classList.add("show");
          $(".ordenList").html(res.html);
          console.log(res.total);
        }
      },
    });
    // console.log(form, color, talla, quantity);
    // form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

    // $.post(wc_add_to_cart_params.ajax_url, data, function(response) {
    //     if (!response) {
    //         return;
    //     }

    //     var this_page = window.location.toString();
    //     this_page = this_page.replace('add-to-cart', 'added-to-cart');

    //     if (response.error && response.product_url) {
    //         window.location = response.product_url;
    //         return;
    //     }

    //     // Redirect to cart option
    //     if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
    //         window.location = wc_add_to_cart_params.cart_url;
    //         return;
    //     }

    //     // Reload page
    //     window.location = this_page;
    // });
  });
});

function updateCartContents(succes) {
  if (succes.status === "success") {
    $(".ordenList").html(succes.html);
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
      } else {
        alert("Hubo un problema al eliminar el producto del carrito.");
      }
    },
    error: function () {
      alert("Hubo un error con la solicitud AJAX.");
    },
  });
}

// jQuery(document).ready(function ($) {
//   $(".remove").on("click", function (e) {
//     e.preventDefault();

//     var id = $(this).data("id");
//     trashItem(id);
//   });
// });

$(document).on("click", ".remove", function () {
  var id = $(this).data("id");
  trashItem(id);
});
