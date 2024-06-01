let slideIndex = 0;
const slidesToShow = 4;
const progjaList = document.querySelector('.progja-list');
const slides = document.querySelectorAll('.progja');
const totalSlides = slides.length;
const totalPages = Math.ceil(totalSlides / slidesToShow);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n - 1);
}

function showSlides(n) {
    if (n >= totalPages) slideIndex = 0;
    if (n < 0) slideIndex = totalPages - 1;

    const transformValue = -slideIndex * 100;
    progjaList.style.transform = `translateX(${transformValue}%)`;

    document.querySelectorAll('.dot').forEach((dot, index) => {
        dot.className = dot.className.replace(" active", "");
        if (index === slideIndex) dot.className += " active";
    });

    document.querySelector('.prev').style.display = slideIndex > 0 ? 'block' : 'none';
    document.querySelector('.next').style.display = slideIndex < totalPages - 1 ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('.next').style.display = totalPages > 1 ? 'block' : 'none';
    document.querySelector('.prev').style.display = 'none';
    document.querySelectorAll('.dot').forEach((dot, index) => {
        dot.style.display = index < totalPages ? 'inline-block' : 'none';
    });

    showSlides(slideIndex);
});
