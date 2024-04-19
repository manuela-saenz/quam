<?php

/**
 * Template Name: Bolsa de compra
 */


get_header() ?>

<section id="bag" class="padg-mobile h-100">
  <div class="container-fluid position-relative">
    <div class="flex-grow-1 flex-shrink-0">
      <div class="mb-5 ">
        <div id="stepper1" class="bs-stepper">
          <div class="step_by_step row">
            <div class="col-md-2">
              <a href=""> <i class="icon-arrow-left"></i> Continuar comprando</a>
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
                            <tbody class="mb-4">
                              <tr>
                                <td scope="row d-flex align-items-center ">
                                  <div class=" d-flex align-items-center h-100  p-3">
                                    <div class="img-fit">
                                      <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                    </div>
                                    <div>
                                      <h5>Example Midi Bodycon Dress</h5>
                                      <p>Talla: S</p>
                                      <p>Color: </p>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center justify-content-end h-100 ">
                                    <div class="quantity">
                                      <button class="qtyminus minus"><i class="icon-minus"></i></button>
                                      <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
                                      <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center justify-content-center h-100 "> $70.000
                                  </div>  
                                </td>
                                <td>
                                  <div class="d-flex align-items-center justify-content-center h-100 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M4 7l16 0" />
                                      <path d="M10 11l0 6" />
                                      <path d="M14 11l0 6" />
                                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                      <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                  </div>

                                </td>
                              </tr>
                            </tbody>

                            <tbody class="mb-4">
                              <tr>
                                <td scope="row d-flex align-items-center">
                                  <div class="d-flex align-items-center h-100  p-4">
                                    <div class="img-fit">
                                      <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                    </div>
                                    <div>
                                      <h5>Example Midi Bodycon Dress</h5>
                                      <p>Talla: S</p>
                                      <p>Color: </p>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center justify-content-end h-100 ">
                                    <div class="quantity">
                                      <button class="qtyminus minus"><i class="icon-minus"></i></button>
                                      <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
                                      <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex align-items-center justify-content-center h-100 "> $70.000
                                  </div>  
                                </td>
                                <td>
                                  <div class="d-flex align-items-center justify-content-center h-100 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M4 7l16 0" />
                                      <path d="M10 11l0 6" />
                                      <path d="M14 11l0 6" />
                                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                      <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                  </div>

                                </td>
                              </tr>
                            </tbody>
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
                                  <p class="fw-bolder" style="color: #00000075;">$75.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;">$-24.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> $75.000</b> </p>
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
                                  <input type="text" id="fname" name="fname" value="Escribe tu nombre">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b>Apellidos* </b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Escribe tus apellidos">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b>Correo electrónico* </b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Escribe tu correo electrónico">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b> Identificación*</b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Escribe tu número de identificación">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b> Teléfono*</b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Escribe tu teléfono">
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
                              <div class="d-flex align-items-center h-100 purchase">
                                <div class="img-fit">
                                  <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                </div>
                                <div>
                                  <div class="d-flex align-items-baseline">
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <div class="x">x2</div>
                                  </div>
                                  <div class="d-flex align-items-center price">
                                    <p>$200</p>
                                    <span>$890</span>
                                  </div>
                                </div>
                              </div>
                              <div class="d-flex align-items-center h-100 purchase">
                                <div class="img-fit">
                                  <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                </div>
                                <div>
                                  <div class="d-flex align-items-baseline">
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <div class="x">x2</div>
                                  </div>
                                  <div class="d-flex align-items-center price">
                                    <p>$200</p>
                                    <span>$890</span>
                                  </div>
                                </div>
                              </div>
                              <div class="position-relative mt-5">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue" value="Aplicar">
                              </div>
                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;">$75.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;">$-24.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> $75.000</b> </p>
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
                                  <label for="cars"><b>Departamento*</b></label>

                                  <select name="cars" id="cars">
                                    <option value="volvo">Seleccione</option>
                                    <option value="saab">Bogota</option>
                                    <option value="mercedes">Medellin</option>
                                    <option value="audi">Barranquilla</option>
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label for="cars"><b>Municipio*</b></label>

                                  <select name="cars" id="cars">
                                    <option value="volvo">Seleccione</option>
                                    <option value="saab">Bogota</option>
                                    <option value="mercedes">Medellin</option>
                                    <option value="audi">Barranquilla</option>
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b>Dirección de entrega* </b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Escribe la dirección ">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b> Barrio</b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Opcional">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b> Información adicional </b> (ej:. apart201) </label><br>
                                  <input type="text" id="lname" name="lname" value="Opcional">
                                </div>
                                <div class="col-md-6">
                                  <label for="lname"> <b> Destinatario* </b> </label><br>
                                  <input type="text" id="lname" name="lname" value="Carlos Gomez">
                                </div>
                              </div>
                              <!-- <input class="quam-btn blue" onclick="stepper1.next()" value=" Diligenciar método de pago"> -->
                            </form>
                            <div class="btn-step-next">
                              <button class="quam-btn blue next" onclick="stepper1.next()">Diligenciar método de pago</button>
                            </div>

                          </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                          <div class="code">
                            <h3>Resumen de compra </h3>
                            <form method="post" class="position-relative form_compra">
                              <div class="d-flex align-items-center h-100 purchase">
                                <div class="img-fit">
                                  <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                </div>
                                <div>
                                  <div class="d-flex align-items-baseline">
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <div class="x">x2</div>
                                  </div>
                                  <div class="d-flex align-items-center price">
                                    <p>$200</p>
                                    <span>$890</span>
                                  </div>
                                </div>
                              </div>
                              <div class="d-flex align-items-center h-100 purchase">
                                <div class="img-fit">
                                  <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                </div>
                                <div>
                                  <div class="d-flex align-items-baseline">
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <div class="x">x2</div>
                                  </div>
                                  <div class="d-flex align-items-center price">
                                    <p>$200</p>
                                    <span>$890</span>
                                  </div>
                                </div>
                              </div>
                              <div class="position-relative mt-5">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue" value="Aplicar">
                              </div>
                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;">$75.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;">$-24.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> $75.000</b> </p>
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
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                <div class="btn form-check flex-column">
                                  <div class="img-fit">
                                    <img src="<?php bloginfo('template_url') ?>/media/images/Tarjeta-debito.png" alt="">
                                  </div>
                                  Tarjeta debito
                                </div>
                              </button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <div class="btn form-check flex-column ">
                                  <div class="img-fit">
                                    <img src="<?php bloginfo('template_url') ?>/media/images/Tarjeta-credito.png" alt="">
                                  </div>
                                  Tarjeta credito
                                </div>
                              </button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                <div class="btn form-check flex-column">
                                  <div class="img-fit">
                                    <img src="<?php bloginfo('template_url') ?>/media/images/Pse.png" alt="">
                                  </div>
                                  PSE
                                </div>
                              </button>
                            </li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active position-relative" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                              <form action="" class="form_contact">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="cars"><b>Número de la tarjeta*</b></label>
                                    <input type="text" id="lname" name="lname" value="Escribe el número de la tarjeta">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="cars"><b>Nombre de titular de la cuenta*</b></label>
                                    <input type="text" id="lname" name="lname" value="Escribe tu nombre">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lname"> <b>Fecha de vencimiento*</b> </label><br>
                                    <input type="date">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lname"> <b> Código de seguridad*</b> </label><br>
                                    <input type=number>
                                  </div>
                                </div>
                              </form>
                              <div class="btn-step-next">
                                <button class="quam-btn blue next" onclick="stepper1.next()">Comprar ahora</button>
                              </div>
                            </div>

                            <div class="tab-pane fade position-relative" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                              <form action="" class="form_contact">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="cars"><b>Número de la tarjeta* ddddddd</b></label>
                                    <input type="text" id="lname" name="lname" value="Escribe el número de la tarjeta">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="cars"><b>Nombre de titular de la cuenta*</b></label>
                                    <input type="text" id="lname" name="lname" value="Escribe tu nombre">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lname"> <b>Fecha de vencimiento*</b> </label><br>
                                    <input type="date">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lname"> <b> Código de seguridad*</b> </label><br>
                                    <input type=number>
                                  </div>
                                </div>
                              </form>
                              <div class="btn-step-next">
                                <button class="quam-btn blue next" onclick="stepper1.next()">Comprar ahora</button>
                              </div>
                            </div>
                            <div class="tab-pane fade position-relative" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

                              <form action="" class="form_contact">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="cars"><b>Número de la tarjeta* ddjnakld</b></label>
                                    <input type="text" id="lname" name="lname" value="Escribe el número de la tarjeta">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="cars"><b>Nombre de titular de la cuenta*</b></label>
                                    <input type="text" id="lname" name="lname" value="Escribe tu nombre">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lname"> <b>Fecha de vencimiento*</b> </label><br>
                                    <input type="date">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lname"> <b> Código de seguridad*</b> </label><br>
                                    <input type=number>
                                  </div>
                                </div>
                              </form>
                              <div class="btn-step-next">
                                <button class="quam-btn blue next" onclick="stepper1.next()">Comprar ahora</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                          <div class="code">
                            <h3>Resumen de compra </h3>
                            <form method="post" class="position-relative form_compra">
                              <div class="d-flex align-items-center h-100 purchase">
                                <div class="img-fit">
                                  <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                </div>
                                <div>
                                  <div class="d-flex align-items-baseline">
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <div class="x">x2</div>
                                  </div>
                                  <div class="d-flex align-items-center price">
                                    <p>$200</p>
                                    <span>$890</span>
                                  </div>
                                </div>
                              </div>
                              <div class="d-flex align-items-center h-100 purchase">
                                <div class="img-fit">
                                  <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                </div>
                                <div>
                                  <div class="d-flex align-items-baseline">
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <div class="x">x2</div>
                                  </div>
                                  <div class="d-flex align-items-center price">
                                    <p>$200</p>
                                    <span>$890</span>
                                  </div>
                                </div>
                              </div>
                              <div class="position-relative mt-5">
                                <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                                <input type="submit" class="quam-btn blue" value="Aplicar">
                              </div>
                              <div class="mt-4">
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Subtotal</p>
                                  <p class="fw-bolder" style="color: #00000075;">$75.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Descuento</p>
                                  <p class="fw-bolder" style="color: #00000075;">$-24.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="fw-bolder" style="color: #00000075;"> Gasto de envio</p>
                                  <p class="fw-bolder" style="color: #00000075;">$13.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="" style="font-size: 22px;"> <b>Total</b> </p>
                                  <p class="" style="font-size: 22px;"> <b> $75.000</b> </p>
                                </div>
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

<?php get_footer() ?>