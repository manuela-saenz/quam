<?php

function productCard($product)
{
  $wcProd = wc_get_product($product);
  // echo "<pre>";
  // print_r($product->id);
  // echo "</pre>";
?>
    <a href="<?= get_permalink($wcProd->id) ?>" class="CardProducts <?= $wcProd->get_sale_price()  ? 'CardOffers' : '' ?>">
      <div class="img-contain" title="<?= $product->get_name() ?>">
        <img src="<?= $product->image_src ?>" alt="<?= $product->get_name() ?>">
      </div>
      <div class="info-highlights">
        <h5 title="<?= $product->get_name() ?>"><?= $product->get_name(); ?></h5>
        <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
          <p class=" mb-0 d-flex gap-2"><?= wc_price($wcProd->price) . "COP" ?> </p>
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
      <button type="button" class="btn-close me-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <h5 class="offcanvas-title" id="<?= $tipoDeLista ?>-label"><?= $titulo ?></h5>
    </div>

    <?php if ($tipoDeLista == 'mini-carrito') { ?>
      <div class="offcanvas-body ordenList cart">
        <?php
        get_template_part("templates/components/mini", "cart") ?>
      </div>
      <div class="offcanvas-footer">
        <?php
        $total = WC()->cart->get_cart_total();
        ?>
        <div class="">
          <div class="d-flex justify-content-between mb-2">
            <p class="fs-6"> Subtotal</p>
            <p class="fs-6" id="subtotal"><?= $total; ?></p>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <p class="fs-4"> <b>Total</b> </p>
            <p class="fs-4"> <b id="total"><?= $total; ?></b> </p>
          </div>
        </div>
        <a href="<?= get_permalink(wc_get_page_id( 'checkout' )) ?>" class="quam-btn blue w-100">Finalizar compra</a>
      </div>
    <?php } elseif ($tipoDeLista == 'mini-favoritos') { ?>
      <div class="offcanvas-body ordenListFav fav">
        <?php get_template_part("templates/components/mini", "favs") ?>
      </div>
      <!-- <button class="quam-btn blue w-100">Pasar a carrito</button> -->
    <?php } ?>
  </div>

<?php } ?>