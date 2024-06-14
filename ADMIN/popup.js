document.addEventListener("DOMContentLoaded", function() {
    // Tombol untuk membuka popup
    var openPopupBtn1 = document.getElementById("openPopupBtn1");
    var openPopupBtn2 = document.getElementById("openPopupBtn2");
    var openPopupBtn3 = document.getElementById("openPopupBtn3");
    var openPopupBtn6 = document.getElementById("openPopupBtn6");
    var openPopupBtn7 = document.getElementById("openPopupBtn7");
    var openPopupBtn8 = document.getElementById("openPopupBtn8");
    var openPopupBtn9 = document.getElementById("openPopupBtn9"); // Tombol untuk membuka popup ke-9

    // Elemen popup
    var popup1 = document.getElementById("popup1");
    var popup2 = document.getElementById("popup2");
    var popup3 = document.getElementById("popup3");
    var popup6 = document.getElementById("popup6");
    var popup7 = document.getElementById("popup7");
    var popup8 = document.getElementById("popup8");
    var popup9 = document.getElementById("popup9"); // Elemen popup ke-9

    // Tombol untuk menutup popup
    var closePopupBtn1 = document.getElementById("closePopupBtn1");
    var closePopupBtn2 = document.getElementById("closePopupBtn2");
    var closePopupBtn3 = document.getElementById("closePopupBtn3");
    var closePopupBtn6 = document.getElementById("closePopupBtn6");
    var closePopupBtn7 = document.getElementById("closePopupBtn7");
    var closePopupBtn8 = document.getElementById("closePopupBtn8");
    var closePopupBtn9 = document.getElementById("closePopupBtn9"); // Tombol untuk menutup popup ke-9

    // Event untuk membuka popup 1
    if (openPopupBtn1 && popup1) {
        openPopupBtn1.onclick = function() {
            popup1.style.display = "block";
        };
    }

    // Event untuk menutup popup 1
    if (closePopupBtn1 && popup1) {
        closePopupBtn1.onclick = function() {
            popup1.style.display = "none";
        };
    }

    // Event untuk membuka popup 2
    if (openPopupBtn2 && popup2) {
        openPopupBtn2.onclick = function() {
            popup2.style.display = "block";
        };
    }

    // Event untuk menutup popup 2
    if (closePopupBtn2 && popup2) {
        closePopupBtn2.onclick = function() {
            popup2.style.display = "none";
        };
    }

    // Event untuk membuka popup 3
    if (openPopupBtn3 && popup3) {
        openPopupBtn3.onclick = function() {
            popup3.style.display = "block";
        };
    }

    // Event untuk menutup popup 3
    if (closePopupBtn3 && popup3) {
        closePopupBtn3.onclick = function() {
            popup3.style.display = "none";
        };
    }

    // Event untuk membuka popup 6
    if (openPopupBtn6 && popup6) {
        openPopupBtn6.onclick = function() {
            popup6.style.display = "block";
        };
    }

    // Event untuk menutup popup 6
    if (closePopupBtn6 && popup6) {
        closePopupBtn6.onclick = function() {
            popup6.style.display = "none";
        };
    }

    // Event untuk membuka popup 7
    if (openPopupBtn7 && popup7) {
        openPopupBtn7.onclick = function() {
            popup7.style.display = "block";
        };
    }

    // Event untuk menutup popup 7
    if (closePopupBtn7 && popup7) {
        closePopupBtn7.onclick = function() {
            popup7.style.display = "none";
        };
    }

    // Event untuk membuka popup 8
    if (openPopupBtn8 && popup8) {
        openPopupBtn8.onclick = function() {
            popup8.style.display = "block";
        };
    }

    // Event untuk menutup popup 8
    if (closePopupBtn8 && popup8) {
        closePopupBtn8.onclick = function() {
            popup8.style.display = "none";
        };
    }

    // Event untuk membuka popup 9
    if (openPopupBtn9 && popup9) {
        openPopupBtn9.onclick = function() {
            popup9.style.display = "block";
        };
    }

    // Event untuk menutup popup 9
    if (closePopupBtn9 && popup9) {
        closePopupBtn9.onclick = function() {
            popup9.style.display = "none";
        };
    }

    // Event untuk menutup popup ketika mengklik di luar area popup
    window.onclick = function(event) {
        if (event.target == popup1) {
            popup1.style.display = "none";
        }
        if (event.target == popup2) {
            popup2.style.display = "none";
        }
        if (event.target == popup3) {
            popup3.style.display = "none";
        }
        if (event.target == popup6) {
            popup6.style.display = "none";
        }
        if (event.target == popup7) {
            popup7.style.display = "none";
        }
        if (event.target == popup8) {
            popup8.style.display = "none";
        }
        if (event.target == popup9) {
            popup9.style.display = "none";
        }
    };
});
