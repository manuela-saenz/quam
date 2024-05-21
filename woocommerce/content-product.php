<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 */

defined('ABSPATH') || exit;

global $product;

if (empty($product) || !$product->is_visible()) {
	return;
}
$color = $_GET['filter_color'];
$filter_color = isset($_GET['filter_color']) ? $_GET['filter_color'] : null;
$filter_talla = isset($_GET['filter_talla']) ? $_GET['filter_talla'] : null;

if ($color) {
	$available_variations = $product->get_available_variations();
	$available_variations = array_filter($available_variations, function ($e) use ($color) {
		return $e['attributes']['attribute_pa_color'] == $color;
	});
	$available_variations = array_values($available_variations);
	$variation = new WC_Product_Variation($available_variations[0]['variation_id']);
	$image = $variation->get_image('medium', array('loading' => 'lazy', 'alt' => get_the_title()));
} else {
	$image = $product->get_image('medium', array('loading' => 'lazy', 'alt' => get_the_title()));
}

?>
<?php if ($filter_color !== null || $filter_talla !== null): ?>
<div <?php wc_product_class('col-lg-3 col-sm-6 col-6', $product); ?> data-id=<?= $product->get_id();?>>
    <a href="<?= get_permalink($product->get_id()) ?>" class="CardProducts w-100">
        <div class="img-contain" title="<?= get_the_title() ?>">
            <?= $image ?>
        </div>
        <div class="info-highlights">
            <h5 title="<?= get_the_title() ?>"><?= get_the_title() ?></h5>
            <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                <p class="mb-0 d-flex gap-2"><?= $product->get_price_html() .  " COP" ?></p>
            </div>
        </div>
    </a>
</div>
<?php endif; ?>

<?php 
    if ($product->is_type('variable') && $filter_color === null): 
?>
    <?php
        $available_variations = $product->get_available_variations();
        $shown_colors = array();
        
        foreach ($available_variations as $variation) {
            $variation_obj = wc_get_product($variation['variation_id']);
            $color = $variation['attributes']['attribute_pa_color'];
            
            if (!in_array($color, $shown_colors)) {
                $shown_colors[] = $color;
                $variation_image = wp_get_attachment_image(get_post_thumbnail_id($variation_obj->get_id()), 'woocommerce_thumbnail');
                $variation_title = $variation_obj->get_name();
                $variation_price = $variation_obj->get_price_html();
                ?>
                <div <?php wc_product_class('col-lg-3 col-sm-6 col-6', $variation_obj); ?> data-id=<?= $variation_obj->get_id();?>>
                    <a href="<?= get_permalink($variation_obj->get_id()) ?>" class="CardProducts w-100">
                        <div class="img-contain" title="<?= $variation_title ?>">
                            <?= $variation_image ?>
                        </div>
                        <div class="info-highlights">
                            <h5 title="<?= $variation_title ?>"><?= $variation_title ?></h5>
                            <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                                <p class="mb-0 d-flex gap-2"><?= $variation_price .  " COP" ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
    ?>
<?php endif; ?>
