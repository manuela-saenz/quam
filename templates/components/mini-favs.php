<?php 

if (isset($_SESSION["prodsfavs"]) && count($_SESSION["prodsfavs"]) > 0) : ?>
  <ul class="favoritos-lista">
    <?php
    var_dump($_SESSION["prodsfavs"]);
    $prodsFavQuery = new WP_Query(array(
      "post_type" => "product",
      "post__in" => $_SESSION["prodsfavs"]
    ));
    foreach ($prodsFavQuery->posts as $prod) :
      $wcProd = wc_get_product($prod);
      ?>
        <!-- <pre style="height:400px; width:200px">
        <?php print_r( $wcProd) ?>
      </pre> -->
      <?php
      productCardSmall($wcProd, true);
    endforeach; ?>
  </ul>
<?php else : ?>
  <div class="no-favs-products">
    <h3>No tienes productos favoritos</h3>
  </div>
<?php endif; ?>


<!-- <li class="favorito-item">
        <a href="<?php // esc_url(get_permalink($prod)) ?>" class="favorito-info">
          <div class="favorito-img img-fit">
            <img src="<?php // get_the_post_thumbnail_url($prod, "thumbnail") ?>" alt="">
          </div>
          <div>
            <h4><?php // $prod->post_title ?></h4>
            <span><?php // theonem_get_formatted_price($wcProd->get_price())  ?></span>
          </div>
        </a>
        <button class="borrar-favorito" data-prodid="<?php // $prod->ID ?>"><i class="icon-trash"></i></button>
      </li> -->