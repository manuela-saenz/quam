document.addEventListener("DOMContentLoaded", function () {
    console.log('test desde aqui')
    // Selecciona el contenedor que deseas observar
    const targetNode = document.querySelector(".offcanvas-body.ordenList.cart");
  
    if (!targetNode) {
      console.error("El contenedor no se encontró.");
      return;
    }
  
    // Obtener todos los li, tanto directos como dentro de swiper-slide
    const getAllProductItems = () => {
      const productList = document.querySelector("#product-list");
      const directItems = productList
        ? Array.from(productList.querySelectorAll("li"))
        : [];
      const swiperItems = document.querySelectorAll(
        "#related-swiper .swiper-wrapper .swiper-slide li"
      );
      return [...directItems, ...swiperItems];
    };
  
    // Configuración del observer
    const observer = new MutationObserver((mutationsList) => {
      for (const mutation of mutationsList) {
        if (mutation.type === "childList" && mutation.addedNodes.length > 0) {
          // Busca el primer div con la clase "mini-cart-product-card"
          const firstProductCard = targetNode.querySelector(
            ".mini-cart-product-card"
          );
          console.log(firstProductCard);
          if (firstProductCard) {
            // Extrae el precio del elemento con ID "price"
            const priceElement = firstProductCard.querySelector(
              "#price"
            );
  
            const detectedPrice = priceElement
              ? priceElement.textContent.trim()
              : null;
  
            // Obtener todos los items de producto actualizados
            const allProductItems = getAllProductItems();
  
            allProductItems.forEach((productItem) => {
              const cardProduct = productItem.querySelector(".CardProducts");
              if (!cardProduct) return; // Skip si no tiene CardProducts
  
              const infoHighlights =
                cardProduct.querySelector("#info-highlights");
              if (!infoHighlights) return; 
  
              const priceSpan = infoHighlights.querySelector(
                ".price .woocommerce-Price-amount"
              );
              if (!priceSpan) return; // Skip si no tiene el elemento de precio
  
              const existingIns = priceSpan.parentNode.querySelector("ins");
  
              if (detectedPrice) {
                if (!existingIns) {
                  // Agrega el nuevo <ins> después del último <span>
                  priceSpan.insertAdjacentHTML(
                    "beforeend",
                    `<ins class="offer-price" aria-hidden="true" style="display: inline-block; margin-left: 5px;">
                        <span class="woocommerce-Price-amount amount">
                          <bdi><span class="woocommerce-Price-currencySymbol"></span>${detectedPrice}</bdi>
                        </span>
                      </ins>`
                  );
                } else {
                  // Si ya existe, actualiza el contenido del <ins>
                  existingIns.querySelector(
                    ".woocommerce-Price-amount bdi"
                  ).innerHTML = `
                      <span class="woocommerce-Price-currencySymbol"></span>&nbsp;${detectedPrice}
                    `;
                }
              } else if (existingIns) {
                // Si no se detecta ningún precio, elimina el <ins> existente
                existingIns.remove();
              }
            });
          }
        }
      }
    });
  
    // Opciones del observer
    const config = { childList: true, subtree: true };
  
    // Inicia el observer
    observer.observe(targetNode, config);
  });