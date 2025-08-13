<?php

/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

if (! $short_description) {
	return;
}

?>
<div class="woocommerce-product-details__short-description mb-8 md:text-lg text-gray leading-tight">
	<?php echo $short_description; // WPCS: XSS ok. 
	?>
</div>
<?php

$product_id = get_the_ID(); // o $product->get_id() si tienes el objeto producto
$terms = get_the_terms($product_id, 'product_cat');

if ($terms && !is_wp_error($terms)) {
	// Ordena por jerarquía (opcional, pero útil)
	usort($terms, function ($a, $b) {
		return $a->parent - $b->parent;
	});

	$term = $terms[0]; // primera categoría
	$parent_id = $term->parent;

	if ($parent_id) {
		$guiaTallas = get_field('guia_tallas', 'product_cat_' . $parent_id);
	} else {
		// O la buscamos en la misma categoría si no tiene padre
		$guiaTallas = get_field('guia_tallas', 'product_cat_' . $term->term_id);
	} ?>
	<a href="<?= $guiaTallas['url'] ?>" class="glightbox d-block mb-4">
		<u>Guía de tallas</u>
	</a>
<?php
	// echo $guiaTallas['url'];
}

?>