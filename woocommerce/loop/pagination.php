<?php

/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if (!defined('ABSPATH')) {
    exit;
}

// Obtener total de páginas de manera manual si es necesario
$total_posts    = wc_get_loop_prop('total');
$posts_per_page = wc_get_loop_prop('per_page');

if ($total_posts && $posts_per_page) {
    $total = ceil($total_posts / $posts_per_page);
} else {
    $total = wc_get_loop_prop('total_pages', 1);
}

$current = wc_get_loop_prop('current_page', 1);
$base    = esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
$format  = '';

if ($total <= 1) {
    return;
}

?>
<nav aria-label="Page navigation example" style="padding-top: 30px;">
    <ul class="pagination mx-auto center-all">
        <?php
        $prev_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M5 12l4 4"/><path d="M5 12l4 -4"/></svg>';
        $next_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0"/><path d="M15 16l4 -4"/><path d="M15 8l4 4"/></svg>';

        $pagination_links = paginate_links(
            apply_filters(
                'woocommerce_pagination_args',
                array(
                    'base'      => $base,
                    'format'    => $format,
                    'add_args'  => false,
                    'current'   => max(1, $current),
                    'total'     => $total,
                    'prev_text' => $prev_svg,
                    'next_text' => $next_svg,
                    'type'      => 'array',
                    'end_size'  => 2,
                    'mid_size'  => 2,
                )
            )
        );

        if (!empty($pagination_links) && is_array($pagination_links)) {
            foreach ($pagination_links as $link) {
                $class = strpos($link, 'current') !== false ? 'page-item active' : 'page-item';
                $link = str_replace(array('page-numbers', '<span', '</span>'), array('page-link', '<a', '</a>'), $link);
                echo '<li class="' . esc_attr($class) . '">' . $link . '</li>';
            }
        }
        ?>
    </ul>
</nav>
