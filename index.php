<?php
get_header();

$banners  = (new WP_Query(array(
  'post_type' => 'banner',
  'posts_per_page' => -1,

)))->posts;

?>

<section id="banner">
  <div class="container-fluid ">
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="swiper banner">
          <div class="swiper-wrapper">
            <?php foreach ($banners as $banner) : ?>
              <div class="swiper-slide">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 col-xxl-6 offset-xxl-1 info-banner" style="z-index: 3;">
                      <!-- <span>Some text here</span> -->
                      <h1 class="section-title"><?= $banner->post_title ?></h1>
                      <!-- <p>The Two golden rules professional graphic designer don’t want you to know about.</p> -->
                      <a href="<?= $banner->btn_url ?>" class="quam-btn red">Ver ofertas</a>
                    </div>
                    <div class="col-md-4">
                      <div class="img-contain">
                        <img src="<?= get_the_post_thumbnail_url($banner->ID)  ?>" title="<?= $banner->post_title ?>" alt="<?= $banner->post_title ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="swiperBanner-button-next"> <i class="icon-arrowlongline-right"></i> </div>
          <div class="swiperBanner-button-prev"> <i class="icon-arrowlongline-left"></i> </div>
        </div>
      </div>
    </div>
</section>

<section id="categories" class="overflow-hidden pt-0">
  <div class="container-fuid p-0">
    <div class="row center-all">
      <?php $categories = get_terms(array(
        "taxonomy" => "product_cat",
        "parent" => 0,
        'exclude'    => array(26, 15),
        "hide_empty" => false,
      ));
      foreach ($categories as $cat) :
        $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $thumbUrl = wp_get_attachment_image_url($thumbnail_id, "large");
      ?>

        <div class="col-md-4 p-0 position-relative">
          <div class="card-categories d-flex position-relative">
            <a href="<?= get_term_link($cat->term_id) ?>" class="img-fit w-100 h-100">
              <img src="<?= $thumbUrl ?>" title="<?= $cat->name ?>" alt="<?= $cat->name ?>">
            </a>
            <a href="<?= get_term_link($cat->term_id) ?>" class="info-categories center-all flex-column position-absolute">
              <h5><?= $cat->name ?></h5>
              <div class="red">Ver colección</div>
            </a>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="generation">
  <div class="container slideGeneration">
    <div class="row align-items-center">
      <div class="col-xxl-3 col-md-12 col-md-4">
        <div class="position-relative">
          <h3 class="section-subtitle mb-4">Última generaciónn</h3>
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
          <!-- <div class="d-xl-none d-flex">
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
          </div> -->
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
<section id="summer_collection" class="pb-0">
  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-md-8 p-0 position-relative">
        <a href="" class="position-relative">
          <div class="img-fit backgroundImg">
            <img src="<?= $primera_coleccion["fondo_de_imagen"]["url"]; ?>" alt="">
          </div>
          <div class="info_summer text-black">
            <p class="mb-0"><?= $primera_coleccion["subtitulo"]; ?></p>
            <h5 class="title"><?= $primera_coleccion["titulo"]; ?></h5>
          </div>
        </a>
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


<?php
$ofertas = get_field('ofertas');
$coleccionOf = $ofertas['oferta_principal'];
$oferta = $ofertas['oferta'];
?>


<?php
get_footer();
?>