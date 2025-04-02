<!-- <section id="shipping" class="<?= is_singular('product') ? "footer-product-none" : "" ?> pb-0">
  <div class="container position-relative">
    <div class="row center-all">
      <div class="col-md-12 col-xxl-10">
        <div class="d-none text-shipping position-relative mb-5">
          <h6 class="title">Realizamos envios a todo el país</h6>
          <div class="img-fit img-shipping">
            <img src="<?php bloginfo('template_url') ?>/media/images/repartidor.png" alt="">
          </div>
        </div>
        <div class="suscription">
          <div class="row center-all ">
            <div class="col-2">
              <div class="img-fit">
                <img src="<?php bloginfo('template_url') ?>/media/images/suscription.svg" alt="">
              </div>
            </div>
            <div class="col-md-6">
              <div>
                <b class="title"> Suscríbete a nuestro boletín </b> <br>
               ...y recibe un cupón de <b>$20.000 </b> para tu primera compra. -->
<!-- </div>
            </div>
            <div class="col-md-4">
            <?php echo do_shortcode('[newsletter_form]'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<!-- </section> -->

</main>
<section class="<?= is_single() ? ' d-none d-md-block' : '' ?>">
  <?php itemsFooter() ?>
</section>

<footer class="<?= is_singular('product') ? "footer-product-none" : "" ?>">
  <div class="container">
    <div class="row position-relative justify-content-evenly">
      <div class="col-md-12 col-lg-3">
        <div class="img-contain logo mb-4">
          <img src="https://www.quam.com.co/wp-content/themes/quam/media/images/Logo-white.svg" alt="">
        </div>
        <p class="mb-1">Síguenos en redes</p>
        <div class="d-flex gap-3">
          <a href="https://www.facebook.com/quamcolombia/" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
            </svg>
          </a>
          <a href="https://www.instagram.com/quam.co/" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
              <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
              <path d="M16.5 7.5l0 .01" />
            </svg>
          </a>

        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <b class="mb-3 d-block">EXPLORAR</b>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'footer-categorias'
          )
        );
        ?>
      </div>

      <div class="col-md-4 col-lg-3" style="z-index:2;">
        <b class="mb-3 d-block"> Información</b>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'footer-informacion'
          )
        );
        ?>
      </div>


      <div class="col-md-4 col-lg-3">
        <b class="mb-3 d-block">CONTACTO</b>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'footer-contacto'
          )
        );
        ?>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="copy">
      <div class="container d-flex justify-content-between">
        <span>© Todos los derechos reservados 2024. QUAM</span>
        <span><a href="https://intuitionstudio.co/" target="_blank">Desarrollado por <span class="text-decoration-underline">Intuition Bussines</span></a></span>

      </div>
    </div>
  </div>
</footer>
<?php if (!is_archive()) { ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php } ?>
<?php wp_footer(); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
  $ = jQuery
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>

<?php if (is_page(78)) { ?>
  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
  <script src="<?php bloginfo('template_url') ?>/assets/js/stepper.js"> </script>
<?php } ?>
<script src="<?php bloginfo('template_url') ?>/assets/js/function.js"> </script>
<script src="<?php bloginfo('template_url') ?>/assets/js/custom.js"> </script>
<?php if (is_product()) { ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/product.js"> </script>
<?php } ?>
<?php if (!is_archive()) { ?>
<script src="<?php bloginfo('template_url') ?>/assets/js/sliders.js"> </script>
<?php } ?>
<?php if (is_page(1694)) { ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/form.js"> </script>
<?php } ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var cartElement = document.querySelector('.offcanvas-body.ordenList.cart');
    if (cartElement && cartElement.children.length > 0) {
      cartElement.classList.remove('empty');
    }
  });
</script>
<?php if (is_product_category()) { ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/cat.js"> </script>
<?php } ?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".cfvsw-shop-variations.variations.cfvsw-variation-disable-logic")
      .forEach(table => table.classList.add("d-none"));
  });
</script>
</body>

</html>