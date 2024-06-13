document.addEventListener("DOMContentLoaded", function() {
    // Tombol untuk membuka popup
    var openPopupBtn1 = document.getElementById("openPopupBtn1");
    var openPopupBtn2 = document.getElementById("openPopupBtn2");

    // Elemen popup
    var popup1 = document.getElementById("popup1");
    var popup2 = document.getElementById("popup2");
  
    // Tombol untuk menutup popup
    var closePopupBtn1 = document.getElementById("closePopupBtn1");
    var closePopupBtn2 = document.getElementById("closePopupBtn2");

    // Event untuk membuka popup 1
    openPopupBtn1.onclick = function() {
        popup1.style.display = "block";
    };

    // Event untuk menutup popup 1
    closePopupBtn1.onclick = function() {
        popup1.style.display = "none";
    };

    // Event untuk membuka popup 2
    openPopupBtn2.onclick = function() {
        popup2.style.display = "block";
    };

    // Event untuk menutup popup 2
    closePopupBtn2.onclick = function() {
        popup2.style.display = "none";
    };

    // Event untuk menutup popup ketika mengklik di luar area popup
    window.onclick = function(event) {
        if (event.target == popup1) {
            popup1.style.display = "none";
        }
        if (event.target == popup2) {
            popup2.style.display = "none";
        }
    };
});
