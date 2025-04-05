<?php
function ItemsCart()
{
    global $woocommerce;
    $items = WC()->cart->get_cart();
    $item_counter = 0;
    // Calcular el total de items sumando las cantidades
    $total_items = 0;
    foreach ($items as $item) {
        $total_items += $item['quantity'];
    }

    foreach ($items as $item => $values) {
        $item_counter++;
        $product_id = $values['product_id'];
        $PrecioProducto = $woocommerce->cart->get_cart_item($item)["data"]->get_price();
        $_product = wc_get_product($values['data']->get_id());
        $price = $_product->get_price();
        $quantity = $values['quantity'];
        $title = $_product->get_name();
        $color = $_product->get_attribute('pa_color');
        $talla = $_product->get_attribute('pa_talla');
        $variation_id = 0;
        if ($_product->is_type('variation')) {
            $variation_id = $values['variation_id'];
        }
    ?>
        <div class="mini-cart-product-card align-items-start d-flex bg-white">
            <a href="<?= get_permalink($_product->get_id()) ?>" class="img-contain overflow-hidden rounded-1">
                <?= str_replace('<img', '<img loading="lazy"', $_product->get_image('medium', 'alt=' . $title)) ?>

            </a>
            <div class="w-100">
                <h5 class="mb-1"><a href="<?= get_permalink($_product->get_id()) ?>"><?= $title ?></a></h5>
                <div class="d-flex gap-2">
                    <?php if ($talla) { ?>
                        <p><b>Talla:</b> <?= $talla ?></p>
                    <?php } ?>

                    <?php if ($color) { ?>
                        <p><b>Color:</b> <?= $color ?></p>
                    <?php } ?>
                </div>

                <div class="d-flex align-items-center price mb-3">
                    <p ><?= $_product->get_price_html() ?> COP</p>
                    <?php if ($total_items >= 3) : ?>
                    <ins id="price" class="offer-price" aria-hidden="true" style="display: inline-block; margin-left: 5px;">
                      <span class="woocommerce-Price-amount amount">
                        <bdi style="color: #002d72;font-weight: bold;"><span class="woocommerce-Price-currencySymbol">$</span><?= number_format($PrecioProducto, 0, ',', '.') ?></bdi>
                      </span>
                    </ins>
                    <?php endif; ?>
                    <p id="priceUnit" data-price="<?php echo esc_attr($price); ?>" hidden> </p>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="quantity">
                        <button class="qtyminus minus"><i class="icon-minus"></i></button>
                        <input type="text" id="singleProductQuantity" name="quantity" value="<?= $quantity ?>" class="qtySingle">
                        <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                    </div>
                    <button id="trash_cart" class="remove" data-id="<?php echo esc_attr($product_id); ?>" data-variant="<?php echo isset($variation_id) ? esc_attr($variation_id) : 0; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="26" height="26" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
    $item_counter = 0;
    $total_items = count($items);

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
                        <div class="img-contain border">
                            <?= $_product->get_image('medium', 'alt=' . get_the_title())   ?>
                        </div>
                        <div>
                            <h5><?= esc_attr($title); ?></h5>
                            <p>Talla: <?= esc_html($talla); ?></p>
                            <p>Color: <?= esc_html($color); ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="quantity" data-id="<?php echo esc_attr($product_id); ?>" data-variant="<?php echo isset($variation_id) ? esc_attr($variation_id) : 0; ?>">
                        <button class="qtyminus minus"><i class="icon-minus"></i></button>
                        <input type="text" id="singleProductQuantity" readonly name="quantity" value="<?= esc_html($quantity); ?>" class="qtySingle">
                        <button class="qtyplus plus"><i class="icon-add---copia"></i></button>
                    </div>
                </td>

                <td>
                    <?= $_product->get_price_html() ?>
                </td>
                <td>
                    <div id="trash_cart" style="cursor: pointer;" class="d-flex align-items-center justify-content-center h-100 remove" data-id="<?php echo esc_attr($product_id); ?>" data-variant="<?php echo isset($variation_id) ? esc_attr($variation_id) : 0; ?>">
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
                    <span>$<?= empty($regular_price) ? number_format($price) : number_format($regular_price); ?></span>
                </div>
            </div>
        </div>
<?php
    }
}
?>