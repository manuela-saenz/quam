document.addEventListener("DOMContentLoaded", function () {
  const cacheKey = `related_products`;
  const cacheExpiryKey = `related_products_expiry`;
  const now = new Date().getTime();
  const productId = 1196;

  // Verificar si los datos están en localStorage y no han expirado
  const cachedData = localStorage.getItem(cacheKey);
  const cacheExpiry = localStorage.getItem(cacheExpiryKey);

  //Si ya existe en el localStorage cachedData y no ha expirado
  if (cachedData && cacheExpiry && now < parseInt(cacheExpiry)) {
    // Si los datos están en caché y no han expirado, cargarlos directamente
    console.log("Cargando productos relacionados desde caché v2");
    return;
  }

  fetch(ajaxUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "load_related_products",
      product_id: productId,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        localStorage.setItem(cacheKey, data.data);
        localStorage.setItem(cacheExpiryKey, now + 2 * 60 * 60 * 1000); // 2h
      } else {
        console.error(data.data);
      }
    })
    .catch((error) =>
      console.error("Error al cargar productos relacionados:", error)
    );
});
