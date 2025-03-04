<?php
get_header();

$banners  = (new WP_Query(array(
  'post_type' => 'banner',
  'posts_per_page' => -1,

)))->posts;

?>
<section id="banner">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="swiper banner">
          <div class="swiper-wrapper">
            <?php foreach ($banners as $banner) :
              $variableImage = get_field('imagen_adaptable', $banner);
            ?>
              <div class="swiper-slide overflow-hidden <?= $variableImage ? 'p-0 variable-slide' : '' ?>">
                <?php if ($variableImage) { ?>
                  <a href="<?= $banner->btn_url ?>" class="img-contain variable position-relative start-0 top-0 w-100" style="transform: none;">
                    <picture class="w-100">
                      <source media="(min-width: 1024px)" srcset="<?= $variableImage['imagen_pc']['url'] ?>" />
                      <source media="(min-width: 578px)" srcset="<?= $variableImage['imagen_tablet']['url'] ?>" />
                      <source media="(max-width: 578px)" srcset="<?= $variableImage['imagen_celular']['url'] ?>" />
                      <img src="<?= $variableImage['imagen_pc']['url'] ?>" alt="<?= $banner->post_title ?>" />
                    </picture>
                  </a>
                <?php } else { ?>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-6 col-xxl-6 offset-xxl-1 " style="z-index: 3;">
                        <div class="info-banner">
                          <h1 class="section-title"><?= $banner->post_title ?></h1>
                          <a href="<?= $banner->btn_url ?>" class="quam-btn red">Ver ofertas</a>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="img-contain">
                          <img src="<?= get_the_post_thumbnail_url($banner->ID) ?>" title="<?= $banner->post_title ?>" alt="<?= $banner->post_title ?>" loading="lazy">
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="swiperBanner-button-next"> <i class="icon-arrowlongline-right"></i> </div>
          <div class="swiperBanner-button-prev"> <i class="icon-arrowlongline-left"></i> </div>
        </div>
      </div>
    </div>
</section>

<section id="categories" class="overflow-hidden pt-0">
  <div class="container-fuid p-0">
    <div class="row center-all">
      <?php $categories = get_terms(array(
        "taxonomy" => "product_cat",
        "parent" => 0,
        'exclude'    => array(26, 15),
        // "hide_empty" => false,
      ));
      foreach ($categories as $cat) :
        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $thumbUrl = wp_get_attachment_image_url($thumbnail_id, "large");
      ?>

        <div class="col p-0 position-relative">
          <div class="card-categories d-flex position-relative overflow-hidden">
            <a href="<?= get_term_link($cat->term_id) ?>" class="img-fit w-100 h-100">
              <img src="<?= $thumbUrl ?>" title="<?= $cat->name ?>" alt="<?= $cat->name ?>" loading="lazy">
            </a>
            <a href="<?= get_term_link($cat->term_id) ?>" class="info-categories center-all flex-column position-absolute">
              <h5><?= $cat->name ?></h5>
              <div class="red">Ver colección</div>
            </a>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="generation">
  <div class="container slideGeneration">
    <div class="row ">
      <div class="col-xxl-3 col-md-12 col-md-4 position-relative z-2 center-vertical">
        <div>
          <?php
          $catalog_title = get_field('desc');
          ?>

          <h3 class="section-subtitle mb-4"><?php echo esc_html($catalog_title); ?></h3>
          <div class="d-xl-flex gap-2 d-none">
            <div class="arrow-prev-container">
              <button class="generation-arrows prev">
                <i class="icon-arrowline-left"> </i>
              </button>
            </div>
            <div class="arrow-next-container">
              <button class="generation-arrows next">
                <i class="icon-arrowline-right"> </i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-9 col-md-12 ">
        <div class="swiper generationSwiper">
          <div class="swiper-wrapper">
            <?php
            $products = new WP_Query(array(
              'post_type'      => 'product',
              'posts_per_page' => 10,
            ));
            if ($products->have_posts()) :
              while ($products->have_posts()) : $products->the_post(); ?>
                <div class="swiper-slide">
                  <?php wc_get_template_part('content', 'product'); ?>
                </div>
            <?php endwhile;
              wp_reset_postdata();
            endif ?>
          </div>
          <div class="swiper-wrapper">
					<?php if (!empty($related_products) && is_array($related_products)) :
						global $post; // Definir la variable global para modificarla dentro del loop

						foreach ($related_products as $product) :
							$post = get_post($product->get_id()); // Obtener el objeto WP_Post del producto
							setup_postdata($post); // Configurar el post actual
					?>
							<div class="swiper-slide">
								<?php wc_get_template_part('content', 'product'); ?>
							</div>
					<?php


						endforeach;

						wp_reset_postdata(); // Restaurar el contexto global del post
					endif; ?>
				</div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$colecciones = get_field('colecciones');
$primera_coleccion = $colecciones['primera_coleccion'];
$segunda_coleccion = $colecciones['segunda_coleccion'];

$primeraImagenVariable = $primera_coleccion['imagen_variable'];
$segundaImagenVariable = $segunda_coleccion['imagen_variable'];

?>
<section id="summer_collection" class="pb-0">
  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-md-6 col-lg-6 col-xl-8 p-0 position-relative">
        <a href="<?= $primera_coleccion["link"]; ?>" class="position-relative d-flex">
          <div class="img-fit backgroundImg w-100">
            <picture class="w-100" >
              <source media="(min-width: 1200px)" srcset="<?= $primeraImagenVariable['pc_image'] ?>" />
              <source media="(min-width: 578px)" srcset="<?= $primeraImagenVariable['imagen_tablet'] ?>" />
              <source media="(max-width: 578px)" srcset="<?= $primeraImagenVariable['imagen_movil'] ?>" />
              <img src="<?= $primeraImagenVariable['pc_image'] ?>" alt="<?= $primera_coleccion["titulo"]; ?>" />
            </picture>
            <!-- <img src="<?= $primera_coleccion["fondo_de_imagen"]["url"]; ?>" alt="<?= $primera_coleccion["titulo"]; ?>" loading="lazy"> -->
          </div>
          <div class="info_summer position-absolute w-100">
            <p class="mb-0"><?= $primera_coleccion["subtitulo"]; ?></p>
            <h5 class="title mb-0"><?= $primera_coleccion["titulo"]; ?></h5>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-4 p-0">
        <a href="<?= $segunda_coleccion["link"]; ?>" class="position-relative d-flex">
          <div class="img-fit w-100">
            <picture class="w-100">
              <source media="(min-width: 1200px)" srcset="<?= $segundaImagenVariable['pc_image']['url'] ?>" />
              <source media="(min-width: 578px)" srcset="<?= $segundaImagenVariable['imagen_tablet']['url'] ?>" />
              <source media="(max-width: 578px)" srcset="<?= $segundaImagenVariable['imagen_movil']['url'] ?>" />
              <img src="<?= $segundaImagenVariable['pc_image']['url'] ?>" alt="<?= $segunda_coleccion["titulo"]; ?>" />
            </picture>
            <!-- <img src="<?= $segunda_coleccion["fondo_de_imagen"]["url"]; ?>" alt="<?= $segunda_coleccion["titulo"]; ?>" loading="lazy"> -->
          </div>
          <div class="info_summer position-absolute w-100">
            <p class="mb-0"><?= $segunda_coleccion["subtitulo"]; ?></p>
            <h5 class="title mb-0"><?= $segunda_coleccion["titulo"]; ?></h5>
          </div>
        </a>
      </div>

    </div>
  </div>
</section>
<?php
// $new = array(
//     'post_type'      => 'product',  // Tipo de post
//     'posts_per_page' => 8,          // Número de productos a mostrar
//     'orderby'        => 'date',     // Ordenados por fecha de publicación
//     'order'          => 'DESC'      // De más reciente a más antiguo
// );
// $newLoop = new WP_Query($new);
// if ($newLoop->have_posts()) {
//     woocommerce_product_loop_start();

//     while ($newLoop->have_posts()) {
//         $newLoop->the_post();

//         /**
//          * Hook: woocommerce_shop_loop.
//          * Permite agregar acciones al loop del archivo de productos.
//          */
//         do_action('woocommerce_shop_loop');

//         // Muestra la plantilla del producto (similar a como lo hace en archive-product.php)
//         wc_get_template_part('content', 'producto');
//     }

//     // Cerrar el contenedor del loop
//     woocommerce_product_loop_end();
// } else {
//     echo __('No hay productos disponibles.', 'woocommerce');
// }

?>

<?php
$ofertas = get_field('ofertas');
$coleccionOf = $ofertas['oferta_principal'];
$oferta = $ofertas['oferta'];
?>


<?php
get_footer();
?>