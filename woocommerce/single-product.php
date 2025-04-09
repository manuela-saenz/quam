<?php
get_header();

global $post;
$product = wc_get_product($post);
$categories = get_the_terms($product->get_id(), 'product_cat');
$category = $categories[0]->name;
$terms = get_the_terms($post->ID, 'product_cat');
$produts_use = get_the_terms($post->ID, 'product_tag');

$attachment_ids = $product->get_gallery_image_ids();


$attributes = $product->get_attributes();
if ($attachment_ids) {
  foreach ($attachment_ids as $attachment_id) {
    $images[] = wp_get_attachment_image_url($attachment_id, "large");
  };
}

// echo '<pre>';
// print_r($product);
// echo '<pre>';
// Iterar sobre cada atributo

?>

<div id="showAlertAddCart" class="alert alert-success add-to-cart-message d-none" style="position: fixed;z-index: 60;top: 110px;left: 50%;transform: translateX(-50%);">Producto agregado al carrito.
</div>
<div id="showAlertAddFav" class="alert alert-success add-to-list-fav-message d-none" style="position: fixed;z-index: 60;top: 110px;left: 50%;transform: translateX(-50%);">Lista de productos favoritos
  actualizada correctamente.</div>
<div id="showAlertDeleteFav" class="alert alert-danger add-to-list-fav-message d-none" style="position: fixed;z-index: 60;top: 110px;left: 50%;transform: translateX(-50%);">Se eliminó el producto de tus
  favoritos</div>
<!-- <div id="showAlertItemOut" class="alert alert-danger add-to-list-fav-message d-none" style="position: fixed;z-index: 9999;top: 110px;left: 50%;transform: translateX(-50%);">El producto seleccionado se encuentra agotado</div> -->
<section id="Singleimgprincipal" class="pt-0">
  <div class="py-2 px-2 border-top border-bottom">
    <div class="container">
      <?php woocommerce_breadcrumb() ?>
    </div>
  </div>
  <div class="container">
    <?php woocommerce_content(); ?>
  </div>
</section>

<div class="sm-floating-box swipe-animation">
  <div id="box-draggable2">
    <div class="bg-white mobile-container">
      <div class="main-box d-lg-none p-3 py-4">
        <div class="d-flex justify-content-between mb-2">
          <div class="">
            <h1 class="section-subtitle mb-1"><?= $post->post_title ?></h1>
            <div class="d-flex align-items-center price">
              <?= $product->get_price_html() ?>
            </div>
          </div>
          <button class="button-heart add-fav" data-product-id="0" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
            </svg>
          </button>
        </div>
        <button id="btn-single-mobile" class="quam-btn red d-lg-none open-selector w-100 sm-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Agregar al carrito</button>

      </div>
      <div class="d-md-none container">
        <p> <?= $product->get_short_description() ?></p>
      </div>
      <section class="characteristics">
        <div class="container">
          <?php woocommerce_output_product_data_tabs() ?>
        </div>
      </section>
      <?php //woocommerce_output_related_products() 
      ?>
      <section id="related-products-section" class="overflow-hidden">
        <div class="container">
          <h2>Productos relacionados</h2>
          <div id="related-products-container">
            <!-- Los productos relacionados se cargarán aquí -->
            <div class="preview row">
              <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="col-lg-3 col-sm-6 col-6 product type-product post-146 status-publish first outofstock has-post-thumbnail shipping-taxable purchasable product-type-variation loading" data-id="toastCardLoad">
                  <div class="CardProducts w-100 placeholder-glow">
                    <div class="img-contain placeholder w-100"></div>
                    <div class="info-highlights opacity-25">
                      <h5 class="col-12 placeholder md-2"></h5>
                      <div class="d-flex align-items-lg-center align-items-start flex-column flex-sm-row">
                        <p class="mb-0 d-flex gap-2 placeholder col-6"></p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endfor ?>
            </div>
          </div>
        </div>

      </section>

      <section class=" d-md-none">
        <?php itemsFooter() ?>
      </section>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      var swatch = event.target.closest('.cfvsw-swatches-disabled');
      if (swatch) {
        var alertElement = document.getElementById('showAlertItemOut');
        alertElement.classList.remove('d-none');
        setTimeout(function() {
          alertElement.classList.add('d-none');
        }, 3000);
      }
    });
  });
</script>

<script>
 function initAddToFavoriteButtonSlider() {
    $(".add-fav").on("click", function(e) {
      e.preventDefault();

      $(this).addClass("adding");
      const getAtributeData = null
      let productId = null;

      const relatedSwiper = document.getElementById("related-swiper");
      if (relatedSwiper) {
        const slides = relatedSwiper.querySelectorAll(".swiper-slide");
        const myButton = this;
        const getAtributeData = myButton.getAttribute("data-product-id-slide");
        myButton.classList.add("active-fav");
        productId = getAtributeData;
      } 
      console.log(productId )
      var sessionFav = JSON.parse(localStorage.getItem("sessionFav")) || [];

      $.ajax({
        url: ajaxUrl,
        method: "POST",
        data: {
          action: "add_product_to_favorites",
          prodid: productId,
        },
        success: function(res) {
          $(".add-fav").removeClass("adding");

          if (!sessionFav.includes(Number(productId))) {
            sessionFav.push(Number(productId));
            localStorage.setItem("sessionFav", JSON.stringify(sessionFav));
          } else {
            deleteFavoriteSameContext(productId);
            var alertElement = $("#showAlertDeleteFav");
            alertElement.removeClass("d-none").show();

            setTimeout(function() {
              alertElement.hide().addClass("d-none");
            }, 2200);
            return;
          }

          var spanElement = document.getElementById("favoritesCounter");

          if (!spanElement) {
            spanElement = document.createElement("span");
            spanElement.id = "favoritesCounter";
            spanElement.className =
              "cart-section-quantity rounded-pill position-absolute center-all text-white";
            spanElement.textContent = "";
            botonFav.appendChild(spanElement);
          }

          $("#favoritesCounter").text(res.counter).removeClass("d-none");
          $(".offcanvas-body.ordenListFav.fav").html(res.html);
          var alertElement = $("#showAlertAddFav");
          alertElement.removeClass("d-none").show();

          setTimeout(function() {
            alertElement.hide().addClass("d-none");
          }, 2200);
        },
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    const productId = <?= $product->get_id(); ?>;
    const cacheKey = `related_products`;
    const cacheExpiryKey = `related_products_expiry`;
    const now = new Date().getTime();

    // Verificar si los datos están en localStorage y no han expirado
    const cachedData = localStorage.getItem(cacheKey);
    const cacheExpiry = localStorage.getItem(cacheExpiryKey);

    if (cachedData && cacheExpiry && now < parseInt(cacheExpiry)) {
      // Si los datos están en caché y no han expirado, cargarlos directamente
      document.getElementById('related-products-container').innerHTML = cachedData;
      console.log("Cargando productos relacionados desde caché v2");
      setTimeout(() => {
        relatedSliderswiper.init();
        initAddToFavoriteButtonSlider();
      }, 200);
      productColorVariants();
    } else {
      // Si no hay datos en caché o han expirado, realizar la solicitud AJAX
      fetch("<?= admin_url('admin-ajax.php'); ?>", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            action: "load_related_products",
            product_id: productId,
          }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Guardar la respuesta en localStorage
            localStorage.setItem(cacheKey, data.data);
            localStorage.setItem(cacheExpiryKey, now + 2 * 60 * 60 * 1000); // 2 horas en milisegundos

            // Cargar los productos relacionados en el contenedor
            document.getElementById('related-products-container').innerHTML = data.data;
            relatedSliderswiper.init();
            initAddToFavoriteButtonSlider();
            productColorVariants();
          } else {
            console.error(data.data);
          }
        })
        .catch(error => console.error('Error al cargar productos relacionados:', error));
    }
  });
</script>
<?php get_footer() ?>