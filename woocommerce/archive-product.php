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
                    <div class="col-lg-3 col-sm-6">
                        <a href="https://www.quam.com.co/web_quam/producto/camiseta-polo-slim-para-hombre-reblwh/" class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="CardProducts">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-2.jpg" alt="" title="">
                            </div>
                            <div class="info-highlights">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>

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