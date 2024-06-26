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

function randomCode()
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    for ($i = 0; $i < 6; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}


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
        $paged = $_POST['paged'];
        $category = $_POST['category'];

        $args1 = array(
            'post_type' => 'product',
            'paged' => $paged,
            'product_cat' => $category,
        );

        $args2 = array(
            'post_type' => 'product_variation',
            'paged' => $paged,
            'post_parent__in' => get_posts(array(
                'post_type' => 'product',
                'fields' => 'ids',
                'product_cat' => $category,
            )),
        );

        $posts1 = new WP_Query($args1);
        $posts2 = new WP_Query($args2);

        $combined_posts = array_merge($posts1->posts, $posts2->posts);

        foreach ($combined_posts as $post) {
            setup_postdata($post);
            wc_get_template_part('content', 'product');
        }

        wp_reset_postdata();

        die();
    }