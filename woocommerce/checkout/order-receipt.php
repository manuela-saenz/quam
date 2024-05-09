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
<div class="min-vh-100 ticket-order">
	<ul class="order_details">
		<li class="order">
			<?php /* esc_html_e('Order number:', 'woocommerce'); echo esc_html($order->get_order_number()); */ ?>
			<!-- <strong><?php /* echo esc_html($order->get_order_number()); */ ?></strong>  -->
		</li>
		<li class="date">
			<?php /*  esc_html_e('Fecha de solicitud de compra: ', 'woocommerce');
						echo esc_html(wc_format_datetime($order->get_date_created())) */ ?>
			<!-- <strong><?php /* echo esc_html(wc_format_datetime($order->get_date_created())); */ ?></strong>  -->
		</li>
		<li class="total">
			<?php /*  esc_html_e('Total:', 'woocommerce'); echo wp_kses_post($order->get_formatted_order_total()); */ ?>
			<!-- <strong><?php /* echo wp_kses_post($order->get_formatted_order_total()); */ ?></strong> -->
		</li>
		<?php /* if ($order->get_payment_method_title()): */ ?>
		<li class="method">
			<?php /* esc_html_e('Payment method: ', 'woocommerce'); echo wp_kses_post($order->get_payment_method_title()); */ ?>
			<!-- <strong><?php /* echo wp_kses_post($order->get_payment_method_title()); */ ?></strong> -->
		</li>
		<?php /* endif; */ ?>
	</ul>
	<div class="cont-btn-payu">

		<div>
			<img src="<?php bloginfo('template_url') ?>/media/images/pago-payu.svg" alt="">
		</div>
		<?php
		// Obtenemos el texto devuelto por la acción woocommerce_receipt_ y lo almacenamos en una variable
		ob_start();
		do_action('woocommerce_receipt_' . $order->get_payment_method(), $order->get_id());
		$texto = ob_get_clean();

		// Buscamos la posición de la frase "Gracias por su pedido" en el texto devuelto
		$posicion = strpos($texto, "Gracias por su pedido");

		// Si la frase está presente, agregamos un span alrededor de ella
		if ($posicion !== false) {
			$texto_modificado = substr_replace($texto, '<span>', $posicion, 0);
			$posicion_final = $posicion + strlen('<span>');
			$texto_modificado = substr_replace($texto_modificado, '</span>', $posicion_final + strlen("Gracias por su pedido"), 0);
			// Agregamos "!¡" al mensaje
			$texto_modificado = str_replace('Gracias por su pedido', '¡Gracias por su pedido!', $texto_modificado);
			// Eliminamos la coma después de la frase
			$texto_modificado = str_replace(',', '', $texto_modificado);
			echo $texto_modificado;
		} else {
			echo $texto; // Si la frase no está presente, imprimimos el texto original
		}
		?>
	</div>



</div>
<div class="clear"></div>