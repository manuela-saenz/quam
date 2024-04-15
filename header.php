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

  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/custom.min.css" />
</head>

<body>
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
                <a href="" class="">Nuevo</a>
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
                <a href="<?= get_permalink(43) ?>" class="<?= is_page(43) ? 'active' : '' ?>">Ofertas</a>

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
    <div class="offcanvas-body">
      <div class="select-bag d-flex bg-white">
        <div class="img-fit">
          <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
        </div>
        <div>
          <h5>Example Midi Bodycon Dress</h5>
          <p>Talla: S</p>
          <p>Color: </p>
          <div class="quantity">
            <button class="qtyminus minus"><i class="icon-minus"></i></button>
            <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
            <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
          </div>
          <div class="d-flex align-items-center price">
            <p>$200</p>
            <span>$890</span>
          </div>
        </div>
        <a href="#" class="remove">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 7l16 0"></path>
            <path d="M10 11l0 6"></path>
            <path d="M14 11l0 6"></path>
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
          </svg>
        </a>
      </div>

      <div class="select-bag d-flex bg-white">
        <div class="img-fit">
          <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
        </div>
        <div>
          <h5>Example Midi Bodycon Dress</h5>
          <p>Talla: S</p>
          <p>Color: </p>
          <div class="quantity">
            <button class="qtyminus minus"><i class="icon-minus"></i></button>
            <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
            <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
          </div>
          <div class="d-flex align-items-center price">
            <p>$200</p>
            <span>$890</span>
          </div>
        </div>
        <a href="#" class="remove">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 7l16 0"></path>
            <path d="M10 11l0 6"></path>
            <path d="M14 11l0 6"></path>
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
          </svg>
        </a>
      </div>

      <div class="select-bag d-flex bg-white">
        <div class="img-fit">
          <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
        </div>
        <div>
          <h5>Example Midi Bodycon Dress</h5>
          <p>Talla: S</p>
          <p>Color: </p>
          <div class="quantity">
            <button class="qtyminus minus"><i class="icon-minus"></i></button>
            <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
            <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
          </div>
          <div class="d-flex align-items-center price">
            <p>$200</p>
            <span>$890</span>
          </div>
        </div>
        <a href="#" class="remove">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M4 7l16 0"></path>
            <path d="M10 11l0 6"></path>
            <path d="M14 11l0 6"></path>
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
          </svg>
        </a>
      </div>
    </div>
    <div class="offcanvas-footer">
      <div class="">
        <div class="d-flex justify-content-between mb-2">
          <p class="fs-6"> Subtotal</p>
          <p class="fs-6">$75.000</p>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <p class="fs-4"> <b>Total</b> </p>
          <p class="fs-4"> <b> $75.000</b> </p>
        </div>
      </div>
      <a href="https://www.quam.com.co/web_quam/bolsa-de-compras/" class="quam-btn blue w-100">Finalizar compra</a>
    </div>
  </div>


  <main>