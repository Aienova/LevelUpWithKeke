let isDragging = false;
let startX;
let translateX = 0;

const carousel = document.getElementById('carousel');
const carouselContainer = document.getElementById('carousel-container');

carousel.addEventListener('mousedown', handleDragStart);
carousel.addEventListener('touchstart', handleDragStart);

document.addEventListener('mousemove', handleDragMove);
document.addEventListener('touchmove', handleDragMove);

document.addEventListener('mouseup', handleDragEnd);
document.addEventListener('touchend', handleDragEnd);

function handleDragStart(e) {
  isDragging = true;
  startX = e.pageX || e.touches[0].pageX;
}

function handleDragMove(e) {
  if (!isDragging) return;

  const currentX = e.pageX || e.touches[0].pageX;
  const diffX = currentX - startX;
  translateX += diffX;

  startX = currentX;

  updateCarouselPosition();
}

function handleDragEnd() {
  isDragging = false;
}

function updateCarouselPosition() {
  carousel.style.transform = `translateX(${translateX}px)`;
}

// Adjust the carousel on window resize
window.addEventListener('resize', () => {
  translateX = 0;
  updateCarouselPosition();
});