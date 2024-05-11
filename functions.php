<?php 
require "includes/components.php";
require "includes/recursive-html.php";
require "includes/ajax-request.php";
add_theme_support('post-thumbnails');


add_theme_support("woocommerce");
function wc_remove_image_effect_support() {

    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
    remove_theme_support( 'wc-product-gallery-slider' );

}
add_action( 'after_setup_theme', 'wc_remove_image_effect_support', 100 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Elimina los ganchos actuales
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Agrega los ganchos en el orden deseado
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 30 );




add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    // Elimina el campo "Empresa" del formulario de facturación
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_id']);
    // unset($fields['billing']['billing_country']);
    
    return $fields;
}


function related_products_quantity( $args ) {
    $args['posts_per_page'] = 10;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'related_products_quantity' );

// Función para obtener productos por categoría
function get_products_by_category_name($category_name) {
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

function randomCode()
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    for ($i = 0; $i < 6; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}