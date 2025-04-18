<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;
$sessionFav = $_SESSION["prodsfavs"];

if (!$product->is_purchasable()) {
	return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="center-vertical gap-3">
			<?php
			do_action('woocommerce_before_add_to_cart_quantity');

			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
					'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
					'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
				)
			);

			do_action('woocommerce_after_add_to_cart_quantity');
			?>
			
			<button type="submit" name="add-to-cart" data-bs-toggle="offcanvas" data-bs-target="#mini-carrito" aria-controls="mini-carrito" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button quam-btn red alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
			<button class="button-heart d-none d-lg-flex add-fav" id="add-sprod-favs" data-product-id="<?php echo esc_attr($product->get_id()); ?>" type="button">   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
            </svg> </button>
		</div>
		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>
	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>

<script>
	setTimeout(() => {
		var targetNode = document.getElementById('add-sprod-favs');
		var productId = targetNode.getAttribute('data-product-id');
		var sessionFav = <?php echo json_encode($sessionFav); ?>;
		if (!productId === 0) {
			if (sessionFav.includes(productId)) {
				$(".add-fav").addClass("active-fav");
			} else {
				$(".add-fav").removeClass("active-fav");
			}
		}

	}, 500)

	document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            var outOfStock = document.querySelector('.stock.out-of-stock');
            if (outOfStock) {
                var submitButton = document.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                }
            }
        }, 1000)
    });
</script>