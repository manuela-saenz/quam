<?php
require "includes/components.php";
require "includes/recursive-html.php";
require "includes/ajax-request.php";
add_theme_support('post-thumbnails');


add_theme_support("woocommerce");
function wc_remove_image_effect_support()
{

    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
    remove_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'wc_remove_image_effect_support', 100);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

// Elimina los ganchos actuales
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

// Agrega los ganchos en el orden deseado
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 15);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 25);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 30);


add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

function register_menus()
{
    register_nav_menus(array(
        'footer-categorias'   => 'Footer Categorias',
        'footer-informacion' => 'Footer Información',
        'footer-contacto' => 'Footer Contacto',
    ));
}
add_action('init', 'register_menus');

// funcion search
function arphabet_widgets_init()
{

    register_sidebar(array(
        'name'          => 'Home right sidebar',
        'id'            => 'home_right_1',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'arphabet_widgets_init');


function variations_visibility_all_pages($requires_shop_settings)
{
    if (is_page() || is_single()) {
        $requires_shop_settings = true;
    }

    return $requires_shop_settings;
}
add_filter('cfvsw_requires_shop_settings', 'variations_visibility_all_pages');

add_filter( 'loop_shop_per_page', 'lw_loop_shop_per_page', 30 );

function lw_loop_shop_per_page( $products ) {
 $products = 12;
 return $products;
}

add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');


function load_more_products() {
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $slug = isset($_POST['slug']) ? sanitize_text_field($_POST['slug']) : '';
    $per_page = 12; // Número de productos a cargar por solicitud
    $offset = ($paged - 1) * $per_page;

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat', // Taxonomía de WooCommerce para categorías de productos
                'field'    => 'slug', // Puedes usar 'slug' o 'id'
                'terms'    => $slug, // Slug de la categoría que deseas filtrar
            ),
        ),
    );

    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    endif;
    // wp_reset_postdata();
    die();
}

function custom_override_checkout_fields($fields)
{
    // Elimina el campo "Empresa" del formulario de facturación
    unset($fields['billing']['billing_company']);
    // unset($fields['billing']['billing_id']);
    // unset($fields['billing']['billing_country']);
    // unset($fields['billing']['billing_city']);

    return $fields;
}

function convertToSlug($str)
{

    // Convertir cadena a minúsculas 
    $str = strtolower($str);

    // Reemplazar los espacios con guiones 
    $str = str_replace(' ', '-', $str);

    // Reemplazar los acentos
    $acentos = array(
        'á' => 'a',
        'é' => 'e',
        'í' => 'i',
        'ó' => 'o',
        'ú' => 'u',
        'ü' => 'u',
        'ñ' => 'n'
    );
    $str = strtr($str, $acentos);

    // Quitar los caracteres especiales excepto letras, números y guiones 
    $str = preg_replace('/[^a-z0-9\-]/', '', $str);

    // Quitar los guiones consecutivos 
    $str = preg_replace('/-+/', '-', $str);

    // Recortar los guiones del principio y final de la cadena 
    $str = trim($str, '-');

    return $str;
}

function removerTalla($texto)
{
    $resultado = preg_replace('/ - .+/', '', $texto);
    return $resultado;
}

function related_products_quantity($args)
{
    $args['posts_per_page'] = 10;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'related_products_quantity');

// Función para obtener productos por categoría
function get_products_by_category_name($category_name)
{
    // Obtener el término (categoría) por su nombre
    $category = get_term_by('name', $category_name, 'product_cat');

    // Verificar si se encontró la categoría
    if ($category) {
        // Obtener el ID de la categoría
        $category_id = $category->term_id;

        // Consulta para obtener los productos asociados a la categoría por su ID
        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category_id,
                ),
            ),
        );

        $products_query = new WP_Query($args);

        // Verificar si se encontraron productos
        if ($products_query->have_posts()) {
            // Crear un array para almacenar los objetos de productos
            $products = array();

            // Iterar sobre los productos y almacenar la información completa del producto en el array
            while ($products_query->have_posts()) {
                $products_query->the_post();
                $product = wc_get_product(get_the_ID());

                // Obtener el precio regular del producto
                $regular_price = $product->get_regular_price();
                // Obtener el precio de venta del producto (si está configurado)
                $sale_price = $product->get_sale_price();
                // Almacenar los precios en un array asociativo
                $prices = array(
                    'regular_price' => $regular_price,
                    'sale_price' => $sale_price,
                );
                // Agregar los precios al objeto de producto
                $product->prices = $prices;
                // Obtener la imagen destacada del producto
                $thumbnail_id = get_post_thumbnail_id($product->get_id());
                $image_src = wp_get_attachment_image_src($thumbnail_id, 'large');
                $product->image_src = $image_src[0];

                // Obtener la descripción corta del producto
                $product->short_description = $product->get_short_description();

                $products[] = $product;
            }

            // Restablecer datos de los productos
            wp_reset_postdata();

            return $products;
        } else {
            return array(); // No se encontraron productos en la categoría seleccionada
        }
    } else {
        return array(); // La categoría especificada no fue encontrada
    }
}

// function randomCode()
// {
//     $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $codigo = '';

//     for ($i = 0; $i < 6; $i++) {
//         $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
//     }

//     return $codigo;
// }


function custom_woocommerce_products_per_page($products_per_page)
{
    return 5; // Establece el número de productos por página
}
add_filter('loop_shop_per_page', 'custom_woocommerce_products_per_page', 5);

function get_all_product_categories_attributes_and_prices()
{
    // Obtener todas las categorías de productos
    $product_categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => 0,
        'exclude' => array(26, 15),
    ));

    $categories_data = array();

    // Iterar sobre cada categoría de producto
    foreach ($product_categories as $category) {
        // Obtener los productos de la categoría actual
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category->term_id,
                ),
            ),
        );
        $products = get_posts($args);

        // Array para almacenar los atributos de los productos en esta categoría
        $attributes = array();
        $prices = array(); ?>

        

            <?php // Iterar sobre cada producto
            foreach ($products as $product_post) {
                $product = wc_get_product($product_post->ID);

                // Almacenar el precio del producto
                $prices[] = $product->get_price();

                // Obtener los atributos del producto
                $product_attributes = $product->get_attributes();

                // Iterar sobre cada atributo y almacenarlo en el array de atributos si es usado para variaciones
                foreach ($product_attributes as $attribute) {
                    if ($attribute->get_variation()) { // Verifica si el atributo se usa para variaciones
                        if ($attribute->is_taxonomy()) {
                            $taxonomy = $attribute->get_taxonomy_object();
                            $terms = wp_get_post_terms($product_post->ID, $attribute->get_name());
                            foreach ($terms as $term) {
                                $attributes[$taxonomy->attribute_label][$term->slug] = $term->name;
                            }
                        } else {
                            $attribute_name = $attribute->get_name();
                            $options = $attribute->get_options();
                            foreach ($options as $option) {
                                $attributes[$attribute_name][] = $option;
                            }
                        }
                    }
                }
            }

            // Eliminar duplicados en el array de atributos
            foreach ($attributes as $key => $values) {
                $attributes[$key] = array_unique($values);
            }

            // Calcular el precio mínimo y máximo de la categoría
            $min_price = !empty($prices) ? min($prices) : 0;
            $max_price = !empty($prices) ? max($prices) : 0;

            // Añadir la categoría, sus atributos y precios al array final
            $categories_data[$category->slug] = array(
                'attributes' => $attributes,
                'min_price' => $min_price,
                'max_price' => $max_price,
            );
        }

        return [$categories_data, $product_categories];
    }

    add_action('wp_ajax_load_products', 'load_products');
    add_action('wp_ajax_nopriv_load_products', 'load_products');
    function load_products()
    {
        $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

        $args = array(
            'post_type' => array('product', 'product_variation'),
            'paged' => $paged,
            'product_cat' => $category,
            'posts_per_page' => 5,
        );

        $query = new WP_Query($args);

        $products = array(); // Array para almacenar los productos

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                // Obtener datos del producto
                $product = wc_get_product(get_the_ID());

                $products[] = array(
                    'id' => $product->get_id(),
                    'name' => $product->get_name(),
                    'price' => $product->get_price(),
                    'image' => wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0],
                    'permalink' => get_permalink($product->get_id()),
                );
            }
        }

        wp_reset_postdata();

        // Enviar respuesta en JSON
        wp_send_json($products);

        die();
    }


    add_action('template_redirect', 'apply_custom_coupon_code');

    function apply_custom_coupon_code()
    {
        if (isset($_POST['codigo_descuento']) && !empty($_POST['codigo_descuento'])) {
            $coupon_code = sanitize_text_field($_POST['codigo_descuento']);
            $applied = WC()->cart->apply_coupon($coupon_code);

            if ($applied) {
                wc_print_notices();
            } else {
                wc_add_notice(__('El cupón no es válido.', 'woocommerce'), 'error');
            }
        }
    }

    add_filter('cron_schedules', 'custom_cron_interval');

    function custom_cron_interval($schedules)
    {
        $schedules['every_five_minutes'] = array(
            'interval' => 3, // 300 segundos = 5 minutos
            'display'  => __('Cada 3 Minutos')
        );
        return $schedules;
    }


    add_action('wp', 'schedule_my_custom_cron_job');

    function schedule_my_custom_cron_job()
    {
        if (!wp_next_scheduled('my_custom_cron_job')) {
            wp_schedule_event(time(), 'every_five_minutes', 'my_custom_cron_job');
        }
    }

    add_action('my_custom_cron_job', 'execute_my_function');

    function execute_my_function()
    {
        // Cargar las clases necesarias de WooCommerce
        if (!class_exists('WooCommerce')) {
            error_log('WooCommerce no está instalado o activado.');
            return;
        }

        // Obtener los pedidos pendientes de WooCommerce
        $args = array(
            'status' => 'pending', // Estado pendiente
            'payment_method' => 'payulatam', // ID del método de pago PayU (debes confirmar el ID correcto)
            'limit' => -1 // Sin límite para obtener todos los pedidos
        );

        $orders = wc_get_orders($args);

        if (empty($orders)) {
            error_log('No se encontraron pedidos pendientes con PayU.');
            return;
        }

        foreach ($orders as $order) {
            $order_id = $order->get_id();

            // Preparar la solicitud a la API de PayU
            $url = 'https://api.payulatam.com/reports-api/4.0/service.cgi';
            $body = array(
                'test' => false,
                'language' => 'en',
                'command' => 'ORDER_DETAIL_BY_REFERENCE_CODE',
                'merchant' => array(
                    'apiLogin' => 'gbUeoK36Z6a55H8', // Reemplaza con tu API Login
                    'apiKey' => '3Fe1XI463W6gVi6Wdo93zBi1Px' // Tu API Key
                ),
                'details' => array(
                    'referenceCode' => strval($order_id) // Usar el ID del pedido como referencia
                )
            );

            $args = array(
                'body' => json_encode($body),
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ),
                'method' => 'POST'
            );

            // Hacer la solicitud
            $response = wp_remote_post($url, $args);

            if (is_wp_error($response)) {
                error_log('Error en la solicitud a PayU: ' . $response->get_error_message());
                continue;
            }

            $response_body = wp_remote_retrieve_body($response);
            $data = json_decode($response_body, true);

            if ($data) {
                error_log('Respuesta de PayU para el pedido ' . $order_id . ': ' . print_r($data, true));
            } else {
                error_log('Error al procesar la respuesta de PayU para el pedido ' . $order_id);
            }

            if (isset($data['result']['payload'][0]['transactions'][0]['transactionResponse']['state'])) {
                $transaction_state = $data['result']['payload'][0]['transactions'][0]['transactionResponse']['state'];

                if ($transaction_state === 'APPROVED') {
                    // Cambia el estado del pedido a 'processing'
                    $order->update_status('processing', __('Payment approved by PayU.', 'your-text-domain'));
                    error_log('El estado del pedido ' . $order_id . ' ha sido cambiado a procesando.');
                }
            }
        }
    }

    add_action('wp_ajax_get_product_image', 'get_product_image');
    add_action('wp_ajax_nopriv_get_product_image', 'get_product_image');

    function get_product_image()
    {
        // Verificar los parámetros recibidos
        if (isset($_POST['product_id']) && isset($_POST['data_slug'])) {
            $product_id = intval($_POST['product_id']);
            $data_slug = sanitize_text_field($_POST['data_slug']);

            // Obtener el producto
            $product = wc_get_product($product_id);

            if ($product && $product->is_type('variable')) {
                // Obtener las variaciones del producto
                $variations = $product->get_available_variations();

                foreach ($variations as $variation) {
                    $variation_id = $variation['variation_id'];
                    $attributes = $variation['attributes'];

                    // Verificar si el atributo coincide con el data_slug
                    if (isset($attributes['attribute_pa_color']) && $attributes['attribute_pa_color'] === $data_slug) {
                        // Obtener la URL de la imagen de la variación
                        $image_id = get_post_thumbnail_id($variation_id);
                        $image_url = wp_get_attachment_url($image_id);

                        // Devolver la URL de la imagen en formato JSON
                        wp_send_json_success(array('image_url' => $image_url));
                    }
                }
            }
        }

        // Si no se encuentra la imagen, devolver un error
        wp_send_json_error(array('message' => 'Imagen no encontrada'));
    }


    add_action('wp_ajax_update_cart_count', 'update_cart_count');
    add_action('wp_ajax_nopriv_update_cart_count', 'update_cart_count');
    add_action('wp_ajax_my_custom_action', 'my_custom_function');
    add_action('wp_ajax_nopriv_my_custom_action', 'my_custom_function');
    
    function my_custom_function() {
        // Declara la instancia aquí
        $woocommerce = WC();
    
        $cart_items = $woocommerce->cart->get_cart();
        echo json_encode($cart_items);
    
        wp_die();
    }
    
    function update_cart_count()
    {
        global $woocommerce;

        if (WC()->cart) {
            $count = WC()->cart->get_cart_contents_count();
            ob_start();
            ItemsCart();
            $itemsCart = ob_get_clean();
            $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $itemsCart);
            $itemsCount = $woocommerce->cart->get_cart_contents_count();
            $total_discount = 0;
            $applied_coupons = $woocommerce->cart->get_applied_coupons();
            // $coupon_details = $this->verifyCoupon($applied_coupons);

            // Ahora, $coupon_details es un array que contiene los detalles de todos los cupones aplicados
            $ValorTotalSinDescuento = $woocommerce->cart->get_cart_subtotal();
            $ValorTotal = $woocommerce->cart->get_cart_total();
            $DescuentoTotal = $woocommerce->cart->get_total_discount();

            wp_send_json_success(array(
                'count' => $count,
                'itemsCart' => $buffer,
                "discount" => $DescuentoTotal,
                "quantity" => $itemsCount,
                "subtotal" => $ValorTotalSinDescuento,
                "discount_amount" => $total_discount,
                "total" => $ValorTotal,
            ));
        } else {
            wp_send_json_error(array('message' => 'Carrito no disponible'));
        }
    }

    add_action('wp_ajax_update_favs', 'update_favs');
    add_action('wp_ajax_nopriv_update_favs', 'update_favs');

    function update_favs()
    {
        if (isset($_POST['favs'])) {
            $favs = json_decode(stripslashes($_POST['favs']));
            $_SESSION["prodsfavs"] = $favs;
            $count_favs = count($favs);

            ob_start();
            get_template_part("templates/components/mini", "favs");
            $html = ob_get_clean();
            echo json_encode(
                array(
                    "html" => $html,
                    "count" => $count_favs,
                )
            );
        }
        wp_die();
    }
