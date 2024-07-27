// JavaScript para manejar el carrusel
const prevButton = document.querySelector('.carousel-button.prev');
const nextButton = document.querySelector('.carousel-button.next');
const carouselImages = document.querySelector('.carousel-images');
let index = 0;

function updateCarousel() {
    const totalImages = document.querySelectorAll('.carousel-images img').length;
    const width = document.querySelector('.carousel').offsetWidth;
    carouselImages.style.transform = `translateX(${-index * width}px)`;
}

nextButton.addEventListener('click', () => {
    const totalImages = document.querySelectorAll('.carousel-images img').length;
    index = (index + 1) % totalImages;
    updateCarousel();
});

prevButton.addEventListener('click', () => {
    const totalImages = document.querySelectorAll('.carousel-images img').length;
    index = (index - 1 + totalImages) % totalImages;
    updateCarousel();
});

// Inicializar el carrusel
updateCarousel();
window.addEventListener('resize', updateCarousel);

/* confirmar para borrar prenda */
function confirmarBorrado() {
    return confirm("¿Está seguro que desea borrar este registro?");
}


