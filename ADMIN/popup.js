document.addEventListener("DOMContentLoaded", function() {
    var openPopupBtn1 = document.getElementById("openPopupBtn1");

    var popup1 = document.getElementById("popup1");
  
    var closePopupBtn1 = document.getElementById("closePopupBtn1");


    openPopupBtn1.onclick = function() {
        popup1.style.display = "block";
    }



    closePopupBtn1.onclick = function() {
        popup1.style.display = "none";
    }



    window.onclick = function(event) {
        if (event.target == popup1) {
            popup1.style.display = "none";
        }
       
    }
});
