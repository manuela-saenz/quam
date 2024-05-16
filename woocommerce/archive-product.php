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
                <?php if (apply_filters('woocommerce_show_page_title', true)): ?>
                    <h1
                        class="woocommerce-products-header__title page-title <?= is_search() ? 'section-subtitle-2' : 'section-subtitle' ?>  mb-0">
                        <?php woocommerce_page_title(); ?>
                    </h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="infoProducts" class="pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center select_men">
                <div class="select d-flex gap-2">
                    <!-- form filter -->
                    <?php /* dynamic_sidebar('home_right_1') */
                    $cate = get_queried_object();
                    $cateSlug = $cate->slug;
                    //Get all products from this category
                    $products = wc_get_products(
                        array(
                            'category' => array($cateSlug),
                            'posts_per_page' => -1
                        )
                    );


                    //get all prices from this category
                    $all_prices[] = array();

                    foreach ($products as $product) {
                        $all_prices[] = $product->get_price();
                    }
                    // print_r($all_prices);
                    
                    ?>

                    <?php
                    ?>
                    <?php

                    // Here define the product category SLUG
                    $category_slug = $cateSlug;

                    $query_args = array(
                        'status' => 'publish',
                        'limit' => -1,
                        'category' => array($category_slug),
                    );

                    $data = array();
                    foreach (wc_get_products($query_args) as $product) {
                        foreach ($product->get_attributes() as $taxonomy => $attribute) {
                            $attribute_name = wc_attribute_label($taxonomy); // Attribute name
                            // Or: $attribute_name = get_taxonomy( $taxonomy )->labels->singular_name;
                            foreach ($attribute->get_terms() as $term) {
                                $data[$taxonomy][$term->term_id] = $term->name;
                                // Or with the product attribute label name instead:
                                // $data[$attribute_name][$term->term_id] = $term->name;
                            }
                        }
                    }

                    // Raw output (testing)
                    /* echo '
                     <pre>';
                     print_r($data);
                     echo '</pre>';

                     function printSelectOptions($array)
                     {
                     foreach ($array as $value => $label) {
                     echo "<option value=\"$value\">$label</option>";
                     }
                     } */ ?>

                    <!-- form filter -->
                    <form id="filterForm" class="woocommerce-ordering-price d-flex align-items-center"
                        action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="get">
                        <div class="select-box">
                            <select name="filter_color">
                                <option value="">Selecciona un color</option>
                                <?php
                                foreach ($data['pa_color'] as $value) {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                                ?>
                            </select>
                            <div class="arrow"></div>
                        </div>

                        <div class="select-box">
                            <select name="filter_talla">
                                <option value="">Selecciona una talla</option>
                                <?php
                                foreach ($data['pa_talla'] as $value) {
                                    echo '<option value="' . $value . '">' . $value . '</option>';
                                }
                                ?>
                            </select>
                            <div class="arrow"></div>
                        </div>

                        <div class="input-box">
                            <label for="min_price">Precio:</label>
                            <input type="text" name="min_price" id="min_price" oninput="formatCurrency(this)"
                                onblur="updateValue(this)" placeholder="$25.000">
                            <label for="max_price">-</label>
                            <input type="text" name="max_price" id="max_price" oninput="formatCurrency(this)"
                                onblur="updateValue(this)" placeholder="$500.000">
                        </div>


                        <button type="submit" class="quam-btn blue">Filtrar</button>
                        <div id="appliedFilters" class="filtro-activo-contenedor"></div>

                    </form>
                    <!-- Campos ocultos para mantener los parámetros de la URL -->
                    <?php /* wc_query_string_form_fields(null, array('size', 'color', 'min_price', 'max_price')); */ ?>
                </div>
                <div class="products text-center text-lg-end d-flex flex-wrap align-items-center flex-column">
                    <?= woocommerce_result_count() ?>
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