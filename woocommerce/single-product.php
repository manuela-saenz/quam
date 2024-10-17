<?php
get_header();

global $post;
$product = wc_get_product($post);
$categories = get_the_terms($product->get_id(), 'product_cat');
$category = $categories[0]->name;
$terms = get_the_terms($post->ID, 'product_cat');
$produts_use = get_the_terms($post->ID, 'product_tag');

$attachment_ids = $product->get_gallery_image_ids();


$attributes = $product->get_attributes();
if ($attachment_ids) {
  foreach ($attachment_ids as $attachment_id) {
    $images[] = wp_get_attachment_image_url($attachment_id, "large");
  };
}

// echo '<pre>';
// print_r($product);
// echo '<pre>';
// Iterar sobre cada atributo

?>

<div id="showAlertAddCart" class="alert alert-success add-to-cart-message d-none" style="position: fixed;z-index: 60;top: 110px;left: 50%;transform: translateX(-50%);">Producto agregado al carrito.
</div>
<div id="showAlertAddFav" class="alert alert-success add-to-list-fav-message d-none" style="position: fixed;z-index: 60;top: 110px;left: 50%;transform: translateX(-50%);">Lista de productos favoritos
  actualizada correctamente.</div>
<div id="showAlertDeleteFav" class="alert alert-danger add-to-list-fav-message d-none" style="position: fixed;z-index: 60;top: 110px;left: 50%;transform: translateX(-50%);">Se eliminó el producto de tus
  favoritos</div>
<div id="showAlertItemOut" class="alert alert-danger add-to-list-fav-message d-none" style="position: fixed;z-index: 9999;top: 110px;left: 50%;transform: translateX(-50%);">El producto seleccionado se encuentra agotado</div>
<section id="Singleimgprincipal" class="pt-0">
  <div class="py-2 px-2 border-top border-bottom">
    <div class="container">
      <?php woocommerce_breadcrumb() ?>
    </div>
  </div>
  <div class="container">
    <?php woocommerce_content(); ?>
  </div>
</section>

<div class="sm-floating-box swipe-animation">
  <div id="box-draggable2">
    <div class="bg-white mobile-container">
      <div class="main-box d-lg-none p-3 py-4">
        <div class="d-flex justify-content-between mb-2">
          <div class="">
            <h1 class="section-subtitle mb-1"><?= $post->post_title ?></h1>
            <div class="d-flex align-items-center price">
              <?= $product->get_price_html() ?>
            </div>
          </div>
          <button class="button-heart add-fav" data-product-id="0" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
            </svg>
          </button>
        </div>
        <button id="btn-single-mobile" class="quam-btn red d-lg-none open-selector w-100 sm-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Agregar a la bolsa</button>
        <!-- <div class=" center-vertical justify-content-center mt-2 opacity-50 fw-medium gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-up">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 11l5 -5l5 5" />
            <path d="M7 17l5 -5l5 5" />
          </svg>
          Más información
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chevrons-up">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 11l5 -5l5 5" />
            <path d="M7 17l5 -5l5 5" />
          </svg>
        </div> -->
      </div>
      <div class="d-md-none container">
        <p> <?= $product->get_short_description() ?></p>
      </div>
      <section class="characteristics">
        <div class="container">
          <?php woocommerce_output_product_data_tabs() ?>
        </div>
      </section>
      <?php woocommerce_output_related_products() ?>
      <section class=" d-md-none">
        <?php itemsFooter() ?>
      </section>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      var swatch = event.target.closest('.cfvsw-swatches-disabled');
      if (swatch) {
        var alertElement = document.getElementById('showAlertItemOut');
        alertElement.classList.remove('d-none');
        setTimeout(function() {
          alertElement.classList.add('d-none');
        }, 3000);
      }
    });
  });
</script>
<?php get_footer() ?>