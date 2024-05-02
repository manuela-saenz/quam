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

elemento.style.marginTop = `-${mainBoxHeight}px`;

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
