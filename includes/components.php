<?php

function productCard($product)
{
  $wcProd = wc_get_product($product);
  // echo "<pre>";
  // print_r($product->id);
  // echo "</pre>";
  $product_status = $wcProd->get_stock_status();
?>
  <a href="<?= get_permalink($product->ID) ?>" class="CardProducts <?= $product_status ?>">
    <div class="img-contain" title="<?= get_the_title($product) ?>">
      <?= $wcProd->get_image('medium', 'alt=' . get_the_title())   ?>
    </div>
    <div class="info-highlights">
      <h5 title="<?= get_the_title() ?>"><?= get_the_title($product) ?></h5>
      <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
        <p class=" mb-0 d-flex gap-2"><?= $wcProd->get_price_html() .  "COP" ?> </p>
      </div>
    </div>
  </a>
<?php
}


function desplegableProductos($titulo, $tipoDeLista)
{
?>
  <div class="offcanvas offcanvas-end shopping-bag-offcanvas" tabindex="-1" id="<?= $tipoDeLista ?>" aria-labelledby="<?= $tipoDeLista ?>-label">
    <div class="offcanvas-header center-vertical justify-content-start border-bottom border-light">
      <button type="button" class="btn-close me-3" data-bs-dismiss="offcanvas" aria-label="Close"><img src="<?php bloginfo('template_url') ?>/media/images/x.svg" alt=""></button>
      <h5 class="offcanvas-title" id="<?= $tipoDeLista ?>-label"><?= $titulo ?></h5>
    </div>

    <?php if ($tipoDeLista == 'mini-carrito') { ?>
      <div class="offcanvas-body ordenList cart empty">
        <?php get_template_part("templates/components/mini", "cart") ?>
      </div>
      <div class="offcanvas-footer">
        <?php
        $total = WC()->cart->get_cart_total();
        ?>
        <div class="">
          <div class="d-flex justify-content-between mb-2">
            <p class="fs-6"> Subtotal</p>
            <p class="fs-6" id="subtotal"><?php wc_cart_totals_subtotal_html() ?></p>
          </div>
          <?php // echo woocommerce_cart_totals_before_order_total();
          ?>
          <?php foreach (WC()->cart->get_coupons() as $code => $coupon) :
            if (is_string($coupon)) {
              $coupon = new WC_Coupon($coupon);
            }
            // echo '<div class="d-none">';
            // echo 'pre';
            // print_r($coupon);
            // echo 'pre';
            // echo '</div>';
          ?>

            <div class="cart-discount d-flex justify-content-between coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
              <p class="text-capitalize"><?= ($coupon->get_code()); ?></p>
              <span><?= wc_cart_totals_coupon_html($coupon); ?></span>
            </div>
          <?php endforeach; ?>
          <div class="d-flex justify-content-between mb-2">
            <p class="fs-4"> <b>Total</b> </p>
            <p class="fs-4"> <b id="total"><?= $total; ?></b> </p>
          </div>
        </div>
        <a href="<?= get_permalink(wc_get_page_id('checkout')) ?>" class="quam-btn blue w-100">Finalizar compra</a>
      </div>
    <?php } elseif ($tipoDeLista == 'mini-favoritos') { ?>
      <div id="showAlertDeleteFavT" class="alert alert-warning add-to-list-fav-message d-flex d-none" style="position: relative; top: 5px; width: auto;">
      <span style="width: 50%; text-align: right; padding-right: 10px; font-weight: bold;">Eliminando favorito</span>
        <span class="loading-icon" style="width: 100%; display: inline-block; margin-left: 0px; width: 20px; height: 20px; border: 4px solid #001639; border-top: 4px solid #fff; border-radius: 50%; animation: spin 1s linear infinite;"></span>
      </div>

      <style>
        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }

          100% {
            transform: rotate(360deg);
          }
        }
      </style>
      <div class="offcanvas-body ordenListFav fav">
        <?php get_template_part("templates/components/mini", "favs") ?>
      </div>
      <!-- <button class="quam-btn blue w-100">Pasar a carrito</button> -->
    <?php } ?>
  </div>

  <script>
    var cartElement = document.querySelector(".offcanvas-body.ordenList.cart");
    if (cartElement && cartElement.children.length == 0) {
      var discountDiv = document.querySelector(".cart-discount");
      if (discountDiv) {
        discountDiv.remove();
      }
    }
  </script>

<?php } ?>