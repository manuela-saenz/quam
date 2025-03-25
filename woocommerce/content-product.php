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
    $all_variants = [];

    foreach ($available_variations as $variation) {
        $variation_obj = wc_get_product($variation['variation_id']);
        $color = $variation['attributes']['attribute_pa_color'] ?? '';
        $size = $variation['attributes']['attribute_pa_talla'] ?? '';
        $variation_id = $variation_obj->get_id();
        $optimized_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($variation_id), 'full')[0] ?? '';
        $variation_title = removerTalla($variation_obj->get_name());
        $variation_permalink = get_permalink($variation_id);
        $variation_price = $variation_obj->get_price_html();
        $sale_price = $variation_obj->get_sale_price();
        $regular_price = $variation_obj->get_regular_price();
        $variation_status = $variation_obj->get_stock_status();


        $discount = 0;
        if ($sale_price && $regular_price && $regular_price > $sale_price) {
            $discount = round((($regular_price - $sale_price) / $regular_price) * 100);
        }

        $color_term = get_term_by('slug', $color, 'pa_color');
        $color_hex = $color_term ? get_term_meta($color_term->term_id, 'cfvsw_color', true) : '#000';

        // Agregar datos al array de variantes
        $all_variants[] = [
            'id_father' => $product->get_id(),
            'id' => $variation_id,
            'name' => $variation_title,
            'permalink' => $variation_permalink,
            'color' => $color,
            'color_hex' => $color_hex,
            'price' => $variation_price,
            'discount' => $discount,
            'status' => $variation_status,
            'regular_price' => $regular_price,
            'sale_price' => $sale_price,
            'size' => $size,
            'image_url' => $optimized_image_url,
        ];
    }

    $all_variants_json = htmlspecialchars(json_encode($all_variants), ENT_QUOTES, 'UTF-8');
?>
    <?php
    $shown_colors = []; // Array para rastrear colores ya mostrados
    foreach ($all_variants as $variant):

        if (in_array($variant['color'], $shown_colors)) {
            continue; // Saltar si el color ya se ha mostrado
        }
        $shown_colors[] = $variant['color']; // Agregar color a la lista de mostrados
    ?>
        <li <?php wc_product_class('col-lg-3 col-sm-6 col-6', $product); ?>
            data-id="<?= $variant['id']; ?>"
            data-father="<?= $variant['id_father']; ?>"
            data-variants="<?= $all_variants_json; ?>">

            <div class="CardProducts w-100 position-relative <?= $variant['status'] ?>" data-stock="<?= $variant['status']; ?>">
                <?php if ($variant['discount'] > 0): ?>
                    <div class="discount position-absolute px-2 py-1 rounded-3 text-white lh-1">
                        <?= '-' . $variant['discount'] . '%'; ?>
                    </div>
                <?php endif; ?>

                <div class="position-relative">
                    <a href="<?= $variant['permalink'] ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-flex rounded-[10px] overflow-hidden mb-2 relative img-contain"
                        title="<?= $variant['name'] ?>">
                        <img src="<?= $variant['image_url'] ?>"
                            alt="<?= $variant['name'] ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail product-image" />
                    </a>
                    <button class="button-heart d-flex add-fav position-absolute"
                        data-product-id="<?= $variant['id']; ?>" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-1 variants-selection d-flex flex-column justify-content-end">
                    <div class="size-selection d-flex justify-content-center">
                        <?php
                        $unique_sizes = array_unique(array_column($all_variants, 'size'));
                        foreach ($unique_sizes as $size) :
                        ?>
                            <button class="size-circle" title="<?= $size; ?>" data-size="<?= $size; ?>"><?= strtoupper($size); ?></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="color-selection d-flex justify-content-center mt-3">
                        <?php
                        $unique_colors = array_unique(array_column($all_variants, 'color'));
                        foreach ($unique_colors as $color) :
                            $color_hex = array_column(array_filter($all_variants, function ($variant) use ($color) {
                                return $variant['color'] === $color;
                            }), 'color_hex')[0];
                        ?>
                            <button class="color-circle" style="background-color: <?= $color_hex; ?>;" title="<?= $color; ?>" data-color="<?= $color; ?>"></button>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="info-highlights position-relative">
                    <div class="product-info justify-content-center justify-content-md-between w-100">
                        <?php do_action('woocommerce_shop_loop_item_title'); ?>
                        <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                    </div>
                    <?php do_action('woocommerce_after_shop_loop_item'); ?>
                </div>
            </div>
        </li>
    <?php endforeach; ?>

<?php endif; ?>