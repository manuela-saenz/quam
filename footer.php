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