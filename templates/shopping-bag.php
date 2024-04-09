<?php

/**
 * Template Name: Bolsa de compra
 */


get_header() ?>

<section id="bag" class="padg-mobile h-100">
  <div class="container">
    <div class="flex-grow-1 flex-shrink-0">
      <div class="mb-5 ">
        <div id="stepper1" class="bs-stepper">
          <div class="step_by_step row">
            <div class="col-md-2">
              <a href="">Continuar comprando</a>
            </div>
            <div class="col-md-7 offsted-md-1">
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
              </div>
            </div>

            <div class="col-md-4">

            </div>

          </div>

          <div class="row center-all">
            <div class="col-md-10">
              <div class="bs-stepper-content">
                <form onSubmit="return false">
                  <h3 class="mb-4"> Bolsa de la compra</h3>
                  <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                    <div class="form-group row">
                      <div class="col-md-8">
                        <table class="table table-bag">
                          <thead>
                            <tr>
                              <th scope="col">Producto (s)</th>
                              <th scope="col">Cantidad</th>
                              <th scope="col">Precio</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row d-flex align-items-center">
                                <div class="d-flex align-items-center h-100">
                                  <div class="img-fit">
                                    <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                  </div>
                                  <div>
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <p>Talla: S</p>
                                    <p>Color: </p>
                                  </div>
                                </div>
                              </th>
                              <td>
                                <div class="d-flex align-items-center h-100">
                                  <div class="quantity">
                                    <button class="qtyminus minus"><i class="icon-minus"></i></button>
                                    <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
                                    <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex align-items-center h-100"> $70.000</div>  
                              </td>
                              <td>
                                <div class="d-flex align-items-center h-100">
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
                            <tr>
                              <th scope="row d-flex align-items-center">
                                <div class="d-flex align-items-center h-100">
                                  <div class="img-fit">
                                    <img src="https://www.quam.com.co/web_quam/wp-content/uploads/2024/03/singleproduct-1.jpg" alt="">
                                  </div>
                                  <div>
                                    <h5>Example Midi Bodycon Dress</h5>
                                    <p>Talla: S</p>
                                    <p>Color: </p>
                                  </div>
                                </div>
                              </th>
                              <td>
                                <div class="d-flex align-items-center h-100">
                                  <div class="quantity">
                                    <button class="qtyminus minus"><i class="icon-minus"></i></button>
                                    <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
                                    <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                                  </div>
                                </div>

                              </td>
                              <td>
                                <div class="d-flex align-items-center h-100"> $70.000</div>  
                              </td>
                              <td>
                                <div class="d-flex align-items-center h-100">
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
                        <label class="custom-checkbox d-flex align-items-baseline mb-4"><input class="politicy check me-3" type="checkbox" id="cboxtwo" value="first_checkbox">
                          <div>
                            Autorizo el uso de mis datos personales con fines comerciales y publicitarios para recibir
                            información sobre productos y servicios de interés.
                          </div>
                        </label>
                        <a href="" class="quam-btn blue">Diligenciar información </a>
                      </div>

                      <div class="col-4">
                        <div class="c">
                          <form method="post" class="position-relative">
                            <div class="position-relative">
                              <input type="text" id="codigo_descuento" name="codigo_descuento" placeholder="Código de descuento" required>
                              <input type="submit" class="quam-btn blue" value="Aplicar">
                            </div>
                            <div class="mt-4">
                              <div class="d-flex justify-content-between">
                                <p> Subtotal</p>
                                <p>$75.000</p>
                              </div>
                              <div class="d-flex justify-content-between">
                                <p> Descuento</p>
                                <p>$-24.000</p>
                              </div>
                              <div class="d-flex justify-content-between">
                                <p> <b>Total</b> </p>
                                <p> <b> $75.000</b> </p>
                              </div>
                            </div>

                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex justify-content-end">
                      <button class="quam-btn blue" onclick="stepper1.next()">Next</button>
                    </div>

                  </div>
                  <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button class="quam-btn blue" onclick="stepper1.previous()">Previous</button>
                    <button class="quam-btn blue" onclick="stepper1.next()">Next</button>
                  </div>
                  <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                    <button class="quam-btn blue mt-5" onclick="stepper1.previous()">Previous</button>
                    <button class="quam-btn blue" onclick="stepper1.next()">Next</button>
                  </div>
                  <div id="test-l-4" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger4">
                    <button class="quam-btn blue mt-5" onclick="stepper1.previous()">Previous</button>
                    <button type="submit" class="quam-btn blue mt-5">Submit</button>
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