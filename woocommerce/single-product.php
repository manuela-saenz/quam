<?php
get_header();

global $post;
$product = wc_get_product($post);
$terms = get_the_terms($post->ID, 'product_cat');
$produts_use = get_the_terms($post->ID, 'product_tag');

// echo '<pre>';
//  print_r($product);
//  echo '<pre>';
$attachment_ids = $product->get_gallery_image_ids();
foreach ($attachment_ids as $attachment_id) {
    $images[] = wp_get_attachment_image_url($attachment_id, "large");
};

$attributes = $product->get_attributes();


// echo '<pre>';
// print_r($product);
// echo '<pre>';
// Iterar sobre cada atributo

?>


<section id="Singleimgprincipal" class="padg-mobile">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 imgP">
                <div thumbsSlider="" class="swiper SingProducts mt-4">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $img) : ?>
                            <div class="swiper-slide">
                                <div class="img-fit">
                                    <img src="<?= $img ?>" />
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 gallery">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper SingProducts2">
                    <div class="swiper-wrapper">
                        <?php foreach ($images as $img) : ?>
                            <div class="swiper-slide">
                                <div class="img-fit">
                                    <img src="<?= $img ?>" />
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div class="SingProducts-button-next"></div>
                    <div class="SingProducts-button-prev"></div>
                    <div class="swiper-scrollbar"></div>
                </div>

            </div>

            <div class="col-lg-6  information-product mt-4">
                <div class="info-product">

                    <div class="p-4 bg-white">
                        <span class="ref-number">SKU: <?= $sku = $product->get_sku() ?> </span>
                        <h1 class="section-subtitle"> <?= $post->post_title ?></h1>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center price">
                                <p>$<?= $product->get_price() ?></p>
                                <span><?= $product->get_regular_price() ?> </span>
                            </div>
                            <button class="button-heart d-lg-none"> <i class="icon-heart"></i> </button>
                        </div>
                        <button class="quam-btn blue d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Agregar a la bolsa</button>

                        <div>
                            <p> <?= $product->get_short_description() ?></p>
                        </div>
                        <div class="product-actions mb-md-5" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                            <div class="p-4 p-md-0">
                                <?php
                                global $product;
                                if ($product->is_type('variable')) {
                                    // $default_attributes = $product->get_default_attributes();
                                    woocommerce_variable_add_to_cart();
                                } else {
                                    woocommerce_simple_add_to_cart();
                                }
                                ?>
                            </div>
                        </div>
                        <div class="share d-flex align-items-center">
                            <p class="m-0"> <b>Compartir: </b> </p>

                            <div>
                                <i class="icon-facebook"></i>
                                <i class="icon-x"></i>
                                <i class="icon-whatsapp1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="sm-floating-box d-md-none">
                        <div id="box-draggable">
                            <div class="p-4 bg-white">
                                <div class="main-box">
                                    <h1 class="section-subtitle"><?= $post->post_title ?></h1>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center price">
                                            <p>$<?= $product->get_price() ?></p>
                                            <span><?= $product->get_regular_price() ?> </span>
                                        </div>
                                        <button class="button-heart" type="button"> <i class="icon-heart"></i> </button>
                                    </div>
                                    <button class="quam-btn blue d-lg-none open-selector" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Agregar a la bolsa</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="characteristics d-none d-lg-flex">
    <div class="container">
        <div class="">
            <div class="d-flex align-items-start row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Descripción</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Información adicional</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Reseñas (12)</button>

                    </div>
                </div>

                <div class="col-md-8 offset-md-1">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <?= $product->get_description() ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">.In marketing a product is an object or system made available for consumer use it is anything that can be offered to a market to the desire or need of a \retailing, products are often referred to as merchandise, and in manufacturing, products are bought as materials and then sold as finished goods. A service regarded to as a type of product. Commodities are usually raw materials metals and agricultural products, but a commodity can also be anything wide the open market. In project management, the formal definition of the project deliverables A product can be classified as tangible or intangible. A tangible product is a physical object that can be perceived by touch building, vehicle, gadget, An intangible product is a product that can only be perceived indirectly such as an insurance policy. can be broadly classified under intangible be durable or non durable. A product line is "a group of products that are closely either because they function in a similar manner, are sold to the same customergroups.</div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">.In marketing a product is an object or system made available for consumer use it is anything that can be offered to a market to the desire or need of a \retailing, products are often referred to as merchandise, and in manufacturing, products are bought as materials and then sold as finished goods. A service regarded to as a type of product. Commodities are usually raw materials metals and agricultural products, but a commodity can also be anything wide the open market. In project management, the formal definition of the project deliverables A product can be classified as tangible or intangible. A tangible product is a physical object that can be perceived by touch building, vehicle, gadget, An intangible product is a product that can only be perceived indirectly such as an insurance policy. can be broadly classified under intangible be durable or non durable. A product line is "a group of products that are closely either because they function in a similar manner, are sold to the same customergroups.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="generation" class="generation_product d-none d-lg-flex">
    <div class="container">
        <div class="row">
            <div class="col-md-12 position-relative">
                <h3 class="section-subtitle text-center">También te podría interesar </h3>

            </div>
            <div class="col-md-12">
                <div class="swiper generationSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-1.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-2.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-3.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-4.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-2.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-3.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-contain">
                                <img src="<?php bloginfo('template_url') ?>/media/images/generation-4.jpg" alt="" title="">
                            </div>
                            <div class="info-generation">
                                <h5>Example Midi Bodycon Dress</h5>
                                <div class="d-flex align-items-center">
                                    <p>$70.000</p>
                                    <span>$100.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="arrow-prev-container">
                        <button class="generation-arrows prev">
                            <i class="icon-arrowline-left"> </i>
                        </button>
                    </div>
                    <div class="arrow-next-container">
                        <button class="generation-arrows next">
                            <i class="icon-arrowline-right"> </i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php get_footer() ?>