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

<section id="bannerCategory" class="padg-mobile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-subtitle"><?= $currentCat->name ?></h2>
            </div>
        </div>
    </div>
</section>

<section id="infoProducts" class="pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center select_men">
                <div class="select">
                    <!-- The second value will be selected initially -->
                    <div class="select-box">
                        <select>
                            <option value="opcion1">Talla</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select>
                        <div class="arrow"></div>
                    </div>

                    <!-- The second value will be selected initially -->
                    <div class="select-box">
                        <select>
                            <option value="opcion1">Color</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select>
                        <div class="arrow"></div>
                    </div>

                    <!-- The second value will be selected initially -->
                    <div class="select-box">
                        <select>
                            <option value="opcion1">Precio</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select>
                        <div class="arrow"></div>
                    </div>

                    <!-- The second value will be selected initially -->
                    <div class="select-box">
                        <select>
                            <option value="opcion1">Orden</option>
                            <option value="opcion2">Opción 2</option>
                            <option value="opcion3">Opción 3</option>
                            <option value="opcion4">Opción 4</option>
                        </select>
                        <div class="arrow"></div>
                    </div>
                </div>

                <div class="products text-center text-md-end">
                    <p class="mb-0">54 productos</p>
                </div>


            </div>
            <div class="col-md-12 mt-5">
                <div class="row">
                    <?php
                        foreach ($products as $key => $product) {
                            $prices = $product->prices;
                            ?>
                                <div class="col-lg-3 col-sm-6">
                                    <a href="https://www.quam.com.co/web_quam/producto/<?php echo $product->get_slug() ?>/" class="CardProducts">
                                        <div class="img-contain">
                                            <img src="<?php echo $product->image_src ?>" alt="<?php echo $product->get_name() ?>">
                                        </div>
                                        <div class="info-highlights">
                                            <h5><?php echo $product->get_name(); ?></h5>
                                            <div class="d-flex align-items-center">

                                                <?php 
                                                if ($prices['sale_price']) {
                                                    // Si hay un precio de venta, mostrar el precio de venta y tachar el precio regular
                                                    echo '<span class="">' . wc_price($prices['sale_price']) . '</span>';
                                                    echo '<span class="regular-price">' . wc_price($prices['regular_price']) . '</span>';
                                                    
                                                } else {
                                                    // Si no hay precio de venta, mostrar solo el precio regular
                                                    echo '<span class="regular-price">' . wc_price($prices['regular_price']) . '</span>';
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                    ?>
                    
                </div>

            </div>
            <div class="d-lg-none d-flex align-items-center justify-content-center w-100">
                <nav class="pagination_section" aria-label="...">
                    <ul class="pagination pagination-lg">
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</section>

<?php get_footer() ?>