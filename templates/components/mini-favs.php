<?php

if (isset($_SESSION["prodsfavs"]) && count($_SESSION["prodsfavs"]) > 0) : ?>
  <ul class="favoritos-lista">
    <?php
    $prodsFavQueryVariation = new WP_Query(array(
      "post_type" => "product_variation",
      "post__in" => $_SESSION["prodsfavs"]
    ));

    $prodsFavQueryProd = new WP_Query(array(
      "post_type" => "product",
      "post__in" => $_SESSION["prodsfavs"]
    ));

    $combined_posts = array_merge($prodsFavQueryVariation->posts, $prodsFavQueryProd->posts);
    foreach ($combined_posts as $prod) :
      $wcProd = wc_get_product($prod);

      $product_name = $wcProd->get_name();
    ?>
      <div class="select-bag d-flex bg-white">
        <div class="img-fit">
          <img src="<?php echo get_the_post_thumbnail_url($prod->ID) ?>" alt="">
        </div>
        <div>
          <h5><?php echo ($wcProd->get_name()); ?> </h5>
          <div class="d-flex align-items-center price">
            <p id="price">$ <?php echo ($wcProd->get_price()); ?></p>
            <!-- <span id="regular_price">$</span>
            <p id="priceUnit" data-price="" hidden> </p> -->
          </div>
        </div>
        <a href="#" id="trash_cart" class="remove" data-id="" data-variant="">
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
    <?php
    endforeach; ?>
  </ul>
<?php else : ?>
  <div class="no-favs-products">
    <h3>No tienes productos favoritos</h3>
  </div>
<?php endif; ?>


<!-- <li class="favorito-item">
        <a href="<?php // esc_url(get_permalink($prod)) 
                  ?>" class="favorito-info">
          <div class="favorito-img img-fit">
            <img src="<?php // get_the_post_thumbnail_url($prod, "thumbnail") 
                      ?>" alt="">
          </div>
          <div>
            <h4><?php // $prod->post_title 
                ?></h4>
            <span><?php // theonem_get_formatted_price($wcProd->get_price())  
                  ?></span>
          </div>
        </a>
        <button class="borrar-favorito" data-prodid="<?php // $prod->ID 
                                                      ?>"><i class="icon-trash"></i></button>
      </li> -->