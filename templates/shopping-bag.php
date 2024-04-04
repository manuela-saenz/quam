<?php

/**
 * Template Name: Bolsa de compra
 */


get_header() ?>

<section id="bag" class="padg-mobile">
  <div class="container-fluid">
    <div class="flex-grow-1 flex-shrink-0">
      <div class="mb-5 ">
        <div id="stepper1" class="bs-stepper">
          <div class="step_by_step row">
            <div class="col-md-2">
              <a href="">Continuar comprando</a>
            </div>
            <div class="col-md-5 offset-2">
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

            <div class="col-md-3">

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
                              <th scope="row">
                                <div>
                                  <div class="img-fit">
                                    <img src="" alt="">
                                  </div>
                                  <div>
                                    <h5>Example Midi Bodycon Dress</h5>
                                  </div>
                                </div>

                              </th>
                              <td>
                                <div class="quantity">
                                  <button class="qtyminus minus"><i class="icon-minus"></i></button>
                                  <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
                                  <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                                </div>
                              </td>
                              <td>$70.000 </td>
                              <td><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M4 7l16 0" />
                                  <path d="M10 11l0 6" />
                                  <path d="M14 11l0 6" />
                                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg></td>
                            </tr>
                            <tr>
                              <th scope="row">
                                <div>
                                  <div class="img-fit">
                                    <img src="" alt="">
                                  </div>
                                  <div>
                                    <h5>Example Midi Bodycon Dress</h5>
                                  </div>
                                </div>
                              </th>
                              <td>
                                <div class="quantity">
                                  <button class="qtyminus minus"><i class="icon-minus"></i></button>
                                  <input type="text" id="singleProductQuantity" name="quantity" value="1" class="qtySingle">
                                  <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                                </div>
                              </td>
                              <td>$70.000 </td>
                              <td>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                  <path d="M4 7l16 0" />
                                  <path d="M10 11l0 6" />
                                  <path d="M14 11l0 6" />
                                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td colspan="2">Larry the Bird</td>
                              <td>@twitter</td>
                            </tr>
                          </tbody>
                        </table>
                        <label for="exampleInputEmail1">Email address</label>

                      </div>
                      <div class="col-4">
                        hhh
                      </div>
                      <div class="col-md-12">
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>

                    </div>
                    <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                  </div>
                  <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                  </div>
                  <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                    <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                  </div>
                  <div id="test-l-4" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger4">
                    <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
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