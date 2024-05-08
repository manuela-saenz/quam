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

if ($related_products) : ?>

	<section class="related products">
		<div class="container">


			<?php
			$heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));

			if ($heading) :
			?>
				<h6 class="section-subtitle  mb-4 text-center">También te podría interesar</h6>
			<?php endif; ?>

			<div class="related-swiper swiper">
				<div class="swiper-wrapper">
					<?php foreach ($related_products as $related_product) : ?>

						<?php
						$post_object = get_post($related_product->get_id());


						?>
						<div class="swiper-slide">
							<a href="<?= get_permalink($related_product->get_id()) ?>" class="CardProducts">
								<div class="img-contain" title="<?php ?>">
									<?= $related_product->get_image('medium', 'alt=' . get_the_title())   ?>
								</div>
								<div class="info-highlights">
									<h5 title="<?= get_the_title() ?>"><?= get_the_title() ?></h5>
									<div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
										<p class=" mb-0 d-flex gap-2"><?= $related_product->get_price_html() .  "COP" ?> </p>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
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


	</section>
<?php
endif;

wp_reset_postdata();
