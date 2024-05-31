<?php

/**
 * Template Name: Contacto
 */


get_header() ?>


<section class="contact-container">
    <div class="container contact-info">
        <div class="container-form">
            <h2>Contáctanos</h2>
            <form action="" id="contact-form">
                <div>
                    <input type="text" name="txtName" id="txtName" placeholder="Nombre completo">
                    <input type="text" name="txtEmail" id="txtEmail" placeholder="Correo electrónico*">
                    <input type="text" name="txtPhone" id="txtPhone" placeholder="Teléfono*">
                    <input type="text" name="txtConsult" id="txtConsult" placeholder="Motivo de la consulta">
                </div>
                <textarea name="txtMessage" id="txtMessage" placeholder="Introduzca su mensaje aquí"></textarea>
                <button class="quam-btn blue w-100 mt-2" id="btnSend">Enviar</button>
            </form>
            <div class="alert alert-danger" role="alert" id="error_alert" style="display:none; color: #721c24; background-color: #f8d7daa1; border: 2px solid #f5c6cb; padding: 13px; margin-bottom: 10px;">
            </div>
            <div class="alert alert-success" role="alert" id="success_alert" style="display:none; color: #155724; background-color: #d4eddaa1; border:1px solid #c3e6cb; #f5c6cb; padding: 13px; margin-bottom: 10px;">
            </div>
        </div>

        <div class="container-info">
            <h3>Más información</h3>
            <div class="call-div-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>
                <a href="tel:++57 311 4482684">+57 311 4482684</a>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                    <path d="M3 7l9 6l9 -6" />
                </svg>
                <a>legiestsas@gmail.com</a>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                    <path d="M12 7v5l3 3" />
                </svg>
                <a>Lunes a jueves: 9 a. m. a 7 p. m.</a>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                    <path d="M3 9l4 0" />
                </svg>
                <a>Rastrear paquete</a>
            </div>
            <div class="cont-redes-info">
                <a>Redes sociales</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M16.5 7.5l0 .01" />
                </svg>
            </div>
        </div>
    </div>
    <div class="recuadro-amarillo">

    </div>
</section>







<?php get_footer() ?>