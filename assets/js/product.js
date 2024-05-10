const elemento = document.querySelector('#box-draggable');
const mainBox = document.querySelector('.main-box');
const contenedorContenido = document.querySelector('.mobile-container');
const mainBoxHeight = mainBox.offsetHeight + 48;
const wh = window.innerHeight - (80 + mainBoxHeight);

let contentScrollable = false;
let inicioY = 0;
let isUp = false;

var waitToScroll;
var waitToInit;

function initDragBox() {
  elemento.addEventListener('touchstart', iniciarToque, false);
  elemento.addEventListener('touchmove', moverToque, false);
  elemento.addEventListener('touchend', terminarToque, false);
}
function disableDragBox() {
  elemento.removeEventListener('touchstart', iniciarToque, false);
  elemento.removeEventListener('touchmove', moverToque, false);
  elemento.removeEventListener('touchend', terminarToque, false);
}


$(window).on('load resize', function () {
  if ($(window).width() <= 991) {
    if (!contentScrollable) {
      elemento.style.marginTop = `-${mainBoxHeight}px`;
      initDragBox();
    }
    $('.mobile-container').scrollTop(1)
  } 
})

function scrollEnable() {
  if (contentScrollable) {
    let initscroll = false;
    console.log('initscroll', initscroll)
    $('.mobile-container').on('touchstart', function () {
      initscroll = true;
      console.log('initscroll', initscroll)
    });

    $('.mobile-container').on('touchmove', function (e) {
      clearTimeout(waitToInit);
      console.log('estado de scroll dentro de caja', e.currentTarget.scrollTop)
      if (e.currentTarget.scrollTop == 0) {
        contentScrollable = false;
        console.log('apagar')
        initDragBox();

      } else {
        contentScrollable = true;
        console.log('prender')
        disableDragBox();
      }

    })

  }
}



function positionDownIdentifier(deltaY) {
  if (deltaY <= -30) {
    elemento.style.transform = `translateY(-${wh}px)`;
    isUp = true;
    contentScrollable = true;
    console.log('se puede hacer scroll')
    scrollEnable()
    setTimeout(() => {
      $('.mobile-container').scrollTop(1)
    }, 500)
  } else {
    isUp = false;
    elemento.style.transform = `translateY(0px)`;
  }

}

function positionTopIdentifier(deltaY) {
  if (deltaY >= 30) {
    isUp = false;
    elemento.style.transform = `translateY(0px)`;
  } else {
    isUp = true;
    elemento.style.transform = `translateY(-${wh}px)`;
  }
}

function iniciarToque(evento) {
  const toque = evento.touches[0];
  inicioY = toque.clientY;
  clearTimeout(waitToScroll);
  console.log('estado de scroll', contentScrollable)
}

function moverToque(evento) {

  evento.preventDefault();
  const toque = evento.touches[0];
  const movingDeltaY = toque.clientY - inicioY;
  contentScrollable = false;
  scrollEnable();
  if (isUp) {
    elemento.style.transform = `translateY(${movingDeltaY + wh * -1}px)`;
  } else {
    elemento.style.transform = `translateY(${movingDeltaY}px)`;
  }
  console.log('estado de scroll', contentScrollable)
}

function terminarToque(evento) {
  const toque = evento.changedTouches[0];
  const deltaY = toque.clientY - inicioY;
  if (isUp) {
    positionTopIdentifier(deltaY);
  } else {
    positionDownIdentifier(deltaY);
  }
}


// $(document).ready(function () {
    

//   // Obtener el elemento del pie de página
//   var footer = document.getElementById('footer');

//   // Variables para almacenar la posición inicial del toque y la posición del pie de página
//   var startY, endY;
//   var startHeight = 0;
//   var scrollable;

//   // Establecer una altura mínima para el pie de página
//   var minHeight = 100;

//   handleResize();

//   // Agregar un listener para el evento touchstart en el pie de página
//   footer.addEventListener('touchstart', function (event) {
//       // Obtener la posición inicial del toque
//       startY = event.touches[0].clientY;
//       // Obtener la altura inicial del pie de página
//       startHeight = footer.offsetHeight;

//       // Habilitar el drag sólo si no tiene scroll la página
//       scrollable = footer.scrollTop === 0;
//   });

//   // Agregar un listener para el evento touchmove en el pie de página
//   footer.addEventListener('touchmove', function (event) {
//       // Calcular la distancia del desplazamiento vertical
//       var deltaY = event.touches[0].clientY - startY;

//       if (!footer.classList.contains('expanded') || (scrollable && deltaY >= 0)) {
//           // Calcular la nueva altura del pie de página
//           var newHeight = startHeight - deltaY;

//           // Actualizar la altura del pie de página si es mayor que la altura mínima y menor que la altura máxima
//           if (newHeight > minHeight && newHeight < getFooterHeight()) {
//               footer.style.height = newHeight + 'px';
//           }

//           // Evitar el desplazamiento predeterminado del documento
//           event.preventDefault();

//       }
//   });

//   footer.addEventListener('touchend', function (e) {
//       if(scrollable && footer.scrollTop === 0){
//           endY = e.changedTouches[0].clientY;

//           // Tolerancia para cambio de modo
//           var delta = 45;
//           if(!footer.classList.contains('expanded')){
//               delta *= -1;
//           }


//           if(endY-startY < delta){
//               footer.style.height = getFooterHeight() + 'px';
//               footer.classList.add('expanded');
//           } else {
//               footer.style.height = '';
//               footer.classList.remove('expanded');
//               console.log('collapsed');
//           }
//       }
//   });

//   function getFooterHeight(){
//       return window.innerHeight - document.getElementsByTagName('header').offsetHeight;
//   }


//   // Función para manejar el evento resize
//   function handleResize() {
//       // Obtener el nuevo valor de window.innerHeight
//       var contentHeight = window.innerHeight-document.getElementsByTagName('header').offsetHeight-100;
//       document.getElementById('content').style.height = contentHeight + 'px';
//   }
  
//   // Agregar un listener para el evento resize
//   window.addEventListener('resize', handleResize);
    
// });
