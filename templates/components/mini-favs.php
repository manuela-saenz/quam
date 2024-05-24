<?php

if (isset($_SESSION["prodsfavs"]) && count($_SESSION["prodsfavs"]) > 0) : ?>
  <div id="favList">
    <?php

    if (isset($_SESSION["prodsfavs"])) {
      echo '<script type="text/javascript">';
      foreach ($_SESSION["prodsfavs"] as $key => $value) {
        $numValue = intval($value); 
        echo "var sessionFav = localStorage.getItem('sessionFav');";
        echo "if (sessionFav.indexOf('{$numValue}') === -1) {";
        echo "delete localStorage.sessionFav['{$numValue}'];";
        echo "}";
      }
      echo '</script>';
    }

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
      <div class="mini-cart-product-card d-flex align-items-start bg-white fav">
        <a href="<?= get_permalink($prod->ID) ?>" class="img-contain">
          <img src="<?php echo get_the_post_thumbnail_url($prod->ID) ?>" alt="">
        </a>
        <div>
          <h5> <a href="<?= get_permalink($prod->ID) ?>"><?php echo ($wcProd->get_name()); ?> </a></h5>
          <div class="d-flex align-items-center priceFav mb-3">
            <p id="priceFav"><?= $wcProd->get_price_html() ?> COP</p>
          </div>
          <div class="d-flex justify-content-end">
            <button id="trash_fav" data-id="<?php echo ($prod->ID) ?>">
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
    endforeach; ?>
  </div>

<?php else : ?>
  <div class="no-favs-products text-center center-all text-center p-4 h-100">
  </div>
<?php endif; ?>