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
                    <h1 class="woocommerce-products-header__title page-title <?= is_search() ? 'section-subtitle-2' : 'section-subtitle' ?>  mb-0">
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
            <div class="col-md-12 d-flex justify-content-between select_men align-items-end">
                <div class="select d-flex gap-2">
                    <?php
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

                    $max_price = null;
                    $min_price = null;

                    $numeric_prices = array_filter($all_prices, function ($price) {
                        return is_numeric($price);
                    });

                    if (!empty($numeric_prices)) {
                        $max_price = reset($numeric_prices);
                        $min_price = reset($numeric_prices);
                    }

                    foreach ($numeric_prices as $price) {
                        if ($price > $max_price) {
                            $max_price = $price;
                        }
                        if ($price < $min_price) {
                            $min_price = $price;
                        }
                    }

                    $precio_maximo = $max_price;
                    $precio_minimo = $min_price;

                    // categorias


                    function get_all_product_categories_and_attributes()
                    {
                        // Obtener todas las categorías de productos
                        $product_categories = get_terms(
                            array(
                                'taxonomy' => 'product_cat',
                                'hide_empty' => false,
                                'parent' => 0,
                                'exclude'    => array(26, 15),
                            )
                        );

                        // Array para almacenar las categorías y sus atributos
                        $categories_and_attributes = array();

                        // Iterar sobre cada categoría de producto
                        foreach ($product_categories as $category) {
                            // Obtener los productos de la categoría actual
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $category->term_id,
                                    ),
                                ),
                            );
                            $products = get_posts($args);

                            // Array para almacenar los atributos de los productos en esta categoría
                            $attributes = array();

                            // Iterar sobre cada producto
                            foreach ($products as $product_post) {
                                $product = wc_get_product($product_post->ID);

                                // Obtener los atributos del producto
                                $product_attributes = $product->get_attributes();

                                // Iterar sobre cada atributo y almacenarlo en el array de atributos
                                foreach ($product_attributes as $attribute) {
                                    if ($attribute->get_variation()) { // Verifica si el atributo se usa para variaciones
                                        if ($attribute->is_taxonomy()) {
                                            $taxonomy = $attribute->get_taxonomy_object();
                                            $terms = wp_get_post_terms($product_post->ID, $attribute->get_name());
                                            foreach ($terms as $term) {
                                                $attributes[$taxonomy->attribute_label][] = $term->name;
                                            }
                                        } else {
                                            $attribute_name = $attribute->get_name();
                                            $options = $attribute->get_options();
                                            foreach ($options as $option) {
                                                $attributes[$attribute_name][] = $option;
                                            }
                                        }
                                    }
                                }
                            }

                            // Eliminar duplicados y almacenar en el array principal
                            foreach ($attributes as $key => $values) {
                                $attributes[$key] = array_unique($values);
                            }

                            // Almacenar los atributos en la categoría correspondiente
                            $categories_and_attributes[$category->name] = $attributes;


                            // echo '<pre>';
                            // echo "Categoría: " . $category->name . "\n";
                            // print_r($attributes);
                            // echo '</pre>';
                        }

                        return $categories_and_attributes;
                    }

                    // Llamar a la función y obtener los datos
                    $categories_and_attributes = get_all_product_categories_and_attributes(); ?>

                    <!-- form filter -->
                    <div class="btn-filter-responsive">
                        <div class="cont-select-box">
                            <div class="select-box input-box cerrar-filtros">
                                <label>Filtro</label>
                            </div>
                        </div>
                    </div>
                    <div class="cont-form-responsive ">
                        <div class="close-filtros">
                            <h2>Filtro:</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="cerrar-filtros" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </div>


                        <form id="filterForm" class="woocommerce-ordering-price d-flex align-items-end" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="get">
                            <div class="cont-select-box">
                                <label for="category-filter">Categoría:</label>
                                <div class="select-box input-box">
                                    <select name="filter_category" id="category-filter">
                                        <option value="" disabled selected>Selecciona Categoría</option>
                                        <?php foreach ($categories_and_attributes as $category => $attributes) : ?>
                                            <option <?= convertToSlug($category) === $cate->slug ? 'selected' : 'false' ?> value="<?= $category ?>"><?= $category ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="cont-flecha">
                                        <label for="category-filter">
                                            <div class="arrow"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <?php foreach ($categories_and_attributes as $category => $attributes) : ?>
                                    <div class=" align-items-end <?= $cateSlug === convertToSlug($category) ? 'd-flex' : 'd-none' ?>" data-current-cat="<?= convertToSlug($category) ?>">
                                        <?php foreach ($attributes as $key => $attribute) : ?>
                                            <div class="cont-select-box">
                                                <label for=""><?= $key ?>:</label>
                                                <div class="select-box input-box">
                                                    <select name="filter_color" id="color-filter">
                                                        <option value="" disabled selected>Selecciona Color</option>
                                                        <?php foreach ($attribute as $item) : ?>
                                                            <option value="<?= $item ?>"> <?= $item ?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                    <div class="cont-flecha">
                                                        <label for="color-filter">
                                                            <div class="arrow"></div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="cont-select-box">
                                            <label>Precio</label>
                                            <div class="d-flex align-items-center">
                                                <div class="select-box input-box">
                                                    <input type="text" name="min_price" id="min_price" oninput="formatCurrency(this)" onblur="updateValue(this)" placeholder="Min: <?= $precio_minimo ?>">
                                                </div>
                                                <div class="select-box">
                                                    <span class="span-price-sign">-</span>
                                                </div>
                                                <div class="cont-select-box">
                                                    <div class="select-box input-box">
                                                        <input type="text" name="max_price" id="max_price" oninput="formatCurrency(this)" onblur="updateValue(this)" placeholder="Max: <?= $precio_maximo ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="quam-btn blue">Filtrar</button>
                                        <div id="appliedFilters" class="filtro-activo-contenedor"></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </form>
                    </div>
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