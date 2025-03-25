<?php

/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if ($related_products) :
	// echo '<pre>';
	// print_r($related_products);
	// echo '</pre>';
?>

	<section class="related products overflow-hidden">
		<div class="container">


			<?php
			$heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));

			if ($heading) :
			?>
				<h6 class="section-subtitle  mb-4 text-center">También te podría interesar</h6>
			<?php endif; ?>

			<div id="related-swiper" class="related-swiper swiper overflow-visible">
			<div class="swiper-wrapper">
					<?php if (!empty($related_products) && is_array($related_products)) :
						global $post; // Definir la variable global para modificarla dentro del loop

						foreach ($related_products as $product) :
							$post = get_post($product->get_id()); // Obtener el objeto WP_Post del producto
							setup_postdata($post); // Configurar el post actual
					?>
							<div class="swiper-slide">
								<?php wc_get_template_part('contentgen', 'product'); ?>
							</div>
					<?php


						endforeach;

						wp_reset_postdata(); // Restaurar el contexto global del post
					endif; ?>
				</div>
				<div class="arrow-prev-container d-none d-md-flex">
					<button class="generation-arrows prev">
						<i class="icon-arrowline-left"> </i>
					</button>
				</div>
				<div class="arrow-next-container d-none d-md-flex">
					<button class="generation-arrows next">
						<i class="icon-arrowline-right"> </i>
					</button>
				</div>
			</div>
			<pre class="">

			</pre>
		</div>


	</section>
<?php
endif;


wp_reset_postdata();
