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
        $price = $_product->get_price();
        $link = get_permalink($values['product_id']);
        $image = get_the_post_thumbnail_url($values['product_id']);
        $quantity = $values['quantity'];
        $title = $_product->get_name();
        $image = '';
        $color = $_product->get_attribute('pa_color');
        $talla = $_product->get_attribute('pa_talla');
        $variation_id = 0;
        if ($_product->is_type('variation')) {
            $variation_id = $values['variation_id'];
            $image_id = $_product->get_image_id();
            $image = wp_get_attachment_image_url($image_id);
        } else {
            $image = get_the_post_thumbnail_url($values['product_id']);
        }
        $identificador = $_product->get_id();
?>
        <div class="mini-cart-product-card align-items-start d-flex bg-white">
            <div class="img-contain overflow-hidden rounded-1">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
            </div>
            <div>
                <h5 class="mb-1"><?= $title ?></h5>
                <div class="d-flex gap-2">
                    <?php if ($talla) { ?>
                        <p><b>Talla:</b> <?= $talla ?></p>
                    <?php } ?>

                    <?php if ($color) { ?>
                        <p><b>Color:</b> <?= $color ?></p>
                    <?php } ?>
                </div>

                <div class="d-flex align-items-center price mb-3">
                    <p id="price">$<?php echo number_format($price); ?></p>
                    <?php if ($regular_price) { ?>
                        <span id="regular_price">$<?php echo number_format($regular_price); ?></span>
                    <?php } ?>
                    <p id="priceUnit" data-price="<?php echo esc_attr($price); ?>" hidden> </p>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="quantity">
                        <button class="qtyminus minus"><i class="icon-minus"></i></button>
                        <input type="text" id="singleProductQuantity" name="quantity" value="<?= $quantity ?>" class="qtySingle">
                        <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                    </div>
                    <button id="trash_cart" class="remove" data-id="<?php echo esc_attr($product_id); ?>" data-variant="<?php echo isset($variation_id) ? esc_attr($variation_id) : 0; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7l16 0"></path>
                            <path d="M10 11l0 6"></path>
                            <path d="M14 11l0 6"></path>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                        </svg>
                    </button>
                </div>


            </div>

        </div>
    <?php
    }
}

function ItemsCheckout()
{
    $items = WC()->cart->get_cart();
    $total_items = count($items);
    $item_counter = 0;

    foreach ($items as $item => $values) {
        $item_counter++;
        $product_id = $values['product_id'];
        $_product = wc_get_product($values['data']->get_id());
        $regular_price = $_product->get_regular_price();
        $price = $_product->get_price();
        $link = get_permalink($values['product_id']);
        $image = get_the_post_thumbnail_url($values['product_id'], array(180, 180));
        $quantity = $values['quantity'];
        $title = $_product->get_name();
        $image = '';
        $color = $_product->get_attribute('pa_color');
        $talla = $_product->get_attribute('pa_talla');
        $variation_id = 0;
        if ($_product->is_type('variation')) {
            $variation_id = $values['variation_id'];
            $image_id = $_product->get_image_id();
            $image = wp_get_attachment_image_url($image_id, array(180, 180));
        } else {
            $image = get_the_post_thumbnail_url($values['product_id'], array(180, 180));
        }
        $identificador = $_product->get_id();
    ?>
        <tbody class="mb-4">
            <tr>
                <td scope="row d-flex align-items-center ">
                    <div class=" d-flex align-items-center h-100  p-3">
                        <div class="img-fit">
                            <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>">
                        </div>
                        <div>
                            <h5><?= esc_attr($title); ?></h5>
                            <p>Talla: <?= esc_html($talla); ?></p>
                            <p>Color: <?= esc_html($color); ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-end h-100 ">
                        <div class="quantity">
                            <button class="qtyminuscheck minus"><i class="icon-minus"></i></button>
                            <input type="text" id="singleProductQuantity" name="quantity" value="<?= esc_html($quantity); ?>" class="qtySingle">
                            <button class="qtypluscheck plus"><i class="icon-add---copia"></i></button>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-center h-100 "> $<?= number_format($price * $quantity); ?>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center justify-content-center h-100 "> $<?= number_format($price * $quantity); ?>
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
    <?php
    }
}

function ItemsSummary()
{
    $items = WC()->cart->get_cart();
    $total_items = count($items);
    $item_counter = 0;

    foreach ($items as $item => $values) {
        $item_counter++;
        $product_id = $values['product_id'];
        $_product = wc_get_product($values['data']->get_id());
        $regular_price = $_product->get_regular_price();
        $price = $_product->get_price();
        $link = get_permalink($values['product_id']);
        $image = get_the_post_thumbnail_url($values['product_id'], array(180, 180));
        $quantity = $values['quantity'];
        $title = $_product->get_name();
        $image = '';
        $color = $_product->get_attribute('pa_color');
        $talla = $_product->get_attribute('pa_talla');
        $variation_id = 0;
        if ($_product->is_type('variation')) {
            $variation_id = $values['variation_id'];
            $image_id = $_product->get_image_id();
            $image = wp_get_attachment_image_url($image_id, array(180, 180));
        } else {
            $image = get_the_post_thumbnail_url($values['product_id'], array(180, 180));
        }
        $identificador = $_product->get_id();
    ?>
        <div class="d-flex align-items-center h-100 purchase">
            <div class="img-fit">
                <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>">
            </div>
            <div>
                <div class="d-flex align-items-baseline">
                    <h5><?= esc_attr($title); ?></h5>
                    <div class="x">x<?= esc_html($quantity); ?></div>
                </div>
                <div class="d-flex align-items-center price">
                    <p>$<?= number_format($price); ?></p>
                    <span>$<?= number_format($regular_price); ?></span>
                </div>
            </div>
        </div>
<?php
    }
}
?>