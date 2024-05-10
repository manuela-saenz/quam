<?php

/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="woocommerce-billing-fields">
	<?php
	$fields = $checkout->get_checkout_fields('billing');
	/*
	foreach ( $fields as $key => $field ) {
		woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
	}*/
	?>
	<div class="container-fluid position-relative">
		<div class="flex-grow-1 flex-shrink-0">
			<div id="stepper1" class="bs-stepper">
				<div class="step_by_step row">
					<div class="col-md-2">
						<a href="https://www.quam.com.co/web_quam/"> <i class="icon-arrow-left"></i> Continuar
							comprando</a>
					</div>
					<div class="col-md-7 offsted-md-1 center-all">
						<div class="bs-stepper-header" role="tablist">
							<div class="step" data-target="#test-l-1">
								<button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
									<span class="bs-stepper-circle">1</span>
									<span class="bs-stepper-label">Bolsa de la compra</span>
								</button>
							</div>
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-2">
								<button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
									<span class="bs-stepper-circle">2</span>
									<span class="bs-stepper-label">Identificación</span>
								</button>
							</div>
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-3">
								<button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
									<span class="bs-stepper-circle">3</span>
									<span class="bs-stepper-label">Ubicación</span>
								</button>
							</div>
							<div class="bs-stepper-line"></div>
							<div class="step" data-target="#test-l-4">
								<button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
									<span class="bs-stepper-circle">4</span>
									<span class="bs-stepper-label">Pago</span>
								</button>
							</div>
							<!-- <div class="bs-stepper-line"></div> -->
							<div class="step" data-target="#test-l-5" class="" style="display: none;">
								<button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
									<span class="bs-stepper-circle">5</span>
									<span class="bs-stepper-label">Pago</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="container informationBag">
					<div class="row center-start">
						<div class="col-lg-8 col-md-12">
							<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
							<div class="bs-stepper-content">
								<div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
									<div class="form-group row">
										<div class="col-md-12">
											<h3 class="mb-4"> Bolsa de la compra</h3>
											<table class="table table-bag">
												<thead>
													<tr>
														<th scope="col">Producto (s)</th>
														<th scope="col" class="text-center">Cantidad</th>
														<th scope="col" class="">Precio</th>
														<th scope="col" style="color: transparent;">dd</th>
													</tr>
												</thead>
												<?php ItemsCheckout(); ?>
											</table>
											<div class="d-lg-flex d-none flex-column">
												<label class="custom-checkbox d-flex align-items-baseline mb-4"><input class="politicy check me-3" type="checkbox" id="cboxtwo" value="first_checkbox">
													<div style="font-size: 15px;">
														Autorizo el uso de mis datos personales con fines
														comerciales y publicitarios para
														recibir
														información sobre productos y servicios de interés.
													</div>
												</label>
												<button type="button" class="quam-btn blue" onclick="stepper1.next()">Diligenciar información</button>
											</div>
										</div>
										<?php
										$total = WC()->cart->get_cart_total();
										$discountTotal = WC()->cart->get_cart_discount_total();
										?>
									</div>
								</div>
								<div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
									<div class="form-group row">
										<div class="col-lg-12">
											<h3 class="mb-4"> Identificación</h3>
											<div class="position-relative">
												<div class="form_contact">
													<div class="row input-form-name mb-4">
														<div class="col-md-6 fw-bold ">
															<?php woocommerce_form_field(array_keys($fields)[0], $fields['billing_first_name'], $checkout->get_value(array_keys($fields)[0])); ?>
														</div>
														<div class="col-md-6 fw-bold">
															<?php woocommerce_form_field(array_keys($fields)[1], $fields['billing_last_name'], $checkout->get_value(array_keys($fields)[1])); ?>
														</div>
														<div class="col-md-6 fw-bold">
															<?php woocommerce_form_field(array_keys($fields)[2], $fields['billing_id'], $checkout->get_value(array_keys($fields)[2])); ?>
														</div>
														<div class="col-md-6 fw-bold">
															<?php woocommerce_form_field(array_keys($fields)[11], $fields['billing_email'], $checkout->get_value(array_keys($fields)[11])); ?>
														</div>
														<div class="col-md-6 fw-bold">
															<?php woocommerce_form_field(array_keys($fields)[10], $fields['billing_phone'], $checkout->get_value(array_keys($fields)[10])); ?>

														</div>
													</div>
													<div class="btn-step-next">
														<button id="boton-id" type="button" class="quam-btn blue" onclick="stepper1.next()">Diligenciar ubicación</button>
													</div>
												</div>

											</div>
										</div>
									</div>
									<div class="d-flex justify-content-end">
										<button type="button" class="quam-btn-responsive blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i>
											Volver a la bolsa de la compra</button>
										<!-- <button class=" quam-btn blue next" onclick="stepper1.next()">Next</button> -->
									</div>
								</div>
								<div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
									<div class="form-group row">
										<div class="col-lg-12">
											<h3 class="mb-4"> Ubicación</h3>
											<div class="position-relative">
												<div class="form_contact">
													<div class="row input-form-location mb-4">
														<div class="col-md-6">
															<?php woocommerce_form_field(array_keys($fields)[3], $fields['billing_company'], $checkout->get_value(array_keys($fields)[3])); ?>
														</div>
														<div class="col-md-6">
															<?php woocommerce_form_field(array_keys($fields)[4], $fields['billing_country'], $checkout->get_value(array_keys($fields)[4])); ?>
														</div>
														<div class="col-md-6">
															<?php woocommerce_form_field(array_keys($fields)[5], $fields['billing_address_1'], $checkout->get_value(array_keys($fields)[5])); ?>
														</div>
														<div class="col-md-6">
															<label for="" class="mt-2 ms-1">Apartamento o habitacion</label>
															<?php woocommerce_form_field(array_keys($fields)[6], $fields['billing_addres_2'], $checkout->get_value(array_keys($fields)[6])); ?>
														</div>
														<div class="col-md-6">
															<?php woocommerce_form_field(array_keys($fields)[7], $fields['billing_city'], $checkout->get_value(array_keys($fields)[7])); ?>
														</div>
														<div class="col-md-6">
															<?php woocommerce_form_field(array_keys($fields)[8], $fields['billing_state'], $checkout->get_value(array_keys($fields)[8])); ?>
														</div>
														<div class="col-md-6">
															<?php woocommerce_form_field(array_keys($fields)[9], $fields['billing_postcode'], $checkout->get_value(array_keys($fields)[9])); ?>
														</div>
													</div>
													<div class="alert alert-danger" role="alert" id="error_alert" style="display:none; color: #721c24; background-color: #f8d7daa1; border: 2px solid #f5c6cb; padding: 13px; margin-bottom: 10px;">
													</div>
													<div class="alert alert-success" role="alert" id="success_alert" style="display:none; color: #155724; background-color: #d4eddaa1; border:1px solid #c3e6cb; #f5c6cb; padding: 13px; margin-bottom: 10px;">
													</div>
													<div class="btn-step-next">
														<!-- <button type="button" class="quam-btn blue next" onclick="generate_order()">Generar pedido</button> -->
														<button id="boton-lo" type="button" class="quam-btn blue" onclick="stepper1.next()">Generar pedido</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="d-flex justify-content-end">
										<button type="button" class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i>
											Volver a la identificación </button>
										<!-- <button type="button" class="quam-btn blue next" onclick="stepper1.next()">Next</button> -->
									</div>

								</div>

								<div id="test-l-4" role="tabpanel" class="bs-stepper-pane form-group" aria-labelledby="stepper1trigger4">
									<h3 class=" mb-4">Pago</h3>
									<div class="form-group row bg-white p-3 rounded">
										<div class="col-lg-12 position-relative">

											<div class="nav nav-pills m-5" id="pills-tab" role="tablist">
												<div>
													<?php woocommerce_checkout_payment(); ?>
												</div>

											</div>
											<div class="tab-content" id="pills-tabContent">


												<div class="tab-pane fade position-relative" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

													<div class="btn-step-next">
														<button type="submit" class="quam-btn blue next" onclick="redirectToPaymentGateway()">Comprar
															ahora</button>
													</div>
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-end">
											<button type="button" class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i>
												Volver a la ubicación </button></button>
											<!-- <button type="submit" class="quam-btn blue">Submit</button> -->
											<!-- <button type="button" class="quam-btn blue next" onclick="stepper1.next()">Next</button> -->
										</div>
									</div>
									<div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
										<div class="form-group row center-all">
											<div class="col-md-6 position-relative center-all text-center flex-column">
												<div class="circle">
													<i class="icon-check"></i>
												</div>
												<h3 class="mb-4">¡Gracias por su compra!</h3>
												<div>
													<p>Fecha de solicitud de compra: 03/01/2024</p>
													<p>Tu pedido se encuentra en proceso de validación, en breve
														recibirás un correo con el detalle de tu compra.</p>
													<b>Pedido: VUY-0229</b>
												</div>
												<div class="btn-step-next mt-4">
													<button type="button" class="quam-btn blue next" onclick="stepper1.next()">Seguir comprando</button>
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-end">
											<button type="button" class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i>Volver al pago</button>
											<!-- <button type="button" class="quam-btn blue" onclick="stepper1.next()">Next</button> -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
						<div class="col-lg-4 col-md-12 ps-md-4">
							<div class="code">
								<form method="post" class="position-relative">
									<div class="position-relative">
										<input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
										<input type="submit" class="quam-btn blue codigo" value="Aplicar">
									</div>
									<?php woocommerce_order_review() ?>
									<div class="mt-4 d-none">
										<div class="d-flex justify-content-between">
											<p class="fw-bolder" style="color: #00000075;">
												Subtotal</p>
											<p class="fw-bolder" style="color: #00000075;">
												<?php echo $total; ?>
											</p>
										</div>
										<div class="d-flex justify-content-between">
											<p class="fw-bolder" style="color: #00000075;">
												Descuento</p>
											<p class="fw-bolder" style="color: #00000075;">
												<?php echo $discountTotal; ?>
											</p>
										</div>
										<div class="d-flex justify-content-between">
											<p class="" style="font-size: 22px;"> <b>Total</b>
											</p>
											<p class="" style="font-size: 22px;"> <b>
													<?php echo $total; ?></b> </p>
										</div>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
		<div class="woocommerce-account-fields">
			<?php if (!$checkout->is_registration_required()) : ?>

				<p class="form-row form-row-wide create-account">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?> type="checkbox" name="createaccount" value="1" />
						<span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
					</label>
				</p>
			<?php endif; ?>
			<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>
			<?php if ($checkout->get_checkout_fields('account')) : ?>
				<div class="create-account">
					<?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
						<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
			<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
		</div>
	<?php endif; ?>