// Retrieve slideIndex from localStorage or default to 0 if not found
let slideIndex = localStorage.getItem("slideIndex");
if (slideIndex === null) {
    slideIndex = 0;
} else {
    // Parse the retrieved value from localStorage to integer
    slideIndex = parseInt(slideIndex);
}

// Function to change slide by n positions
function changeSlide(n) {
    showSlides(slideIndex += n);
}

// Function to display slides
function showSlides(n) {
    let i;
    const slides = document.getElementsByClassName("slide");
    
    // Reset slideIndex if it exceeds the number of slides
    if (n >= slides.length) {
        slideIndex = 0;
    }    
    // Reset slideIndex if it goes below 0
    if (n < 0) {
        slideIndex = slides.length - 1;
    }
    
    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    
    // Display the current slide
    slides[slideIndex].style.display = "block";  

    // Save slideIndex to localStorage
    localStorage.setItem("slideIndex", slideIndex);
}

// Show the initial slide
showSlides(slideIndex);
