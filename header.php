<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
    if (is_front_page()) {
      bloginfo('name');
      echo ' - ';
      bloginfo('description');
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
  <!-- <link rel="icon" href="favicon/favicon-1.ico" /> -->
  <?php if (is_page(78)) { ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
  <?php } ?>
  <?php if (!is_archive()) { ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php } ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="icon" href="<?php bloginfo('template_url') ?>/media/images/Logo-quam.svg" type="image/svg+xml">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/custom.prefix.css?=v2" />

  <script>
    var ajaxUrl = "<?= admin_url("admin-ajax.php") ?>";
  </script>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-14Y5R2N56V"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-14Y5R2N56V');
  </script>
  <?php
  wp_meta();
  wp_head();

  ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/order-products.js"></script>
</head>
<?php wp_body_open() ?>


<body <?php body_class() ?>>
  <header>
    <div class="header-contact">
      <div class="container d-flex align-items-center justify-content-lg-between justify-content-center position-relative">
        <div class="contact d-flex">
          <a href="tel:573114482684" target="_blank"><i class="icon-phone1"></i><span> +57 311 4482684 </span></a>
          <!-- <a href="mailto:" target="_blank"><i class="icon-email"></i><span>info@quamservice.com</span> </a> -->
          <button id="track-package-link" class="d-flex text-white align-items-center rastreo-button" data-bs-toggle="modal" data-bs-target="#trackModal"><i class="icon-delivery"></i>
            <p class="mb-0" style="font-family:Raleway,sans-serif">Rastrear paquete</p>
          </button>

        </div>


        <div class="d-lg-flex d-none">
          <div class="img-contain">
            <img src="<?php bloginfo('template_url') ?>/media/images/payment_methods.svg" alt="payment-methods">
          </div>
        </div>
      </div>
    </div>

    <div class="info-contact">
      <div class="container">
        <nav class="d-flex align-items-center justify-content-between position-relative">
          <div class="nav_links align-items-center justify-content-between">
            <h1 class="mb-0">
              <a href="<?= get_home_url() ?>" class="logo img-fit">
                <img src="<?php bloginfo('template_url') ?>/media/images/Logo-quam.svg" alt="Logo Quam" title="Logo Quam" />
              </a>
            </h1>

            <div class="mobile-menu w-100 justify-content-xl-between">
              <div class=" d-flex flex-column flex-xl-row gap-4 ">
                <a href="<?= get_home_url() ?>" class="<?= is_front_page() ? 'active' : '' ?>">Inicio</a>

                <?php $categories = get_terms(
                  array(
                    "taxonomy" => "product_cat",
                    // "hide_empty" => false,
                    "parent" => 0,
                    'exclude' => array(26, 15),
                    'orderby' => 'term_order',
                  )
                );
                foreach ($categories as $cat) :
                ?>
                  <a href="<?= get_term_link($cat) ?>" class="<?= is_page($cat->name) ? 'active' : '' ?>" data-id="<?= $cat->slug ?>">
                    <?= $cat->name ?>
                  </a>
                <?php endforeach; ?>
                <a href="<?= get_permalink(1694) ?>" title="Contáctanos" class="<?= is_page(1694) ? 'active' : '' ?>">Contacto</a>
              </div>

              <div class="position-relative search">
                <i class="icon-search"></i>
                <?= get_product_search_form() ?>
              </div>
            </div>
            <div class="center-vertical">
              <div class="header-actions d-flex ms-4 gap-sm-3">
                <button id="bottonFav" class=" position-relative btn center-all p-0 " data-bs-toggle="offcanvas" data-bs-target="#mini-favoritos" aria-controls="mini-favoritos"><i class="icon-heart"></i>
                  <span id="favoritesCounter" class="d-none cart-section-quantity rounded-pill position-absolute center-all text-white">0</span>
                </button>

                <button id="bottonCart" class=" position-relative btn center-all p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mini-carrito" aria-controls="mini-carrito">
                  <i class="icon-shopping-bag"></i>
                  <span id="cartItem" class="d-none cart-section-quantity rounded-pill position-absolute center-all text-white">0</span>
                </button>
                </span></button>
                <!-- <button type="button" class="position-relative btn center-all p-0 d-none d-sm-flex"><i class="icon-user"></i></button> -->
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

  <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-semibold" id="trackModalLabel">Rastrear paquete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M18 6l-12 12" />
              <path d="M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="modal-body">
          <div id="track-package-form" class="relative d-flex flex-column">
            <div class="contenedor-rastreo-header" style="position:relative;">
              <label for="tracking-code" class=" fw-semibold">Código de rastreo</label>
              <input id="tracking-code" class="lh-1 mb-4 px-3 py-3 w-100" style="border: 1px solid #ccc; border-radius: 4px;" placeholder="Ingresa tu código" value="" class="w-100" name="s">
            </div>
            <button class="mb-0 quam-btn blue" onclick="trackPackage()">
              Rastrear paquete</button>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php desplegableProductos("Bolsa de la compra", "mini-carrito") ?>
  <?php desplegableProductos("Mis favoritos", "mini-favoritos") ?>
  <?php $numero = get_field('numero_destino', 1694);
  $mensaje = get_field('mensaje_inicial', 1694)
  ?>
  <main>
    <a href="https://web.whatsapp.com/send?phone=<?= $numero ?>&amp;text=<?= $mensaje ?>" class="btn-whatsapp position-fixed" target="_blank">
      <img src="<?php bloginfo('template_url') ?>/media/images/social-whatsapp.png" alt="">
    </a>

    <script>
      const btn = document.querySelector('.btn-whatsapp');
      // Función para verificar la URL
      function checkURL() {
        const url = window.location.href;
        return url.includes('/producto/');
      }

      // Función para verificar el ancho de la ventana
      function checkWidth() {
        return window.innerWidth <= 991;
      }

      // Función para aplicar estilos al botón según las condiciones
      function applyStyles() {
        if (checkURL() && checkWidth()) {
          btn.classList.add('small');
        } else {
          btn.classList.remove('small');
        }
      }

      // Aplicar estilos al cargar y al redimensionar la ventana
      applyStyles();
      window.addEventListener('resize', applyStyles);
    </script>