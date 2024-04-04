<?php

/**
 * Template Name: single categoria
 */


get_header() ?>

<section class="padg-mobile">
    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <div thumbsSlider="" class="swiper SingProducts">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="img-fit">
                                <img src="<?php bloginfo('template_url') ?>/media/images/singleproduct-1.jpg" />
                            </div>

                        </div>
                        <div class="swiper-slide">
                            <div class="img-fit">
                                <img src="<?php bloginfo('template_url') ?>/media/images/singleproduct-2.jpg" />
                            </div>

                        </div>
                        <div class="swiper-slide">
                            <div class="img-fit">
                                <img src="<?php bloginfo('template_url') ?>/media/images/singleproduct-3.jpg" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper SingProducts2">
                    <div class="swiper-scrollbar"></div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="img-fit">
                                <img src="<?php bloginfo('template_url') ?>/media/images/singleproduct-1.jpg" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-fit">
                                <img src="<?php bloginfo('template_url') ?>/media/images/singleproduct-2.jpg" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img-fit">
                                <img src="<?php bloginfo('template_url') ?>/media/images/singleproduct-3.jpg" />
                            </div>
                        </div>
                    </div>
                    <div class="SingProducts-button-next"></div>
                    <div class="SingProducts-button-prev"></div>

                </div>

            </div>

            <div class="col-md-6  information-product">
                <div class="info-product">
                    <span class="ref-number">SKU: B01D0MX8SJ </span>
                    <h1 class="section-subtitle"> Camiseta polo Slim para hombre REBLWH</h1>
                    <div class="d-flex align-items-center price">
                        <p>$70.000</p>
                        <span>$100.000</span>
                    </div>
                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend, arcu vel
                            dapibus vehicula, mauris dui mattis tellus, vitae imperdiet libero turpis vitae
                            sapien. Donec at urna enim. </p>
                    </div>
                    <div class="product-feature">
                        <div class="d-flex">
                            <strong>Color:</strong>
                            <p class="mb-0 color-name"></p>
                        </div>
                        <div class="variant-item">
                            <div class="product-var">
                                <input type="radio" id="negro" name="varcolor" style="background: #1C1C1C;">
                                <label for="negro" class="var-content"></label>
                            </div>
                            <div class="product-var ">
                                <input type="radio" id="mixto" checked name="varcolor" style="background: #002D72;">
                                <label for="blanco" class="var-content"></label>
                            </div>
                            <div class="product-var ">
                                <input type="radio" id="rojo" checked name="varcolor" style="background: #FF3747;">
                                <label for="blanco" class="var-content"></label>
                            </div>

                        </div>
                    </div>

                    <div class="product-feature">
                        <div class="d-flex">
                            <strong>Talla:</strong>
                        </div>
                        <div class="d-flex">

                            <div class="" role="group" aria-label="Vertical radio toggle button group">
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked>
                                <label class="btn " for="vbtn-radio1">S</label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                                <label class="btn " for="vbtn-radio2">M</label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                                <label class="btn " for="vbtn-radio3">L</label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio4" autocomplete="off">
                                <label class="btn " for="vbtn-radio4">XL</label>
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio5" autocomplete="off">
                                <label class="btn " for="vbtn-radio5">XXL</label>
                            </div>
                        </div>

                    </div>
                    <div class="product-actions d-flex align-items-center">
                        <div class='quantity'>
                            <button class='qtyminus minus'><i class="icon-minus"></i></button>
                            <input type='text' id="singleProductQuantity" name='quantity' value='1' class='qtySingle' />
                            <button class='qtyplus plus'><i class="icon-add---copia"></i></button>
                        </div>
                        <a href="" class="quam-btn blue">Agregar a la bolsa</a>
                        <button class="button-heart"> <i class="icon-heart"></i> </button>
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
            </div>
        </div>
    </div>
    </div>
</section>

<section class="characteristics">
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
                            In marketing a product is an object or system made available for consumer use it is
                            anything that can be offered to a market to the desire or need of a \retailing, products
                            are often referred to as merchandise, and in manufacturing, products are bought as
                            materials and then sold as finished goods. A service regarded to as a type of product.
                            Commodities are usually raw materials metals and agricultural products, but a commodity
                            can also be anything wide the open market. In project management, the formal definition
                            of the project deliverables
                            <br> <br>
                            A product can be classified as tangible or intangible. A tangible product is a physical
                            object that can be perceived by touch building, vehicle, gadget, An intangible product
                            is a product that can only be perceived indirectly such as an insurance policy. can be
                            broadly classified under intangible be durable or non durable. A product line is "a
                            group of products that are closely either because they function in a similar manner, are
                            sold to the same customergroups.
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="generation" class="generation_product">
    <div class="container">
        <div class="row">
            <div class="col-md-12 position-relative">
                <h3 class="section-subtitle">Última generación</h3>

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
                    </div>
                    <div class="w-100">
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
    </div>
</section>

<?php get_footer() ?>