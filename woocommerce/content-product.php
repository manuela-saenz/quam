<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div <?php wc_product_class('col-lg-3 col-sm-6 col-6', $product); ?>>
	<a href="<?= get_permalink($product->get_id()) ?>" class="CardProducts w-100">
		<div class="img-contain border" title="<?php ?>">
			<?= $product->get_image('medium', 'alt=' . get_the_title())   ?>
		</div>
		<div class="info-highlights">
			<h5 title="<?= get_the_title() ?>"><?= get_the_title() ?></h5>
			<div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
				<p class=" mb-0 d-flex gap-2"><?= $product->get_price_html() .  "COP" ?> </p>
			</div>
		</div>
	</a>
</div>