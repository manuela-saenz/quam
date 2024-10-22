<?php

/**
 * Template Name: Cambios y devoluciones
 */

get_header() ?>

<section class="pb-0">
    <div class="container">
        <h1 class="text-center section-subtitle mb-0"><?php the_title() ?></h1>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title-common-content"><span>01</span>Políticas de Cambio</h3>
                <p>Nuestro objetivo es asegurarnos que te encuentres satisfecho(a) con la compra que realizaste. Si por cualquier motivo (diferente a la garantía) no quedas conforme con el producto adquirido, puedes cambiarlo en
                    un plazo de 30 días calendario, contados desde la fecha en que adquiriste tu producto. Para ejercer el derecho al cambio, los productos deberán cumplir con los siguientes requisitos:</p>
            </div>
            <div class="col-md-6">
                <div class="img-contain">
                    <img src="https://images.unsplash.com/photo-1601935033900-059813f9abfc?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <?php for ($i = 0; $i < 8; $i++): ?>
                    <div class=" d-flex align-items-center change-rules mb-3">
                        <div class="img-contain me-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/11205/11205893.png" alt="">
                        </div>
                        <p>No haber sido usada la prenda.</p>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="faq-title mb-4">PREGUNTAS FRECUENTES DE LA POLÍTICA DE CAMBIOS</h2>
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <div>
                        <h4 class="section-subtitle-common-content">¿La política de cambios, así como sus condiciones son una obligación legal de
                            Quam?</h4>
                        <p>No. La política de cambios no es una obligación legal que deba cumplir Quam, sin embargo, para la
                            marca es muy importante la satisfacción de sus clientes, por lo que les permite cambiar sus prendas
                            dentro de un plazo determinado, siempre y cuando cumpla ciertos requisitos y bajo unas condiciones
                            particulares.</p>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="col-md-6">
                <div class="img-contain">
                    <img src="https://images.unsplash.com/photo-1601935033900-059813f9abfc?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>