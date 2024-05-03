<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) : ?>
	
	<div class="woocommerce-tabs wc-tabs-wrapper characteristics align-items-start row col-12 p-0">
		<div class="col-md-3">
			<ul class="tabs wc-tabs flex-column d-flex p-0" role="tablist">
				<?php foreach ($product_tabs as $key => $product_tab) : ?>
					<li class="<?php echo esc_attr($key); ?>_tab p-0 bg-white border-0 mx-0 mb-3" id="tab-title-<?php echo esc_attr($key); ?>" role="tab" aria-controls="tab-<?php echo esc_attr($key); ?>">
						<a href="#tab-<?php echo esc_attr($key); ?>" class="d-flex justify-content-center rounded-2 w-100">
							<?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="col-md-8 offset-md-1">
			<?php foreach ($product_tabs as $key => $product_tab) : ?>
				<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr($key); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr($key); ?>">
					<?php
					if (isset($product_tab['callback'])) {
						call_user_func($product_tab['callback'], $key, $product_tab);
					}
					?>
				</div>
			<?php endforeach; ?>
		</div>


		<?php do_action('woocommerce_product_after_tabs'); ?>
	</div>

<?php endif; ?>