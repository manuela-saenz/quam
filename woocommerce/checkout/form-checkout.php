<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (! defined('ABSPATH')) {
	exit;
}
$checkout = WC()->checkout();
do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>
<div class="container-fluid position-relative">
	<div class="flex-grow-1 flex-shrink-0">
		<div id="stepper1" class="bs-stepper">
			<div class="step_by_step row">
				<div class="col-md-2">
					<!-- <a href="https://www.quam.com.co/web_quam/"> <i class="icon-arrow-left"></i> Continuar
							comprando</a> -->
				</div>
				<div class="col-md-7 offsted-md-1 center-all">
					<div class="bs-stepper-header" role="tablist">
						<div class="step" data-target="#test-l-1">
							<button type="button" class="step-trigger" role="tab" id="stepper1trigger1"
								aria-controls="test-l-1">
								<span class="bs-stepper-circle">1</span>
								<span class="bs-stepper-label">Datos de envío</span>
							</button>
						</div>
						<div class="bs-stepper-line"></div>
						<div class="step" data-target="#test-l-2">
							<button type="button" class="step-trigger" role="tab" id="stepper1trigger2"
								aria-controls="test-l-2">
								<span class="bs-stepper-circle">2</span>
								<span class="bs-stepper-label">Metodo de pago</span>
							</button>
						</div>

					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

							<?php if ($checkout->get_checkout_fields()) : ?>

								<?php do_action('woocommerce_checkout_before_customer_details'); ?>

								<div class="col2-set bg-green" id="customer_details">
									<div class="col-12 billing ">
										<?php do_action('woocommerce_checkout_billing'); ?>
									</div>

									<div class="col-2 shipping d-none">
										<?php do_action('woocommerce_checkout_shipping'); ?>
									</div>
								</div>

								<?php do_action('woocommerce_checkout_after_customer_details'); ?>

							<?php endif; ?>

							<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

							<?php do_action('woocommerce_checkout_before_order_review'); ?>

							<?php do_action('woocommerce_checkout_after_order_review'); ?>

						</form>
					</div>

					<div class="col-lg-4 col-md-12 ps-md-4">
						<div class="code">
							<div class="position-relative">
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
								<div class="woocommerce-form-coupon-toggle">
									<?php wc_print_notice(apply_filters('woocommerce_checkout_coupon_message', esc_html__('¿Tienes un cupón?', 'woocommerce') . ' <a href="#" class="showcoupon"><strong>' . esc_html__('Haz clic aquí para ingresar tu código', 'woocommerce') . '</strong></a>'), 'notice'); ?>
								</div>



								<?php woocommerce_order_review() ?>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<?php do_action('woocommerce_after_checkout_form', $checkout); ?>