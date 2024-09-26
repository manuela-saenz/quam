<?php

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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

if (! wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
	return;
}

?>
<!-- <div class="woocommerce-form-coupon-toggle">
	<?php wc_print_notice(apply_filters('woocommerce_checkout_coupon_message', esc_html__('Have a coupon?', 'woocommerce') . ' <a href="#" class="showcoupon">' . esc_html__('Click here to enter your code', 'woocommerce') . '</a>'), 'notice'); ?>x
</div> -->
<form class="checkout_coupon woocommerce-form-coupon floating-coupon-form" method="post">
	<button type="button" class="close-coupon-form">&times;</button>
	<p><?php esc_html_e('Aplica tu cupon de descuento.', 'woocommerce'); ?></p>

	<p class="form-row form-row-first">
		<label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Cupon', 'woocommerce'); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Aplicar cupón', 'woocommerce'); ?>"><?php esc_html_e('Aplicar cupón', 'woocommerce'); ?></button>
	</p>

	<div class="clear"></div>
</form>

<style>
	.floating-coupon-form {
		position: fixed;
		bottom: 20px;
		right: 20px;
		background-color: #fff;
		padding: 20px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		border-radius: 8px;
		z-index: 1000;
	}

	.floating-coupon-form .form-row {
		margin-bottom: 10px;
	}

	.floating-coupon-form .button {
		width: 100%;
	}

	.floating-coupon-form .close-coupon-form {
		position: absolute;
		top: 10px;
		right: 10px;
		background: none;
		border: none;
		font-size: 20px;
		cursor: pointer;
	}
</style>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const closeButton = document.querySelector('.close-coupon-form');
        const couponForm = document.querySelector('.floating-coupon-form');

        if (closeButton && couponForm) {
            closeButton.addEventListener('click', function() {
                couponForm.style.display = 'none';
            });
        }
    });
</script>