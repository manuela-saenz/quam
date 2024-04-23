<?php
function ItemsCart()
{
    $items = WC()->cart->get_cart();
    $total_items = count($items);
    $item_counter = 0;
    foreach ($items as $item => $values) {
        $item_counter++;
        $product_id = $values['product_id'];
        $_product = wc_get_product($values['data']->get_id());
        $regular_price = $_product->get_regular_price();
        $sale_price = $_product->get_sale_price();
        $price = $_product->get_price();
        $link = get_permalink($values['product_id']);
        $image = get_the_post_thumbnail_url($values['product_id'], array(95, 95));
        $quantity = $values['quantity'];
        $title = $_product->get_name();
        $image = '';
        $color = $_product->get_attribute('pa_color');
        $talla = $_product->get_attribute('pa_talla');
        if ($_product->is_type('variation')) {
            $image_id = $_product->get_image_id();
            $image = wp_get_attachment_image_url($image_id, array(95, 95));
        } else {
            $image = get_the_post_thumbnail_url($values['product_id'], array(95, 95));
        }
        $identificador = $_product->get_id();
        // echo '<pre>';
        // var_dump($_product);
        // echo '</pre>';
?>
        <div class="select-bag d-flex bg-white">
            <div class="img-fit">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
            </div>
            <div>
                <h5><?php echo esc_html($title); ?></h5>
                <p>Talla: <?php echo esc_html($color); ?></p>
                <p>Color: <?php echo esc_html($talla); ?></p>
                <div class="quantity">
                    <button class="qtyminus minus"><i class="icon-minus"></i></button>
                    <input type="text" id="singleProductQuantity" name="quantity" value="<?php echo esc_html($quantity); ?>" class="qtySingle">
                    <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                </div>
                <div class="d-flex align-items-center price">
                    <p>$<?php echo number_format($price * $quantity, 2, '.', ','); ?></p>
                    <span>$<?php echo number_format($regular_price * $quantity, 2, '.', ','); ?></span>
                </div>
            </div>
            <a href="#" id="trash_cart" class="remove" data-id="<?php echo esc_attr($product_id); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 7l16 0"></path>
                    <path d="M10 11l0 6"></path>
                    <path d="M14 11l0 6"></path>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg>
            </a>
        </div>

        <!-- <script>
            function eliminarItem(title) {
                var nombreProducto = title;
                var productos = JSON.parse(localStorage.getItem('productos')) || [];

                var nuevosProductos = productos.filter(function(producto) {
                    return producto.nombre !== nombreProducto;
                });
                localStorage.setItem('productos', JSON.stringify(nuevosProductos));
            }
        </script> -->


        <?php
        if ($item_counter === $total_items) {
        ?>
            <!-- <div class="position-sticky bg-white full-total">
        <div id="cart-total" class="center-vertical total justify-content-between mb-2 fw-bold">
          <p class="mb-0">Total</p>
          <span class="totalFinal  woocommerce-Price-amount amount"><?php echo WC()->cart->get_cart_total(); ?></span>

        </div>
        <a href="<?= get_permalink(10) ?>" class="de-btn center-all primary rounded-4 w-100" id="showBuy">
          Realizar pedido
        </a>
      </div> -->

<?php

        }
    }
}
?>