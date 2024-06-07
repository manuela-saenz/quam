$(document).ready(function () {
  // Obtener el elemento del pie de página
  var footer = document.querySelector('.sm-floating-box');
  //console.log('footer', footer);

  // Variables para almacenar la posición inicial del toque y la posición del pie de página
  var startY, endY;
  var startHeight = 0;
  var scrollable;

  // Establecer una altura mínima para el pie de página
  var minHeight = 150;

  handleResize();

  // Agregar un listener para el evento touchstart en el pie de página
  footer.addEventListener('touchstart', function (event) {
      // Obtener la posición inicial del toque
      startY = event.touches[0].clientY;
      // Obtener la altura inicial del pie de página
      startHeight = footer.offsetHeight;

      // Habilitar el drag sólo si no tiene scroll la página
      scrollable = footer.scrollTop === 0;
  });

  // Agregar un listener para el evento touchmove en el pie de página
  footer.addEventListener('touchmove', function (event) {
      // Calcular la distancia del desplazamiento vertical
      var deltaY = event.touches[0].clientY - startY;

      if (!footer.classList.contains('expanded') || (scrollable && deltaY >= 0)) {
          // Calcular la nueva altura del pie de página
          var newHeight = startHeight - deltaY;

          // Actualizar la altura del pie de página si es mayor que la altura mínima y menor que la altura máxima
          if (newHeight > minHeight && newHeight < getFooterHeight()) {
              footer.style.height = newHeight + 'px';
          }

          // Evitar el desplazamiento predeterminado del documento
          event.preventDefault();

      }
  });

  footer.addEventListener('touchend', function (e) {
      if(scrollable && footer.scrollTop === 0){
          endY = e.changedTouches[0].clientY;

          // Tolerancia para cambio de modo
          var delta = 45;
          if(!footer.classList.contains('expanded')){
              delta *= -1;
          }


          if(endY-startY < delta){
              footer.style.height = getFooterHeight() + 'px';
              footer.classList.add('expanded');
          } else {
              footer.style.height = '';
              footer.classList.remove('expanded');
              console.log('collapsed');
          }
      }
  });

  function getFooterHeight(){
      return window.innerHeight - document.querySelector('header').offsetHeight;
  }


  // Función para manejar el evento resize
  function handleResize() {
      // Obtener el nuevo valor de window.innerHeight
      var contentHeight = window.innerHeight-document.querySelector('header').offsetHeight-150;
      if(window.innerWidth < 991){
          document.getElementById('Singleimgprincipal').style.height = contentHeight + 'px';
      } else {
          document.getElementById('Singleimgprincipal').style.height = 'unset';
      }

  }
  
  // Agregar un listener para el evento resize
  window.addEventListener('resize', handleResize);
    
});


// compartir productos
// facebook
document.getElementById('shareBtnFacebook').addEventListener('click', function() {
    console.log('clic');
    const currentUrl = window.location.href;
    const encodedUrl = encodeURIComponent(currentUrl);
    
    const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
    console.log(facebookShareUrl);
    window.open(facebookShareUrl, '_blank');
  });
//   whatsapp
document.getElementById('shareBtnWhatsapp').addEventListener('click', function() {
    // Obtener la URL actual de la página
    const currentUrl = window.location.href;

    // Codificar la URL
    const encodedUrl = encodeURIComponent(currentUrl);

    // Crear el enlace para compartir en WhatsApp
    const whatsappShareUrl = `https://web.whatsapp.com/send?text=Mira%20este%20art%C3%ADculo%20que%20he%20encontrado:%20${encodedUrl}`;

    // Abrir la ventana de compartir en WhatsApp
    window.open(whatsappShareUrl, '_blank');
});