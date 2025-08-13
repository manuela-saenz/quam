<?php



function disable_feeds()
{
    wp_die('No hay feeds disponibles.');
}
add_action('do_feed',     function () {
    wp_die('Feed desactivado');
}, 1);
add_action('do_feed_rdf', function () {
    wp_die('Feed desactivado');
}, 1);
add_action('do_feed_rss', function () {
    wp_die('Feed desactivado');
}, 1);
add_action('do_feed_rss2', function () {
    wp_die('Feed desactivado');
}, 1);
add_action('do_feed_atom', function () {
    wp_die('Feed desactivado');
}, 1);

add_filter('rest_authentication_errors', function ($result) {
    // Permitir REST para WooCommerce y usuarios logueados
    if (is_user_logged_in()) return $result;

    $request_uri = $_SERVER['REQUEST_URI'];

    // Permitir también acceso a rutas de WooCommerce REST
    if (strpos($request_uri, '/wp-json/wc/') !== false) return $result;

    return new WP_Error('rest_cannot_access', 'Acceso restringido a la API REST.', ['status' => 403]);
});

// Ocultar versión de WordPress
remove_action('wp_head', 'wp_generator');

remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('xmlrpc_rsd_apis', 'rest_output_link_header');

// add_filter('option_comment_registration', '__return_true');
add_filter('pre_option_comment_moderation', '__return_true');

// Prevenir enumeración de usuarios
add_action('init', function () {
    if (isset($_GET['author']) || preg_match('/\?author=\d/', $_SERVER['REQUEST_URI'])) {
        wp_die('Acceso denegado', 'Error', ['response' => 403]);
    }
});

// Ocultar errores de login para evitar brute force
add_filter('login_errors', '__return_empty_string');


// Evitar peticiones con eval o base64 en la URL
add_action('init', function () {
    $query = $_SERVER['QUERY_STRING'];
    if (strpos($query, 'base64') !== false || strpos($query, 'eval') !== false) {
        wp_die('Solicitud no permitida', 'Seguridad', ['response' => 403]);
    }
});
