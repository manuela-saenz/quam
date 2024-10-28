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
    $image = $variation->get_image('medium', array('loading' => 'lazy', 'alt' => get_the_title(), 'data-src' => get_the_post_thumbnail_url()));
} else {
    $image = $product->get_image('medium', array('loading' => 'lazy', 'alt' => get_the_title(), 'data-src' => get_the_post_thumbnail_url()));
}

?>

<?php if ($filter_color !== null || $filter_talla !== null):
    $product_id = $product->get_id();
    $product_title = get_the_title();
    $product_permalink = get_permalink($product_id);
    $product_price_html = $product->get_price_html() . " COP";
    $product_status = $product->get_stock_status();
?>
    <div <?php wc_product_class('col-lg-3 col-sm-6 col-6', $product); ?> data-id="<?= $product_id; ?>">
        <a href="<?= $product_permalink ?>" class="CardProducts w-100 <?= $product_status ?>" data-stock="<?= $product_status; ?>">
            <div class="img-contain bb center-all" title="<?= $product_title ?>" data-src="<?= get_the_post_thumbnail_url() ?>">
                <?= $image ?>
                <pre class="d-none">
                    <?php print_r($product) ?>
                </pre>
            </div>
            <div class="info-highlights">
                <h5 title="<?= $product_title ?>"><?= $product_title ?></h5>
                <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                    <p class="mb-0 d-flex gap-2"><?= $product_price_html ?></p>
                </div>
            </div>

        </a>
    </div>
<?php endif; ?>

<?php
if ($product->is_type('variable') && $filter_color === null && $filter_talla === null):
    $available_variations = $product->get_available_variations();
    $shown_colors = array();

    foreach ($available_variations as $variation) {
        $variation_obj = wc_get_product($variation['variation_id']);
        $color = $variation['attributes']['attribute_pa_color'];

        if (!in_array($color, $shown_colors)) {
            $shown_colors[] = $color;
            $variation_id = $variation_obj->get_id();
            $variation_image = wp_get_attachment_image(get_post_thumbnail_id($variation_id), 'full'); // Tamaño optimizado
            $size = 'full'; // Puedes cambiar esto por 'thumbnail', 'medium', 'large', o un tamaño personalizado
            $image_array = wp_get_attachment_image_src(get_post_thumbnail_id($variation_id), $size);
            $optimized_image_url = $image_array[0];
            $variation_title = removerTalla($variation_obj->get_name());
            $variation_permalink = get_permalink($variation_id);
            $variation_price = $variation_obj->get_price_html() . " COP";
            $variation_status = $variation_obj->get_stock_status();

?>
            <div <?php wc_product_class('col-lg-3 col-sm-6 col-6', $variation_obj); ?> data-id="<?= $variation_id; ?>">
                <a href="<?= esc_url($link) ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link rounded-[10px] overflow-hidden mb-3 relative d-none">
                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop_item_title.
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    woocommerce_show_product_loop_sale_flash();
                    woocommerce_template_loop_product_thumbnail();
                    // do_action('woocommerce_before_shop_loop_item_title');
                    ?>
                </a>
                <a href="<?= $variation_permalink ?>" class="CardProducts w-100 <?= $variation_status ?>" data-stock="<?= $variation_status; ?>">

                    <div class="woocommerce-LoopProduct-link woocommerce-loop-product__link rounded-[10px] overflow-hidden mb-3 relative img-contain" title="<?= $variation_title ?>" data-src="<?= get_the_post_thumbnail_url() ?>">
                        <img data-src="<?= $optimized_image_url ?> " alt="<?= $variation_title ?>" class=" attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />

                        <img class="position-absolute top-0 left-0" data-src="<?= $variation['variation_gallery_images'][1]['src'] ?>" alt="<?= $variation_title ?>">
                    </div>
                    <div class="info-highlights">
                        <h5 title="<?= $variation_title ?>"><?= $variation_title ?></h5>
                        <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                            <p class="mb-0 d-flex gap-2"><?= $variation_price ?></p>
                        </div>
                        <div class="d-none">
                            <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                        </div>
                    </div>
                </a>
            </div>
<?php
        }
    }
endif;
?>