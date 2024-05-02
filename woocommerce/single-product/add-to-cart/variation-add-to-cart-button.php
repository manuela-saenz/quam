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

        <button type="submit" data-bs-toggle="offcanvas" data-product-id="0" data-bs-target="#mini-carrito" aria-controls="mini-carrito" class="single_add_to_cart_button quam-btn blue alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

        <button class="button-heart d-none d-lg-flex add-fav" id="add-sprod-favs" data-product-id="0" type="button"> <i class="icon-heart"></i> </button>

    </div>
    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0">
</div>

<!-- Detectar los cambios de cada value de las variantes-->
<script>
    var sessionFav = <?php echo json_encode($sessionFav); ?>;
    var targetNode = document.getElementById('add-sprod-favs');

    var observer = new MutationObserver(function(mutationsList, observer) {
        for (var mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'data-product-id') {
                var productId = targetNode.getAttribute('data-product-id');
                if (sessionFav.includes(productId)) {
                    $("#add-sprod-favs").addClass("active-fav");
                } else {
                    $("#add-sprod-favs").removeClass("active-fav");
                }
            }
        }
    });

    var config = {
        attributes: true
    };
    observer.observe(targetNode, config);
</script>

<!-- Detectar el value de data-product por defecto al cargar la página-->
<script>
   setTimeout(()=>{
		var targetNode = document.getElementById('add-sprod-favs');
	var productId = targetNode.getAttribute('data-product-id');
    console.log(productId)
	var sessionFav = <?php echo json_encode($sessionFav); ?>;
    if(!productId === 0){
        if (sessionFav.includes(productId)) {
		$("#add-sprod-favs").addClass("active-fav");
	} else {
		$("#add-sprod-favs").removeClass("active-fav");
	}
    }
	
	}, 500)
</script>