<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
?>

<div class="woocommerce-order pt-5 pb-5">

	<?php
	if ($order):
		do_action('woocommerce_before_thankyou', $order->get_id());
		?>

		<?php if ($order->has_status('failed')): ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
				<?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?>
			</p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions fs-6">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
					class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()): ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
						class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>

		<?php else: ?>

			<div class="ticket-order">
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
						class="bi bi-check-circle-fill" viewBox="0 0 16 16">
						<path
							d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
					</svg>
				</div>

				<?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

				<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details justify-content-center">

					<li class="woocommerce-order-overview__date date border-0 fs-6 fw-bold text-body-tertiary">
						<?php esc_html_e('Fecha de solicitud de compra:', 'woocommerce');
						echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

						<!-- <strong><?php /* echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></strong>-->
					</li>

					<li class="fs-6 text-body-tertiary">
						Tu pedido se encuentra en proceso de validación, en breve recibirás un correo con el detalle de tu
						compra.
					</li>

					<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()): ?>
						<li class="woocommerce-order-overview__email email border-0 fs-6 text-body-tertiary">
							<?php esc_html_e('Email:', 'woocommerce'); ?>
							<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
						</li>
					<?php endif; ?>

					<!--<li class="woocommerce-order-overview__total total border-0">
					<?php /* esc_html_e('Total:', 'woocommerce'); ?>
												  <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></strong>
				</li> -->

					<?php /* if ($order->get_payment_method_title()): ?>
												<li class="woocommerce-order-overview__payment-method method border-0">
													<?php esc_html_e('Payment method: ', 'woocommerce');
													echo wp_kses_post($order->get_payment_method_title()); ?>
													<strong><?php ?></strong>
												</li>
											<?php endif; */ ?>

					<li class="woocommerce-order-overview__order order border-0 fs-6 fw-bold">
						<?php esc_html_e('Order number:', 'woocommerce');
						echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<!-- <strong></*?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */?></strong> -->
					</li>

					<li>
						<a class="" href="https://www.quam.com.co/web_quam/">Seguir comprando</a>
					</li>
				</ul>

			<?php endif; ?>
			<!-- <div>
				<? /* php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); */ ?>
			</div> -->

			<div>
				<?php /* do_action('woocommerce_thankyou', $order->get_id()); */ ?>
			</div>
		<?php else: ?>
			<?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>
		<?php endif; ?>
	</div>
</div>