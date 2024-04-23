<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quam</title>

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
  <?php wp_head(); ?>
</head>

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
            <div class="center-all">
              <h1 class="mb-0">
                <a href="<?= get_home_url() ?>" class="logo img-fit">
                  <img src="<?php bloginfo('template_url') ?>/media/images/Logo-quam.svg" alt="Logo Quam" title="Logo Quam" />
                </a>
              </h1>

              <div class="mobile-menu">

                <!-- <a href="" class="logo img-fit">
                  <img src="<?php bloginfo('template_url') ?>/media/images/Logo-white.svg" alt="Logo Quam" title="Logo Quam" />
                </a> -->

                <a href="<?= get_home_url() ?>" class="<?= is_page(43) ? 'active' : '' ?>">Inicio</a>
                <!-- ----- -->
                <!-- <a href="" class="">Nuevo</a> -->
                <!-- ----- -->


                <!-- <a href="https://www.quam.com.co/web_quam/categoria-producto/hombre/" class="<?= is_page(43) ? 'active' : '' ?>">Hombre</a> -->

                <?php $categories = get_terms(array(
                  "taxonomy" => "product_cat",
                  "hide_empty" => false,
                  "parent" => 0,
                  'exclude'    => 69,
                  'orderby'    => 'asc',
                ));
                foreach ($categories as $cat) :
                ?>
                  <a class="" href="<?= get_term_link($cat) ?>">
                    <?= $cat->name ?>
                  </a>
                <?php endforeach; ?>

                <!-- ----- -->
                <!-- <a href="https://www.quam.com.co/web_quam/categoria-producto/mujer/" class="<?= is_page(43) ? 'active' : '' ?>">Mujer</a> -->
                <!-- ----- -->
                <!-- <a href="https://www.quam.com.co/web_quam/categoria-producto/ninos/" class="<?= is_page(43) ? 'active' : '' ?>">Niños</a> -->
                <!-- ----- -->
                <!-- <a href="<?= get_permalink(43) ?>" class="<?= is_page(43) ? 'active' : '' ?>">Ofertas</a> -->

                <div class="social-media center-all d-lg-none d-flex flex-column">
                  <div class="position-relative search"> <input type="text" placeholder="Buscar" class="quam-btn"> <i class="icon-search"></i>
                  </div>

                  <div class="icon-media d-flex">
                    <a href="" target="_blank"><i class="icon-heart"></i></a>
                    <!-- <a href="" target="_blank"><i class="icon-shopping-bag"></i></a> -->
                    <a href="" target="_blank"><i class="icon-user"></i></a>
                  </div>
                </div>

              </div>
            </div>

            <div class="social-media center-all d-xl-flex d-none">
              <div class="position-relative"> <input type="text" placeholder="Buscar"> <i class="icon-search"></i>
              </div>

              <div class="icon-media">
                <a href="" target="_blank"><i class="icon-heart"></i></a>
                <!-- <a href="https://www.quam.com.co/web_quam/bolsa-de-compras/"><i class="icon-shopping-bag"></i></a> -->
                <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="icon-shopping-bag"></i></button>
                <a href="" target="_blank"><i class="icon-user"></i></a>
              </div>

            </div>


            <div class="social-media center-all d-flex d-xl-none">
              <div class="icon-media p-0">
                <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="icon-shopping-bag"></i></button>
              </div>
            </div>

            <button class="menu-btn">
              <div></div>
              <div></div>
              <div></div>
            </button>
        </nav>
      </div>

    </div>

  </header>

  <div class="offcanvas offcanvas-end shopping-bag-offcanvas" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel">Bolsa de la compra</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ordenList">
      <?php ItemsCart(); ?>
    </div>
    <div class="offcanvas-footer">
      <?php
        $total = WC()->cart->get_cart_total();        
      ?>
      <div class="">
        <div class="d-flex justify-content-between mb-2">
          <p class="fs-6"> Subtotal</p>
          <p class="fs-6"><?php echo $total; ?></p>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <p class="fs-4"> <b>Total</b> </p>
          <p class="fs-4"> <b><?php echo $total; ?></b> </p>
        </div>
      </div>
      <a href="https://www.quam.com.co/web_quam/bolsa-de-compras/" class="quam-btn blue w-100">Finalizar compra</a>
    </div>
  </div>


  <main>