<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
        <?php
        if (is_front_page()) {
            bloginfo('description');
            echo ' - ';
            bloginfo('name');
        } elseif (function_exists('is_tag') && is_tag()) {
            single_tag_title("Archivo de &quot;");
        } elseif (is_archive()) {
            wp_title('');
        } elseif (is_search()) {
            echo 'Búsqueda para &quot;' . wp_specialchars($s) . '&quot; - ';
            bloginfo('name');
        } elseif (!(is_404()) && (is_single()) || (is_page()) || (is_home())) {
            wp_title('');
        } elseif (is_404()) {
            echo 'No encontrado - ';
        }
        if ($paged > 1) {
            echo ' - página ' . $paged;
        }
        ?>
    </title>
  <link rel="icon" href="favicon/favicon-1.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/custom.min.css?=v<?= randomCode() ?>" />
  <script>
    var ajaxUrl = "<?= admin_url("admin-ajax.php ") ?>";
  </script>
  <?php
  wp_meta();
  wp_head(); ?>
</head>
<?php wp_body_open() ?>

<body <?php body_class() ?>>
  <header>
    <div class="header-contact">
      <div class="container d-flex align-items-center justify-content-lg-between justify-content-center position-relative">
        <div class="contact d-flex">
          <a href="tel:" target="_blank"><i class="icon-phone1"></i><span>+8 80025.9890.11 </span></a>
          <a href="mailto:" target="_blank"><i class="icon-email"></i><span>info@quamservice.com</span> </a>
          <a href="" target="_blank"><i class="icon-delivery"></i>
            <p class="mb-0">Rastrear paquete</p>
          </a>
        </div>

        <div class="d-lg-flex d-none">
          <div class="img-fit">
            <img src="<?php bloginfo('template_url') ?>/media/images/credit-card.png" alt="">
          </div>
        </div>
      </div>
    </div>

    <div class="info-contact">
      <div class="container">
        <nav class="d-flex align-items-center justify-content-between position-relative">
          <div class="nav_links align-items-center">
            <h1 class="mb-0">
              <a href="<?= get_home_url() ?>" class="logo img-fit">
                <img src="<?php bloginfo('template_url') ?>/media/images/Logo-quam.svg" alt="Logo Quam" title="Logo Quam" />
              </a>
            </h1>

            <div class="mobile-menu w-100 justify-content-xl-between">
              <div class=" d-flex flex-column flex-xl-row gap-4 ">
                <a href="<?= get_home_url() ?>" class="<?= is_front_page() ? 'active' : '' ?>">Inicio</a>

                <?php $categories = get_terms(array(
                  "taxonomy" => "product_cat",
                  "hide_empty" => false,
                  "parent" => 0,
                  'exclude'    => 69,
                  'orderby' => 'term_order',
                ));
                foreach ($categories as $cat) :
                ?>
                  <a href="<?= get_term_link($cat) ?>" class="<?= is_page( $cat->name ) ? 'active' : '' ?>" data-id="<?=  $cat->slug ?>">
                    <?= $cat->name ?>
                  </a>
                <?php endforeach; ?>
              </div>

              <div class="position-relative search">
                <i class="icon-search"></i>
                <?= get_product_search_form() ?>
              </div>
            </div>
            <div class="center-vertical">
              <div class="header-actions d-flex ms-4 gap-sm-3">
                <button id="bottonFav" class="position-relative btn center-all p-0 " data-bs-toggle="offcanvas" data-bs-target="#mini-favoritos" aria-controls="mini-favoritos"><i class="icon-heart"></i>
                  <?php if (!empty($_SESSION["prodsfavs"])) { ?>
                    <span id="favoritesCounter" class="cart-section-quantity rounded-pill position-absolute center-all text-white"><?= count($_SESSION["prodsfavs"]) ?>
                    </span>
                  <?php } ?>
                </button>

                <button id="bottonCart" class="position-relative btn center-all p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mini-carrito" aria-controls="mini-carrito">
                  <i class="icon-shopping-bag"></i>
                  <?php if (count(WC()->cart->get_cart()) > 0) { ?>
                    <span id="cartItem" class="cart-section-quantity rounded-pill position-absolute center-all text-white"><?= count(WC()->cart->get_cart()) ?></span>
                  <?php } ?>
                </button>
                </span></button>
                <button type="button" class="position-relative btn center-all p-0 d-none d-sm-flex"><i class="icon-user"></i></button>
              </div>


              <button class="menu-btn">
                <div></div>
                <div></div>
                <div></div>
              </button>
            </div>

        </nav>
      </div>

    </div>

  </header>

  <?php desplegableProductos("Bolsa de la compra", "mini-carrito") ?>

  <?php desplegableProductos("Mis favoritos", "mini-favoritos") ?>


  <main>