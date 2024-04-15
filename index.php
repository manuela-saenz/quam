<?php
get_header();
?>

<section id="banner">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="swiper banner">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="container">
                <div class="row">
                  <div class="col-lg-6 col-xxl-6 offset-xxl-1 info-banner" style="z-index: 3;">
                    <span>Some text here</span>
                    <h1 class="section-title">Aprovecha nuestras ofertas</h1>
                    <p>The Two golden rules professional graphic designer don’t want you to know about.</p>
                    <a href="" class="quam-btn red">Ver ofertas</a>
                  </div>
                  <div class="col-md-4">
                    <div class="img-fit">
                      <img src="<?php bloginfo('template_url') ?>/media/images/banner-men.png" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="container">
                <div class="row">
                  <div class="col-lg-6 col-xxl-6 offset-xxl-1 info-banner" style="z-index: 3;">
                    <h1 class="section-title">Lorem ipsum <b>dolor </b> sit amet</h1>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                      nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                      volutpat.</p>
                    <a href="" class="quam-btn red">Ver ofertas</a>
                    <div class="col-md-4">
                      <div class="img-fit">
                        <img src="" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
          </div>
          <div class="swiperBanner-button-next"> <i class="icon-arrowlongline-right"></i> </div>
          <div class="swiperBanner-button-prev"> <i class="icon-arrowlongline-left"></i> </div>
        </div>
      </div>
    </div>
</section>

<section id="categories" class="p-0">
  <div class="container-fuid p-0">
    <div class="row center-all">
      <!-- <?php $categories = get_terms(array(
              "taxonomy" => "product_cat",
              "parent" => 0,
            ));
            foreach ($categories as $cat) :
              $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
              $thumbUrl = wp_get_attachment_image_url($thumbnail_id, "medium");
            ?>
          <div class="col-md-4 p-0">
            <div class="card-categories">
              <div class="img-fit">
                <img src="<?= $thumbUrl ?>" alt="">
              </div>
              <div class="info-categories center-all flex-column">
                <h5><?= $cat->name ?></h5>
                <a href="<?= get_term_link($cat) ?>">Ver colección</a>
              </div>
            </div>
          </div>

          <?php endforeach; ?> -->

      <div class="col-md-4 p-0">
        <div class="card-categories">
          <div class="img-fit">
            <img src="<?php bloginfo('template_url') ?>/media/images/category-men.jpg" alt="">
          </div>
          <div class="info-categories center-all flex-column">
            <h5>Hombre</h5>
            <a href="">Ver colección</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 p-0">
        <div class="card-categories">
          <div class="img-fit">
            <img src="<?php bloginfo('template_url') ?>/media/images/category-women.png" alt="">
          </div>
          <div class="info-categories center-all flex-column">
            <h5>Mujer</h5>
            <a href="">Ver colección</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 p-0">
        <div class="card-categories">
          <div class="img-fit">
            <img src="<?php bloginfo('template_url') ?>/media/images/category-children.jpg" alt="">
          </div>
          <div class="info-categories center-all flex-column">
            <h5>Niño</h5>
            <a href="">Ver colección</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="generation">
  <div class="container slideGeneration">
    <div class="row">
      <div class="col-xxl-3 col-md-12 col-md-4 position-relative">
        <h3 class="section-subtitle mb-5">Última generación</h3>
        <div class="d-xl-flex d-none">
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
      <div class="col-xxl-9 col-md-12 ">
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
          <div class="d-xl-none d-flex">
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

<?php
$colecciones = get_field('colecciones');
$primera_coleccion = $colecciones['primera_coleccion'];
$segunda_coleccion = $colecciones['segunda_coleccion'];
?>
<section id="summer_collection" class="p-0">
  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-md-8 p-0 position-relative">
        <div class="img-fit backgroundImg">
          <img src="<?= $primera_coleccion["fondo_de_imagen"]["url"]; ?>" alt="">
        </div>
        <div class="info_summer">
          <p class="mb-0"><?= $primera_coleccion["subtitulo"]; ?></p>
          <h5 class="title"><?= $primera_coleccion["titulo"]; ?></h5>
        </div>
      </div>
      <div class="col-md-4 p-0">
        <a href="" class="position-relative">
          <div class="img-fit">
            <img src="<?= $segunda_coleccion["fondo_de_imagen"]["url"]; ?>" alt="">
          </div>
          <div class="info_summer">
            <p class="mb-0"><?= $segunda_coleccion["subtitulo"]; ?></p>
            <h5 class="title"><?= $segunda_coleccion["titulo"]; ?></h5>
          </div>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- <section id="product_highlights">
  <div class="container slideGeneration">
    <div class="row center-all">
      <div class="col-md-4 col-md-12 position-relative">
        <h2 class="section-subtitle">Productos destacados</h2>
        <div class="d-none d-lg-flex">
          <div class="arrow-prev-container">
            <button class="highlights-arrows prev">
              <i class="icon-arrowline-left"> </i>
            </button>
            <div class="white-mask"></div>
          </div>
          <div class="arrow-next-container">
            <button class="highlights-arrows next">
              <i class="icon-arrowline-right"> </i>
            </button>
            <div class="white-mask"></div>
          </div>
        </div>

      </div>
      <div class="col-md-8 col-md-12 highlights">
        <div class="swiper highlightsSwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="img-contain">
                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-1.jpg" alt="" title="">
              </div>
              <div class="info-highlights">
                <h5>Example Midi Bodycon Dress</h5>
                <div class="d-flex align-items-center">
                  <p>$70.000</p>
                  <span>$100.000</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
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
            <div class="swiper-slide">
              <div class="img-contain">
                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-3.jpg" alt="" title="">
              </div>
              <div class="info-highlights">
                <h5>Example Midi Bodycon Dress</h5>
                <div class="d-flex align-items-center">
                  <p>$70.000</p>
                  <span>$100.000</span>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="img-contain">
                <img src="<?php bloginfo('template_url') ?>/media/images/Destacados-3.jpg" alt="" title="">
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
          <div class="d-lg-none d-flex">
            <div class="arrow-prev-container">
              <button class="highlights-arrows prev">
                <i class="icon-arrowline-left"> </i>
              </button>
              <div class="white-mask"></div>
            </div>
            <div class="arrow-next-container">
              <button class="highlights-arrows next">
                <i class="icon-arrowline-right"> </i>
              </button>
              <div class="white-mask"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</section>

<?php
$ofertas = get_field('ofertas');
$coleccionOf = $ofertas['oferta_principal'];
$oferta = $ofertas['oferta'];
?>
<section id="offers" class="p-0">
  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-md-4 p-0">
        <a href="" class="position-relative">
          <div class="img-fit">
            <img src="<?= $oferta["fondo_de_imagen"]["url"]; ?>" alt="">
          </div>
          <div class="info_offers">
            <p class="mb-0"><?= $oferta["subtitulo"]; ?></p>
            <h5 class="title"><?= $oferta["titulo"]; ?></h5>
          </div>
        </a>
      </div>
      <div class="col-md-8 p-0 position-relative">
        <div class="img-fit backgroundImg">
          <img src="<?= $coleccionOf["fondo_de_imagen"]["url"]; ?>" alt="">
        </div>
        <div class="info_offers offers">
          <p class="mb-0"><?= $coleccionOf["subtitulo"]; ?></p>
          <h5 class="section-title"><?= $coleccionOf["titulo"]; ?></h5>
        </div>
      </div>
    </div>
  </div>
</section> -->

<?php
get_footer();
?>