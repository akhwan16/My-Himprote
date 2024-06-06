let slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slides");
    let choiceItems = document.getElementsByClassName("choice-item");
    
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    
    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }
    for (i = 0; i < choiceItems.length; i++) {
        choiceItems[i].classList.remove("active");
    }
    slides[slideIndex-1].classList.add("active");
    choiceItems[slideIndex-1].classList.add("active");
}
