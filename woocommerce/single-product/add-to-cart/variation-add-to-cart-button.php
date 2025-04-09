<?php

global $product;
$sessionFav = $_SESSION["prodsfavs"]
?>
<div class="woocommerce-variation-add-to-cart variations_button">
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>
    <div class="d-flex gap-3">
        <?php
        do_action('woocommerce_before_add_to_cart_quantity');

        woocommerce_quantity_input(
            array(
                'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
            )
        );

        do_action('woocommerce_after_add_to_cart_quantity');
        ?>

        <button type="submit" data-bs-toggle="offcanvas" id="btn-desktop" data-product-id="0" data-bs-target="#mini-carrito" aria-controls="mini-carrito" class="single_add_to_cart_button quam-btn red alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

        <button class="button-heart d-none d-lg-flex add-fav" id="add-sprod-favs" data-product-id="0" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
            </svg>
        </button>

    </div>
    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0">
</div>

<!-- Detectar los cambios de cada value de las variantes-->
<script>
    var targetNode = document.getElementById('add-sprod-favs');

    var observer = new MutationObserver(function(mutationsList, observer) {
        for (var mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'data-product-id') {
                var sessionFavLocal = JSON.parse(localStorage.getItem('sessionFav')) || [];
                var productId = targetNode.getAttribute('data-product-id');
                var outOfStock = document.querySelector('.stock.out-of-stock');

                // Habilitar el botón de agregar al carrito si no está fuera de stock
                if (!outOfStock) {
                    var submitButton = document.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                }
                const relatedSwiper = document.getElementById("related-swiper");
                // Verificar si el producto está en favoritos
                if (sessionFavLocal.includes(Number(productId))) {
                    // Añadir la clase active-fav solo al botón con el data-product-id correspondiente
                    const button = document.querySelector(`.add-fav[data-product-id="${productId}"]`);
                    if (button) {
                        button.classList.add('active-fav');
                    }
                } else {
                    //Remover la clase active-fav del botón si no está en favoritos
                    const button = document.querySelector(`.add-fav[data-product-id="${productId}"]`);
                    if (button) {
                        button.classList.remove('active-fav');
                    }
                }
            }
        }
    });

    var config = {
        attributes: true,
    };
    observer.observe(targetNode, config);

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            var outOfStock = document.querySelector('.stock.out-of-stock');
            if (outOfStock) {
                var submitButton = document.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                }
            }
        }, 1000);
    });
</script>

<!-- Detectar el value de data-product por defecto al cargar la página-->
<script>
    setTimeout(() => {
        var targetNode = document.getElementById('add-sprod-favs');
        var productId = targetNode.getAttribute('data-product-id');
        var sessionFav = <?php echo json_encode($sessionFav); ?>;
        if (!productId === 0) {
            if (sessionFav.includes(productId)) {
                $(".add-fav").addClass("active-fav");
            } else {
                $(".add-fav").removeClass("active-fav");
            }
        }

    }, 200)
</script>