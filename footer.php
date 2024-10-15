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
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class=" d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-mastercard mb-3">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M12 9.765a3 3 0 1 0 0 4.47" />
            <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
          </svg>
          <p class="mb-0">Múltiples medios de pago</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class=" d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exchange mb-3">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M19 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M19 8v5a5 5 0 0 1 -5 5h-3l3 -3m0 6l-3 -3" />
            <path d="M5 16v-5a5 5 0 0 1 5 -5h3l-3 -3m0 6l3 -3" />
          </svg>
          <p class="mb-0">Cambios y devoluciones</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class=" d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-package mb-3">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
            <path d="M12 12l8 -4.5" />
            <path d="M12 12l0 9" />
            <path d="M12 12l-8 -4.5" />
            <path d="M16 5.25l-8 4.5" />
          </svg>
          <p class="mb-0">Rastrea tu paquete</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class=" d-flex flex-column center-all bg-light rounded-3 fw-medium p-4">
        <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake mb-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /><path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" /><path d="M12.5 15.5l2 2" /><path d="M15 13l2 2" /></svg>
          <p class="mb-0">¿Necesitas ayuda?</p>
        </div>
      </div>


    </div>
  </div>
</section>

<footer class="<?= is_singular('product') ? "footer-product-none" : "" ?>">
  <div class="container">
    <div class="row position-relative justify-content-evenly">

      <div class="col-md-12 col-lg-3">
        <ul>
          <li class="mb-4"> <b>Categorias</b></li>
          <li><a href="<?= get_home_url(); ?>">Inicio</a></li>
          <li><a href="<?= get_home_url(); ?>/categoria-producto/hombre/">Hombre</a></li>
          <li><a href="<?= get_home_url(); ?>/categoria-producto/mujer/">Mujer</a></li>
          <li><a href="<?= get_home_url(); ?>/categoria-producto/nino/">Niño</a></li>
        </ul>
      </div>

      <div class="col-md-4 col-lg-3" style="z-index:2;">
        <ul>
          <li class="mb-4"> <b> LEGAL</b></li>
          <li> <a href="<?= get_home_url(); ?>/politicas/" target="_blank"> Política de privacidad</a></li>
          <li> <a href="<?= get_home_url(); ?>/politicas/" target="_blank"> Términos y condiciones</a> </li>
        </ul>

      </div>


      <div class="col-md-4 col-lg-3">
        <ul class="direction">
          <li class="mb-4"> <b> CONTACTO</b></li>
          <li><a href="<?= get_home_url(); ?>/contacto/"> Contacto</a></li>
          <li class="pb-20"> <a href="tel:6013 886 004" target="_blank"> +57 311 4482684 </a> </li>
        </ul>

      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="copy">
      <div class="container d-flex justify-content-between">
        <span>© Todos los derechos reservados 2024. QUAM</span>
        <span><a href="https://intuitionstudio.co/" target="_blank">Desarrollado por <span class="text-decoration-underline">Intuition Bussines</span></a></span>
        <div class="img-fit logo">
          <img src="https://www.quam.com.co/wp-content/themes/quam/media/images/Logo-white.svg" alt="">
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
<script src="<?php bloginfo('template_url') ?>/assets/js/custom.js"> </script>
<?php if (is_product()) { ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/product.js"> </script>
<?php } ?>
<script src="<?php bloginfo('template_url') ?>/assets/js/function.js"> </script>
<script src="<?php bloginfo('template_url') ?>/assets/js/sliders.js"> </script>
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
</body>

</html>