<section id="shipping" class="<?= is_singular('product') ? "footer-product-none" : "" ?> pb-0">
  <div class="container position-relative">
    <div class="row center-all">
      <div class="col-md-12 col-xxl-10">
        <div class="d-flex text-shipping position-relative mb-5">
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
                <!-- ...y recibe un cupón de <b>$20.000 </b> para tu primera compra. -->
              </div>
              <!-- <div class="redes d-flex">
                <div class="ms-2"> <i class="icon-facebook"></i>Facebook </div>
                <div class="ms-2"> <i class="icon-instagram"></i>Instagram </div>
              </div> -->
            </div>
            <div class="col-md-4">
              <div class="input-group position-relative">
                <input type="text" class="form-control border border-white" placeholder="Escribe tu correo electrónico" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <button class="quam-btn white" type="button" id="button-addon1">Suscribirme</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

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
          <li> <a href=""> Política de privacidad</a></li>
          <li> <a href=""> Términos y condiciones</a> </li>
          <li> <a href=""> Prácticas comerciales responsables</a> </li>
          <li><a href=""> Contacto</a></li>
        </ul>

      </div>

      <!-- <div class="col-md-4 col-lg-3">
        <ul>
          <li class="mb-4"> <b> SERVICIO AL CLIENTE</b></li>
          <li> <a href=""> Preguntas frecuentes</a></li>
          <li> <a href=""> Envíos </a> </li>
          <li> <a href=""> Devoluciones / Cambios</a> </li>
          <li><a href=""> Tarjetas de regalo</a></li>
        </ul>
      </div> -->

      <div class="col-md-4 col-lg-3">
        <ul class="direction">
          <li class="mb-4"> <b> CONTACTO</b></li>
          <!-- <li> <a href="mailto:infoquam@contacto.com" target="_blank"> infoquam@contacto.com</a> </li> -->
          <li class="pb-20"> <a href="tel:6013 886 004" target="_blank">6013 886 004</a> </li>
          <!-- <li class="pb-20"> <a href="#"> Lunes a jueves: 9 a. m. a 7 p. m.</a></li> -->
        </ul>
        <!-- <div class="footer-icons">
          <a href="" class="" target="_blank"><i class="icon-facebook"></i></a>
          <a href="" target="_blank"><i class="icon-instagram mx-2 ms-2"></i></a>
        </div> -->
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="copy">
      <div class="container">
        <span>© Todos los derechos reservados 2024. QUAM</span>
        <div class="img-fit logo">
          <img src="<?php bloginfo('template_url') ?>/media/images/Logo-white.svg" alt="">
        </div>
      </div>
    </div>
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php if (is_page(78)) { ?>
  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
  <script src="<?php bloginfo('template_url') ?>/assets/js/stepper.js"> </script>
<?php } ?>
<script src="<?php bloginfo('template_url') ?>/assets/js/custom.js?=v<?= randomCode() ?>"> </script>
<?php if (is_product()) { ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/product.js?=v<?= randomCode() ?>"> </script>
<?php } ?>
<script src="<?php bloginfo('template_url') ?>/assets/js/function.js?=v<?= randomCode() ?>"> </script>
<script src="<?php bloginfo('template_url') ?>/assets/js/sliders.js?=v<?= randomCode() ?>"> </script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var cartElement = document.querySelector('.offcanvas-body.ordenList.cart');
    if (cartElement && cartElement.children.length > 0) {
      cartElement.classList.remove('empty');
    }
  });

</script>
<?php if (is_product_category()) { ?>
  <script src="<?php bloginfo('template_url') ?>/assets/js/cat.js?=v<?= randomCode() ?>"> </script>
<?php } ?>
<?php wp_footer(); ?>
</body>

</html>