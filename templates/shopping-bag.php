<?php

/**
 * Template Name: Bolsa de compra
 */
require_once('../../wp-load.php');
get_header();

?>


<section id="bag" class="  h-100">
  <?php the_content();

  ?>

  


</section>

<script>
  // function redirectToPaymentGateway() {
  //   // Reemplaza 'url_de_tu_pasarela_de_pagos' con la URL de tu pasarela de pagos
  //   window.location.href = 'https://sandbox.gateway.payulatam.com/ppp-web-gateway';
  // }

  $(document).ready(function() {
    // Intercepta el evento de envío del formulario
    $("#place_order").on("submit", function(e) {
      // Previene la recarga de la página
      e.preventDefault();

      // Realiza una solicitud AJAX
      $.ajax({
        url: ajaxUrl, // URL del archivo PHP que procesará la solicitud
        type: "POST", // Método de la solicitud
        data: $(this).serialize(), // Datos del formulario
        success: function(response) {
          console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Aquí puedes manejar los errores de la solicitud AJAX
          // ...
        },
      });
    });
  });
</script>
<?php get_footer() ?>