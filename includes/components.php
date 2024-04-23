<?php

function productCard($product)
{
  $wcProd = wc_get_product($product);
?>

  <?php
  if ($wcProd->get_sale_price()) {
  ?>
    <a href="https://www.quam.com.co/web_quam/producto/<?php echo $product->get_slug() ?>/" class="CardProducts <?= $wcProd->get_sale_price()  ? 'CardOffers' : '' ?>">
      <div class="img-contain">
        <img src="<?php echo $product->image_src ?>" alt="<?php echo $product->get_name() ?>">
      </div>
      <div class="info-highlights">
        <h5><?php echo $product->get_name(); ?></h5>
        <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">

          <?php
          if ($wcProd->get_sale_price()) {
          ?>

            <span class=""><?= $wcProd->get_sale_price(), "COP" ?> </span>

          <?php
          }
          ?>
          <p class=" mb-0 <?= $wcProd->get_sale_price()  ? 'regular-price' : '' ?>"> <?= $wcProd->get_regular_price(), "COP" ?> </p>
        </div>
      </div>
    </a>
  <?php
  } else {
  ?>
    <a href="https://www.quam.com.co/web_quam/producto/<?php echo $product->get_slug() ?>/" class="CardProducts ">
      <div class="img-fit">
        <img src="<?php echo $product->image_src ?>" alt="<?php echo $product->get_name() ?>">
      </div>
      <div class="info-highlights">
        <h5><?php echo $product->get_name(); ?></h5>
        <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">

          <?php
          if ($wcProd->get_sale_price()) {
          ?>

            <span class=""><?= $wcProd->get_sale_price(), "COP" ?> </span>

          <?php
          }
          ?>
          <span class=" mb-0 <?= $wcProd->get_sale_price()  ? 'regular-price' : '' ?>"> <?= $wcProd->get_regular_price(), "COP" ?> </span>
        </div>
      </div>
    </a>
<?php
  }
}
?>