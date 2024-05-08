<?php
get_header();
$queryArr = array(
    "post_type" => "product",
    "posts_per_page" => 12
);

$currentCat = null;
if (is_tax()) {
    $currentCat = get_queried_object();
    $queryArr["tax_query"] = array(
        array(
            "taxonomy" => $currentCat->taxonomy,
            "terms" => $currentCat->term_id
        )
    );
}

// setlocale(LC_TIME, 'es_ES.UTF-8');

// $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// if ($conn->connect_error) {
//     die("Error de conexión: " . $conn->connect_error);
// }

$products = get_products_by_category_name($currentCat->name);


// Obtener el término (categoría) por su nombre
// $category = get_term_by('name', $currentCat->name, 'product_cat');
// echo $category;
?>

<section id="bannerCategory" class=" position-relative overflow-hidden p-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <h2 class="section-subtitle mb-0"><?= $currentCat->name ?></h2> -->
                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                    <h1 class="woocommerce-products-header__title page-title <?= is_search() ? 'section-subtitle-2' : 'section-subtitle' ?>  mb-0"><?php woocommerce_page_title(); ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="infoProducts" class="pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center select_men">
                <div class="select d-lg-flex d-none gap-2">
                    <?php if (is_search()) {
                    } else{ 
                       echo do_shortcode('[yith_wcan_filters slug="default-preset"]');
                    } ?>
                    <!-- The second value will be selected initially -->
                    <div class="select-box">
                        <?php woocommerce_catalog_ordering(); ?>
                        <!-- <select>
                            <option value="opcion1">Orden</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select> -->
                        <div class="arrow"></div>
                    </div>
                </div>

                <div class="select d-lg-none d-flex center-all w-100">
                    <!-- The second value will be selected initially -->
                    <div class="select-box">

                        <select>
                            <option value="opcion1">Filtros</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select>
                        <div class="arrow"></div>
                    </div>

                    <!-- The second value will be selected initially -->
                    <div class="select-box">
                        <select>
                            <option value="opcion1">Ordenar</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select>
                        <div class="arrow"></div>
                    </div>
                </div>

                <div class="products text-center text-lg-end">
                    <?= woocommerce_result_count() ?>
                </div>


            </div>
        </div>
        <?php
        if (woocommerce_product_loop()) {


            woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>

    </div>

</section>

<?php get_footer() ?>