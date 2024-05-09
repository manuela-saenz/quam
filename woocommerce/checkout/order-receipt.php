<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.2.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="ticket-order pt-5 pb-5">

	<div class=" justify-content-center">
		<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
			class="bi bi-check-circle-fill" viewBox="0 0 16 16">
			<path
				d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
		</svg>
	</div>

	<ul class="order_details justify-content-center">
		<li class="order border-0 fs-6 fw-bold text-body-tertiary m.0">
			<?php esc_html_e('Order number:', 'woocommerce');
			echo esc_html($order->get_order_number()); ?>
			<!-- <strong><?php /* echo esc_html($order->get_order_number()); */ ?></strong> -->
		</li>
		<li class="date border-0 fs-6 fw-bold text-body-tertiary m-0">
			<?php esc_html_e('Fecha de solicitud de compra: ', 'woocommerce');
			echo esc_html(wc_format_datetime($order->get_date_created())) ?>
			<!-- <strong><?php /* echo esc_html(wc_format_datetime($order->get_date_created())); */ ?></strong> -->
		</li>
		<li class="total border-0 fs-6  text-body-tertiary m-0">
			<?php esc_html_e('Total:', 'woocommerce'); echo wp_kses_post($order->get_formatted_order_total()); ?>
			<!-- <strong><?php /* echo wp_kses_post($order->get_formatted_order_total()); */ ?></strong> -->
		</li>
		<?php if ($order->get_payment_method_title()): ?>
			<li class="method border-0 fs-6 fw-bold m-0">
				<?php esc_html_e('Payment method: ', 'woocommerce'); echo wp_kses_post($order->get_payment_method_title()); ?>
				<!-- <strong><?php /* echo wp_kses_post($order->get_payment_method_title()); */ ?></strong> -->
			</li>
		<?php endif; ?>
	</ul>
	<div class="cont-btn-payu">
		<?php do_action('woocommerce_receipt_' . $order->get_payment_method(), $order->get_id()); ?>
	</div>

</div>
<div class="clear"></div>