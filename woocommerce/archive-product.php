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
$filter_color = isset($_GET['filter_color']) ? $_GET['filter_color'] : null;
$filter_talla = isset($_GET['filter_talla']) ? $_GET['filter_talla'] : null;
$campana = get_field('etiqueta_de_tipo_campana', $currentCat);
$featuredImage = get_field('imagen_destacada', $currentCat);
?>


<section id="bannerCategory" class=" position-relative overflow-hidden p-0 <?= $campana ? 'img-fit campaign' : '' ?>">

    <?php if (!$campana) { ?>
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
    <?php } else { ?>
        <img src="<?= $featuredImage['url'] ?>" alt="<?php woocommerce_page_title(); ?>">
    <?php } ?>
</section>

<section id="infoProducts" class="pt-4">
    <div class="container ">
        <?php if (!isset($_GET['s'])): ?>
            <div class="">
                <div class="col-md-12 d-flex justify-content-between select_men fw-semibold align-items-end d-sm-none">
                    <div class="input-box filtering-responsive-btns cerrar-filtros center-all gap-2 w-100 rounded-0 border-top-0 border-left-0 border-bottom-0 border-white">
                        Filtros <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-caret-down">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 9c.852 0 1.297 .986 .783 1.623l-.076 .084l-6 6a1 1 0 0 1 -1.32 .083l-.094 -.083l-6 -6l-.083 -.094l-.054 -.077l-.054 -.096l-.017 -.036l-.027 -.067l-.032 -.108l-.01 -.053l-.01 -.06l-.004 -.057v-.118l.005 -.058l.009 -.06l.01 -.052l.032 -.108l.027 -.067l.07 -.132l.065 -.09l.073 -.081l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01l.057 -.004l12.059 -.002z" />
                        </svg>
                    </div>
                    <div class="input-box filtering-responsive-btns order-products center-all gap-2 w-100 rounded-0 border-top-0 border-right-0 border-white border-bottom-0">
                        Ordenar <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-caret-down">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 9c.852 0 1.297 .986 .783 1.623l-.076 .084l-6 6a1 1 0 0 1 -1.32 .083l-.094 -.083l-6 -6l-.083 -.094l-.054 -.077l-.054 -.096l-.017 -.036l-.027 -.067l-.032 -.108l-.01 -.053l-.01 -.06l-.004 -.057v-.118l.005 -.058l.009 -.06l.01 -.052l.032 -.108l.027 -.067l.07 -.132l.065 -.09l.073 -.081l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01l.057 -.004l12.059 -.002z" />
                        </svg>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-between select_men align-items-end gap-3">
                    <div class="select d-flex gap-2 w-100">
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
                                    'exclude' => array(26, 15),
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
                        $categories_and_attributes = get_all_product_categories_and_attributes();


                        ?>

                        <!-- form filter -->

                        <div class="cont-form-responsive bg-white">
                            <div class="close-filtros">
                                <h2>Filtro:</h2>
                                <svg xmlns="http://www.w3.org/2000/svg" class="cerrar-filtros" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </div>

                            <?php
                            $categories_data = get_all_product_categories_attributes_and_prices();
                            $current_category = get_queried_object();
                            ?>
                            <form id="filterForm" class="woocommerce-ordering-price d-flex align-items-end" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="get">
                                <div class="cont-select-box">
                                    <label for="">Categoria</label>
                                    <div class="select-box input-box">
                                        <select name="" id="cat-selector" class="w-100">
                                            <?php foreach ($categories_data[1] as $cat) : ?>
                                                <option value="<?= $cat->slug ?>" <?= $current_category->slug === $cat->slug ? 'selected' : '' ?>><?= $cat->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="cat-attributes" class="d-flex flex-column flex-xl-row">
                                    <?php if (isset($categories_data[0][$current_category->slug])) {
                                        foreach ($categories_data[0][$current_category->slug]['attributes'] as $key => $cat_attributes) : ?>
                                            <div class="cont-select-box">
                                                <label><?= $key ?></label>
                                                <div class="select-box input-box">
                                                    <select data-name="<?= convertToSlug($key) ?>" id="" class="w-100">
                                                        <option value="">Selecciona <?= $key ?></option>
                                                        <?php foreach ($cat_attributes as $cat_slug => $cat_attr) : ?>
                                                            <option value="<?= $cat_slug ?>"><?= $cat_attr ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </div>
                                <div class="cont-select-box">
                                    <label>Precio</label>
                                    <div class="d-flex align-items-center flex-column flex-xl-row">
                                        <div class="select-box input-box">
                                            <input type="text" name="min_price" id="min_price" oninput="formatCurrency(this)" onblur="updateValue(this)" placeholder="Min: <?= $categories_data[0][$current_category->slug]['min_price'] ?>">
                                        </div>
                                        <div class="select-box">
                                            <span class="span-price-sign">-</span>
                                        </div>
                                        <div class="cont-select-box">
                                            <div class="select-box input-box">
                                                <input type="text" name="max_price" id="max_price" oninput="formatCurrency(this)" onblur="updateValue(this)" placeholder="Max: <?= $categories_data[0][$current_category->slug]['max_price'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" disabled class="quam-btn blue">Filtrar</button>

                            </form>
                            <div id="categories-attributes-full">
                                <?php foreach ($categories_data[0] as $key => $catData) : ?>
                                    <div data-cat-name="<?= $key ?>">
                                        <div data-attributes='<?= htmlspecialchars(json_encode($catData['attributes']), ENT_QUOTES, 'UTF-8') ?>' data-max-price="<?= $catData['max_price'] ?>" data-min-price="<?= $catData['min_price'] ?>"></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div id="categories-attributes-full">
                                <?php foreach ($categories_data[0] as $key => $catData) : ?>
                                    <div data-cat-name="<?= $key ?>">
                                        <div data-attributes='<?= htmlspecialchars(json_encode($catData['attributes']), ENT_QUOTES, 'UTF-8') ?>' data-max-price="<?= $catData['max_price'] ?>" data-min-price="<?= $catData['min_price'] ?>"></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="products text-center text-lg-end d-flex flex-wrap align-items-md-end align-items-center flex-column w-100">

                        <div class="select-box w-0 h-0 h-md-auto">
                            <?php woocommerce_catalog_ordering(); ?>
                            <div class="arrow d-none d-sm-flex"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-none">
                    <div class="center-all border-top border-bottom mt-3 py-2"><?= woocommerce_result_count() ?></div>
                </div>
            </div>
        <?php endif; ?>

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

                     wc_get_template_part('content', 'product'); ?>
                        <?php //wc_get_template_part('content', 'producto'); ?>
        <?php
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

        <!-- <nav aria-label="Page navigation example d-none" >
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
        </nav> -->

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var page = 1;

            var color = '<?= empty($filter_color) ? null : $filter_color ?>';
            var talla = '<?= empty($filter_talla) ? null : $filter_talla ?>';

            $(document).ready(function() {
                var loadMoreExecuted = false; // Booleano para controlar la ejecución
                var lastScrollTop = 0; // Variable para rastrear la dirección del scroll

                $(window).scroll(function() {
                    var $gallery = $('.row.galleryP');
                    var galleryMidPoint = $gallery.offset().top + ($gallery.outerHeight() / 4);

                    // Obtener la posición actual del scroll
                    var currentScrollTop = $(window).scrollTop();

                    // Verificar si el usuario está desplazándose hacia abajo
                    if (currentScrollTop > lastScrollTop) {
                        if (currentScrollTop + $(window).height() > galleryMidPoint) {
                            if (!color && !talla && !loadMoreExecuted) {
                                loadMoreProducts(arrayData);
                            }
                        }
                    }

                    // Verifica si el usuario llegó al final de la página
                    if (currentScrollTop + $(window).height() >= $(document).height()) {
                        loadMoreExecuted = true; // Marcar como ejecutado
                    }

                    // Actualizar la posición anterior del scroll
                    lastScrollTop = currentScrollTop;
                });
            });

            var isLoading = false;
            let insertCount = 0;
            var arrayData = [];

            function loadMoreProducts() {
                if (insertCount < 5 && arrayData.length > 0) {
                    let placeholders = '';
                    for (let i = 0; i < (5 - insertCount); i++) {
                        placeholders += `
                            <div class="col-lg-3 col-sm-6 col-6 product type-product post-146 status-publish first outofstock has-post-thumbnail shipping-taxable purchasable product-type-variation loading" data-id="toastCardLoad">
                                <div class="CardProducts w-100 placeholder-glow">
                                    <div class="img-contain placeholder w-100"></div>
                                    <div class="info-highlights opacity-25">
                                        <h5 class="col-12 placeholder md-2"></h5>
                                        <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                                            <p class="mb-0 d-flex gap-2 placeholder col-6"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        insertCount++;
                    }
                    $('.galleryP.pt-3').append(placeholders);
                }

                if (!isLoading) {
                    isLoading = true;
                    var dataInserted = false;

                    var $gallery = $('.row.galleryP');
                    var existingProductIdsSet = new Set(
                        $gallery.children().map(function() {
                            return $(this).data('id');
                        }).get()
                    );

                    $.ajax({
                        url: ajaxUrl,
                        type: "POST",
                        data: {
                            'paged': page,
                            'action': 'load_products',
                            'category': '<?= $currentCat->slug ?>'
                        },
                        success: function(data) {
                            $('[data-id="toastCardLoad"]').remove();
                            let newProductsHtml = '';
                            data.forEach(item => {
                                if (!existingProductIdsSet.has(item.id)) {
                                    newProductsHtml += `
                                    <div class="col-lg-3 col-sm-6 col-6 product type-product post-146 status-publish first outofstock has-post-thumbnail shipping-taxable purchasable product-type-variation loading" data-id="${item.id}">
                                        <a href="${item.permalink}" class="CardProducts w-100">
                                            <div class="img-contain" title="${item.name}" data="${item.image}">
                                                <img data-src="${item.image}" width="150" height="150" alt="${item.name}">
                                            </div>
                                            <div class="info-highlights">
                                                <h5 title="${item.name}">${item.name}</h5>
                                                <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                                                    <p class="mb-0 d-flex gap-2">
                                                        <del aria-hidden="true">
                                                            <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>&nbsp;${item.price}</bdi></span>
                                                        </del> 
                                                        <ins aria-hidden="true">
                                                            <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>&nbsp;${item.price}</bdi></span>
                                                        </ins>
                                                        COP
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>`;
                                    dataInserted = true;
                                }
                            });
                            $gallery.append(newProductsHtml);
                            arrayData = data;
                        },
                        complete: function() {
                            const images = document.querySelectorAll("img[data-src]");
                            const observer = new IntersectionObserver((entries) => {
                                entries.forEach((entry) => {
                                    if (entry.isIntersecting) {
                                        const img = entry.target;
                                        img.src = img.getAttribute("data-src");
                                        observer.unobserve(img);
                                    }
                                });
                            });

                            images.forEach((img) => {
                                observer.observe(img);
                            });

                            isLoading = false;
                            insertCount = 0;
                            page++;
                        }
                    });
                }
            }
        </script> -->

    </div>

</section>

<?php get_footer() ?>