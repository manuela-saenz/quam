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
      <li class="favorito-item">
        <a href="<?= esc_url(get_permalink($prod)) ?>" class="favorito-info">
          <div class="favorito-img img-fit">
            <img src="<?= get_the_post_thumbnail_url($prod, "thumbnail") ?>" alt="">
          </div>
          <div>
            <h4><?= $prod->post_title ?></h4>
            <span><?= theonem_get_formatted_price($wcProd->get_price())  ?></span>
          </div>
        </a>
        <button class="borrar-favorito" data-prodid="<?= $prod->ID ?>"><i class="icon-trash"></i></button>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else : ?>
  <div class="no-favs-products">
    <h3>No tienes productos favoritos</h3>
  </div>
<?php endif; ?>