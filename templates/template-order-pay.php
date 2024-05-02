<?php
/**
 * Template Name: Order pay
 */

//  require_once('../../wp-load.php');
 get_header();
 
 ?>
 
 <section id="bag" class="  h-100">
   <div class="container position-relative">
     
 
     <?php 
    //  $data = new WC_Order($order_id);
     echo do_shortcode('[woocommerce_checkout]');
    //  wc_get_order();
     ?>
   </div>
 </section>

 <?php  get_footer(); ?>
 