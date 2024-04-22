<?php

/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined('ABSPATH') || exit;

/* translators: %s: Quantity. */
$label = !empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'woocommerce'), wp_strip_all_tags($args['product_name'])) : esc_html__('Quantity', 'woocommerce');

?>
<div class="quantity">
	<?php
	/**
	 * Hook to output something before the quantity input field.
	 *
	 * @since 7.2.0
	 */
	do_action('woocommerce_before_quantity_input_field');
	?>
	<button class="rounded-pill minus" type="button" data-cuanty="1">
		<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-minus" width="26" height="26" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			<path stroke="none" d="M0 0h24v24H0z" fill="none" />
			<path d="M5 12l14 0" />
		</svg>
	</button>
	<label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>
	<input type="<?php echo esc_attr($type); ?>" <?php echo $readonly ? 'readonly="readonly"' : ''; ?> id="<?php echo esc_attr($input_id); ?>" class="<?php echo esc_attr(join(' ', (array) $classes)); ?> qty" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" aria-label="<?php esc_attr_e('Product quantity', 'woocommerce'); ?>" size="4" min="<?php echo esc_attr($min_value); ?>" max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" <?php if (!$readonly) : ?> step="<?php echo esc_attr($step); ?>" placeholder="<?php echo esc_attr($placeholder); ?>" inputmode="<?php echo esc_attr($inputmode); ?>" autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>" <?php endif; ?> />
	<button class="rounded-pill plus" type="button" data-id="<?php echo esc_attr($idProducto); ?>" data-price="<?php echo esc_attr($price); ?>" data-cuanty="1" id="ProductAddSingle">
		<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="26" height="26" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
			<path stroke="none" d="M0 0h24v24H0z" fill="none" />
			<path d="M12 5l0 14" />
			<path d="M5 12l14 0" />
		</svg>
	</button>
	<?php
	/**
	 * Hook to output something after quantity input field
	 *
	 * @since 3.6.0
	 */
	do_action('woocommerce_after_quantity_input_field');
	?>
</div>
<?php
