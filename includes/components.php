<?php

function productCard($product)
{
  $wcProd = wc_get_product($product);
  // echo "<pre>";
  // print_r($product->id);
  // echo "</pre>";
  $product_status = $wcProd->get_stock_status();
  if (is_front_page()) {
    $title = get_the_title($product);
  } else {
    $title = get_the_title();
  }
?>
  <a href="<?= get_permalink($product->ID) ?>" class="CardProducts <?= $product_status ?>">
    <div class="img-contain" title="<?= $title ?>">
      <?= $wcProd->get_image('medium', 'alt=' . $title)   ?>
    </div>
    <div class="info-highlights">
      <div class=" d-flex flex-column flex-md-row justify-content-center justify-content-md-between w-100">
        <h5 title="<?= $title ?>"><?= $title ?></h5>

        <div class=" mb-0 d-flex gap-2 price"><?= $wcProd->get_price_html() ?> </div>
      </div>
    </div>
  </a>
<?php
}


function itemsFooter()
{ ?>
  <div class="container">
    <div class="row gap-3 gap-md-0">
      <div class="col-md-3">
        <a href="https://www.quam.com.co/metodos-de-pago/" class=" info-item d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
          <div class="icon-circle mb-3 p-2 rounded-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-mastercard">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
              <path d="M12 9.765a3 3 0 1 0 0 4.47" />
              <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
            </svg>
          </div>
          <p class="mb-0">Múltiples medios de pago</p>
        </a>
      </div>
      <div class="col-md-3">
        <a href="https://www.quam.com.co/cambios-y-devoluciones/" class=" info-item d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
          <div class="icon-circle mb-3 p-2 rounded-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exchange">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M5 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M19 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
              <path d="M19 8v5a5 5 0 0 1 -5 5h-3l3 -3m0 6l-3 -3" />
              <path d="M5 16v-5a5 5 0 0 1 5 -5h3l-3 -3m0 6l3 -3" />
            </svg>
          </div>
          <p class="mb-0">Cambios y devoluciones</p>
        </a>
      </div>
      <div class="col-md-3">
        <div role="button" class=" info-item d-flex flex-column center-all bg-light rounded-3 fw-medium p-4" data-bs-toggle="modal" data-bs-target="#trackModal">
          <div class="icon-circle mb-3 p-2 rounded-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
              <path d="M12 12l8 -4.5" />
              <path d="M12 12l0 9" />
              <path d="M12 12l-8 -4.5" />
              <path d="M16 5.25l-8 4.5" />
            </svg>
          </div>
          <p class="mb-0">Rastrea tu paquete</p>
        </div>
      </div>
      <div class="col-md-3">
        <a href="https://www.quam.com.co/contacto/" class=" info-item d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
          <div class="icon-circle mb-3 p-2 rounded-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
              <path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" />
              <path d="M12.5 15.5l2 2" />
              <path d="M15 13l2 2" />
            </svg>
          </div>
          <p class="mb-0">¿Necesitas ayuda?</p>
        </a>
      </div>


    </div>
  </div>
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
      <div id="cartSub" class="offcanvas-body ordenList cart">
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