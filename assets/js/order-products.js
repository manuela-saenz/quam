document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname === "/") return; // Evita que se ejecute en la ruta raíz
  const productList = document.getElementById("product-list");
  if (!productList) return;

  // Array para almacenar los elementos duplicados
  const duplicates = [];

  function filterUniqueProducts() {
    const items = Array.from(productList.querySelectorAll("li[data-father]"));
    if (items.length < 2) return;

    const seenFathers = new Set();

    items.forEach((item) => {
      const currentFather = item.getAttribute("data-father");

      if (seenFathers.has(currentFather)) {
        // Si el `data-father` ya fue visto, elimina el elemento del DOM y guárdalo en el array de duplicados
        duplicates.push(item);
        item.remove();
      } else {
        // Si no fue visto, agrégalo al conjunto
        seenFathers.add(currentFather);
      }
    });
    productList.classList.add("ready");
    const path = window.location.pathname; // Obtiene el pathname completo
    const segments = path.split("/"); // Divide el pathname en partes usando "/"
    const lastSegment = segments.filter(Boolean).pop(); // Obtiene el último segmento no vacío

    if (lastSegment == "hombre") {
      let productCount = 32; // Cambia el valor según sea necesario
      if (seenFathers.size >= parseInt(productCount ) - 2) {
        // Desconecta temporalmente el observer para evitar el bucle infinito
       

        // Reorganiza los duplicados para evitar consecutivos con el mismo `data-father`
        const reorderedDuplicates = reorderDuplicates(duplicates);

        // Inserta los duplicados reorganizados en el contenedor
        reorderedDuplicates.forEach((duplicate) => {
          productList.appendChild(duplicate);
        });

        // Inicializa la función después de mover los elementos
        observer.disconnect();
      }
    } else {
      if (seenFathers.size >= parseInt(9)) {
        // Reorganiza los duplicados para evitar consecutivos con el mismo `data-father`
        const reorderedDuplicates = reorderDuplicates(duplicates);

        // Inserta los duplicados reorganizados en el contenedor
        reorderedDuplicates.forEach((duplicate) => {
          productList.appendChild(duplicate);
        });

        observer.disconnect();
      }
    }

    // Función para reorganizar los duplicados y evitar consecutivos con el mismo `data-father`
    function reorderDuplicates(duplicates) {
      const reordered = [];
      const seenFathers = new Set();

      duplicates.forEach((duplicate) => {
        const father = duplicate.getAttribute("data-father");
      
        // Si el último elemento agregado tiene el mismo `data-father`, busca un lugar diferente
        if (
          reordered.length > 0 &&
          reordered[reordered.length - 1].getAttribute("data-father") === father
        ) {
          // Encuentra el primer lugar donde el `data-father` sea diferente
          let inserted = false;
          for (let i = 0; i < reordered.length; i++) {
            if (
              reordered[i].getAttribute("data-father") !== father &&
              (!reordered[i + 1] || reordered[i + 1].getAttribute("data-father") !== father)
            ) {
              // Inserta el duplicado en el lugar adecuado
              reordered.splice(i + 1, 0, duplicate);
              inserted = true;
              break;
            }
          }
      
          // Si no se encontró un lugar adecuado, agrégalo al final
          if (!inserted) {
            reordered.push(duplicate);
          }
        } else {
          // Si no hay conflicto, agrégalo al final
          reordered.push(duplicate);
        }
      });
      
      // Validación adicional para garantizar que no haya consecutivos con el mismo `data-father`
      for (let i = 0; i < reordered.length - 1; i++) {
        if (reordered[i].getAttribute("data-father") === reordered[i + 1].getAttribute("data-father")) {
          // Encuentra un lugar más adelante donde el `data-father` sea diferente
          const swapIndex = reordered.findIndex(
            (item, index) => index > i + 1 && item.getAttribute("data-father") !== reordered[i].getAttribute("data-father")
          );
      
          if (swapIndex !== -1) {
            // Intercambia los elementos para evitar consecutivos
            const [itemToMove] = reordered.splice(swapIndex, 1);
            reordered.splice(i + 1, 0, itemToMove);
          }
        }
      }

      return reordered;
    }
  }

  const observer = new MutationObserver(() => {
    filterUniqueProducts(); // Llama a la función cada vez que se detecta un cambio
  });

  const config = {
    childList: true, // Observa cambios en los hijos directos
    subtree: true, // Observa cambios en todos los descendientes
  };

  // Inicia el observer
  observer.observe(productList, config);

  // Llama a la función inicialmente para filtrar los productos al cargar la página
  filterUniqueProducts();
});


document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname === "/") return;

  const productList = document.getElementById("product-list");
  if (!productList) return;

  // Detecta parámetros de búsqueda o filtros en la URL
  const urlParams = new URLSearchParams(window.location.search);
  const hasSearch = urlParams.has('s');
  const hasFilter = Array.from(urlParams.keys()).some(key => key.startsWith('filter_'));

  // Si hay búsqueda o filtros, agrega la clase ready
  if (hasSearch || hasFilter) {
    productList.classList.add("ready");
    return; // Detiene la ejecución del resto del código
  }
});