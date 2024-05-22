<?php

/**
 * Template Name: Bolsa de compra
 */
require_once('../../wp-load.php');
get_header();

?>
<style>
  .loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
  }
</style>

<section id="bag" class="pt-0 h-100">
  <?php the_content(); ?>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () =>{
  const paymentMethodCod = document.getElementById('payment_method_cod');
  const text = document.querySelector('.woocommerce-privacy-policy-text p')

  console.log(text.textContent);
  text.addEventListener('click',()=>{
    console.log('text');
  })

  if (paymentMethodCod) {
    paymentMethodCod.addEventListener('change', (event) => {
      if (event.target.checked) {
        console.log('El método de pago "Pago contra entrega" está activo');
      } else {
        console.log('El método de pago "Pago contra entrega" está inactivo');
      }
    });
  } else {
    console.log('No se encontró el elemento con ID payment_method_cod');
  }
})
</script>


<?php get_footer() ?>