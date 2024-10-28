// script.js

let slideIndex = 0;

function showSlides() {
    const slides = document.querySelector('.slides');
    const slideImages = document.querySelectorAll('.slides img');
    if (slideIndex >= slideImages.length) {
        slideIndex = 0;
    } 
    if (slideIndex < 0) {
        slideIndex = slideImages.length - 1;
    }
    slides.style.transform = `translateX(${-slideIndex * 100}%)`;
}

function nextSlide() {
    slideIndex++;
    showSlides();
}

function prevSlide() {
    slideIndex--;
    showSlides();
}

// Auto-slide every 5 seconds
setInterval(nextSlide, 5000);
