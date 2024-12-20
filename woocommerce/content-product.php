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
    $variation_id = $available_variations[0]['variation_id'];
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
        <a href="<?= $product_permalink ?>" class="CardProducts w-100" data-stock="<?= $product_status; ?>">
            <div class="img-contain bb" title="<?= $product_title ?>" data-src="<?= get_the_post_thumbnail_url() ?>">
                <?= $image ?>
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
    $product_id = $product->get_id();
    $color_variations = array();

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
            $variation_price = $variation_obj->get_price_html();

            // Obtener el precio formateado con HTML
            $variation_price_html = $variation_obj->get_price_html();

            // Extraer el precio de venta (segundo precio)
            preg_match('/<ins[^>]*><span[^>]*><bdi><span[^>]*>([^<]*)<\/span>&nbsp;([^<]*)<\/bdi><\/span><\/ins>/', $variation_price_html, $matches);
            $sale_price = isset($matches[2]) ? $matches[2] : '';

            // Quitar el punto y convertirlo en número
            $sale_price_number = str_replace('.', '', $sale_price);
            $sale_price_number = floatval($sale_price_number);

            $variation_status = $variation_obj->get_stock_status();
            $regular_price = $variation_obj->get_regular_price();
            $discount = 0;
            if ($sale_price_number && $regular_price && $regular_price > $sale_price_number) {
                $discount = round((($regular_price - $sale_price_number) / $regular_price) * 100);
            }

?>
            <li <?php wc_product_class('col-lg-3 col-sm-6 col-6', $variation_obj); ?> data-id="<?= $variation_id; ?>" data-id-pub="<?= $product_id; ?>" data-color="<?= $color; ?>">
                <div class="CardProducts w-100 position-relative <?= $variation_status ?>" data-stock="<?= $variation_status; ?>">
                    <div class="discount position-absolute px-2 py-1 rounded-3 text-white lh-1">
                        <?= '-' . $discount . '%'; ?>
                    </div>
                    <div class="position-relative">
                        <a href="<?= $variation_permalink ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-flex rounded-[10px] overflow-hidden mb-3 relative img-contain" title="<?= $variation_title ?>" data-src="<?= get_the_post_thumbnail_url() ?>">
                            <img data-href="<?= $variation_permalink ?>" data-src="<?= $optimized_image_url ?> " alt="<?= $variation_title ?>" class=" attachment-woocommerce_thumbnail size-woocommerce_thumbnail" />

                            <!-- <img class="position-absolute top-0 left-0" data-src="<?= $variation['variation_gallery_images'][1]['src'] ?>" alt="<?= $variation_title ?>"> -->
                        </a>
                        <button class="button-heart  d-flex add-fav position-absolute" id="add-sprod-favs" data-product-id="<?= $variation_id; ?>" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                        </svg>
                    </button>
                    </div>
                    <div class="info-highlights position-relative">
                        <div class="d-grid product-info justify-content-center justify-content-md-between w-100">
                            <?php

                            /**
                             * Hook: woocommerce_shop_loop_item_title.
                             *
                             * @hooked woocommerce_template_loop_product_title - 10
                             */
                            do_action('woocommerce_shop_loop_item_title');

                            /**
                             * Hook: woocommerce_after_shop_loop_item_title.
                             *
                             * @hooked woocommerce_template_loop_rating - 5
                             * @hooked woocommerce_template_loop_price - 10
                             */
                            ?>

                            <?php do_action('woocommerce_after_shop_loop_item_title'); ?>

                        </div>

                        <?php
                        /**
                         * Hook: woocommerce_after_shop_loop_item.
                         *
                         * @hooked woocommerce_template_loop_product_link_close - 5
                         * @hooked woocommerce_template_loop_add_to_cart - 10
                         */
                        do_action('woocommerce_after_shop_loop_item');
                        ?>
                    </div>
                </div>
            </li>

<?php
        }
    }
endif;
?>