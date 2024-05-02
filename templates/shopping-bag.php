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

  <div class="container-fluid position-relative">
    <div class="flex-grow-1 flex-shrink-0">
      <div class="mb-5 ">
        <div id="stepper1" class="bs-stepper">
          <div class="step_by_step row">
            <div class="col-md-2">
              <a href="https://www.quam.com.co/web_quam/"> <i class="icon-arrow-left"></i> Continuar comprando</a>
            </div>
            <div class="col-md-7 offsted-md-1 center-all">
              <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#test-l-1">
                  <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label">Bolsa de la compra</span>
                  </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-2">
                  <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">Identificación</span>
                  </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-3">
                  <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">Ubicación</span>
                  </button>
                </div>
                <div class="bs-stepper-line"></div>
                <div class="step" data-target="#test-l-4">
                  <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                    <span class="bs-stepper-circle">4</span>
                    <span class="bs-stepper-label">Pago</span>
                  </button>
                </div>
                <!-- <div class="bs-stepper-line"></div> -->
                <div class="step" data-target="#test-l-5" class="" style="display: none;">
                  <button type="button" class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                    <span class="bs-stepper-circle">5</span>
                    <span class="bs-stepper-label">Pago</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="col-md-4">

            </div>

          </div>

          <div class="container informationBag">
            <div class="row center-all">
              <div class="col-md-12 col-lg-10">
                <div class="bs-stepper-content">
                  <form onSubmit="return false">

                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                      <div class="form-group row">
                        <div class="col-lg-8 col-md-12">
                          <h3 class="mb-4"> Bolsa de la compra</h3>
                          <table class="table table-bag">
                            <thead>
                              <tr>
                                <th scope="col">Producto (s)</th>
                                <th scope="col" class="text-center">Cantidad</th>
                                <th scope="col" class="">Precio</th>
                                <th scope="col" style="color: transparent;">dd</th>
                              </tr>
                            </thead>
                            <?php ItemsCheckout(); ?>
                          </table>
                          <div class="d-lg-flex d-none flex-column">
                            <label class="custom-checkbox d-flex align-items-baseline mb-4"><input class="politicy check me-3" type="checkbox" id="cboxtwo" value="first_checkbox">
                              <div style="font-size: 15px;">
                                Autorizo el uso de mis datos personales con fines comerciales y publicitarios para
                                recibir
                                información sobre productos y servicios de interés.
                              </div>
                            </label>
                            <button class="quam-btn blue next" onclick="stepper1.next()">Diligenciar información</button>
                          </div>

                        </div>
                        <?php
                        $total = WC()->cart->get_cart_total();
                        $discountTotal = WC()->cart->get_cart_discount_total();
                        ?>
                        <div class="col-lg-4 col-md-12">
                          <div class="code">
                            <form method="post" class="position-relative">
                              <div class="position-relative">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue codigo" value="Aplicar">
                              </div>
                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $total; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $discountTotal; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> <?php echo $total; ?></b> </p>
                                </div>
                              </div>

                            </form>
                            <div class="d-lg-none d-flex flex-column check">
                              <label class="custom-checkbox d-flex align-items-baseline mb-4 "><input class="politicy check me-3" type="checkbox" id="cboxtwo" value="first_checkbox">
                                <div style="font-size: 14px;">
                                  Autorizo el uso de mis datos personales con fines comerciales y publicitarios para
                                  recibir
                                  información sobre productos y servicios de interés.
                                </div>
                              </label>
                              <div class="btn-next center-all w-100">
                                <button class="quam-btn blue w-100 next" onclick="stepper1.next()">Diligenciar
                                  información</button>
                              </div>

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                      <div class="form-group row">
                        <div class="col-lg-8">
                          <h3 class="mb-4"> Identificación</h3>
                          <div class="position-relative">
                            <form action="" class="form_contact">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="fname"> <b>Nombres* </b> </label><br>
                                  <input type="text" id="fname" name="fname" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="apellido"> <b>Apellidos* </b> </label><br>
                                  <input type="text" id="lapellido" name="apellido" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="email"> <b>Correo electrónico* </b> </label><br>
                                  <input type="text" id="lemail" name="email" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="cc"> <b> Identificación*</b> </label><br>
                                  <input type="text" id="lcc" name="cc" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="tel"> <b> Teléfono*</b> </label><br>
                                  <input type="text" id="ltel" name="tel" value="">
                                </div>
                              </div>
                              <!-- <input class="quam-btn blue" onclick="stepper1.next()" value="Diligenciar ubicación"> -->
                            </form>
                            <div class="btn-step-next">
                              <button class="quam-btn blue next" onclick="stepper1.next()">Diligenciar ubicación</button>
                            </div>

                          </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                          <div class="code">
                            <h3>Resumen de compra </h3>
                            <form method="post" class="position-relative form_compra">
                              <?php ItemsSummary(); ?>

                              <div class="position-relative mt-5">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue" value="Aplicar">
                              </div>

                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $total; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $discountTotal; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b><?php echo $total; ?></b> </p>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-end mt-5">
                        <button class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i> Volver a la bolsa de la compra</button>
                        <!-- <button class=" quam-btn blue next" onclick="stepper1.next()">Next</button> -->
                      </div>
                    </div>

                    <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                      <div class="form-group row">
                        <div class="col-lg-8 ">
                          <h3 class="mb-4"> Ubicación</h3>
                          <div class="position-relative">
                            <form action="" class="form_contact">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="Departamento"><b>Departamento*</b></label>

                                  <input type="text" id="Departamento" name="Departamento" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="Municipio"><b>Municipio*</b></label>

                                  <input type="text" id="Municipio" name="Municipio" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="Dir1"> <b>Dirección de entrega* </b> </label><br>
                                  <input type="text" id="Dir1" name="Dir1" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="barrio"> <b> Barrio</b> </label><br>
                                  <input type="text" id="barrio" name="barrio" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="info"> <b> Información adicional </b> (ej:. apart201) </label><br>
                                  <input type="text" id="info" name="info" value="">
                                </div>
                                <div class="col-md-6">
                                  <label for="destinario"> <b> Destinatario* </b> </label><br>
                                  <input type="text" id="destinario" name="destinario" value="">
                                </div>
                              </div>
                              <div class="alert alert-danger" role="alert" id="error_alert" style="display:none; color: #721c24; background-color: #f8d7daa1; border: 2px solid #f5c6cb; padding: 13px; margin-bottom: 10px;">
                              </div>
                              <div class="alert alert-success" role="alert" id="success_alert" style="display:none; color: #155724; background-color: #d4eddaa1; border:1px solid #c3e6cb; #f5c6cb; padding: 13px; margin-bottom: 10px;">
                              </div>
                            </form>


                            <div class="btn-step-next">
                              <!-- <button class="quam-btn blue next" onclick="generate_order()">Generar pedido</button> -->
                              <button class="quam-btn blue next" onclick="stepper1.next()">Generar pedido</button>
                            </div>

                          </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                          <div class="code">
                            <h3>Resumen de compra </h3>
                            <form method="post" class="position-relative form_compra">
                              <?php ItemsSummary(); ?>
                              <div class="position-relative mt-5">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue" value="Aplicar">
                              </div>
                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $total; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $discountTotal; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> <?php echo $total; ?></b> </p>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>

                      <div class="d-flex justify-content-end mt-5">
                        <button class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i> Volver a la identificación </button>
                        <!-- <button class="quam-btn blue next" onclick="stepper1.next()">Next</button> -->
                      </div>

                    </div>

                    <div id="test-l-4" role="tabpanel" class="bs-stepper-pane form-group" aria-labelledby="stepper1trigger4">
                      <div class="form-group row">
                        <div class="col-lg-8 position-relative">
                          <h3 class=" mb-4">Pago</h3>
                          <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">

                            <?php
                            // Obtén todos los métodos de pago disponibles
                            $available_payment_gateways = WC()->payment_gateways->get_available_payment_gateways();

                            // Verifica si hay métodos de pago disponibles
                            if ($available_payment_gateways) {
                              foreach ($available_payment_gateways as $gateway) {
                                // var_dump($gateway->get_icon());
                            ?>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    <div class="btn form-check flex-column">
                                      <div class="img-fit">
                                        <?php echo $gateway->get_icon(); ?>
                                      </div>
                                      <?php echo $gateway->get_title(); ?>
                                    </div>
                                  </button>
                                </li>
                            <?php
                              }
                            }
                            ?>

                          </ul>
                          <div class="tab-content" id="pills-tabContent">


                            <div class="tab-pane fade position-relative" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

                              <form action="" class="form_contact">
                                <div class="row">

                                </div>
                              </form>
                              <div class="btn-step-next">
                                <button class="quam-btn blue next" onclick="redirectToPaymentGateway()">Comprar ahora</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                          <div class="code">
                            <h3>Resumen de compra </h3>
                            <form method="post" class="position-relative form_compra">
                              <?php ItemsSummary(); ?>
                              <div class="position-relative mt-5">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue" value="Aplicar">
                              </div>
                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $total; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;"><?php echo $discountTotal; ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> <?php echo $total; ?></b> </p>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>



                      <div class="d-flex justify-content-end mt-5">
                        <button class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i> Volver a la ubicación </button></button>
                        <!-- <button type="submit" class="quam-btn blue">Submit</button> -->
                        <!-- <button class="quam-btn blue next" onclick="stepper1.next()">Next</button> -->
                      </div>
                    </div>

                    <div id="test-l-5" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger5">
                      <div class="form-group row center-all">
                        <div class="col-md-6 position-relative center-all text-center flex-column">
                          <div class="circle">
                            <i class="icon-check"></i>
                          </div>
                          <h3 class="mb-4">¡Gracias por su compra!</h3>
                          <div>
                            <p>Fecha de solicitud de compra: 03/01/2024</p>
                            <p>Tu pedido se encuentra en proceso de validación, en breve recibirás un correo con el detalle de tu compra.</p>
                            <b>Pedido: VUY-0229</b>
                          </div>
                          <div class="btn-step-next mt-4">
                            <button class="quam-btn blue next" onclick="stepper1.next()">Seguir comprando</button>
                          </div>

                        </div>

                      </div>
                      <div class="d-flex justify-content-end mt-5">
                        <button class="quam-btn blue me-4 previous" onclick="stepper1.previous()"><i class="icon-arrow-left me-2"></i>Volver al pago</button>
                        <!-- <button class="quam-btn blue" onclick="stepper1.next()">Next</button> -->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


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