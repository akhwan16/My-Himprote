document.addEventListener("DOMContentLoaded", function () {
  const moreInfoBtns = document.querySelectorAll(".more-info");
  const popups = document.querySelectorAll(".popup");

  moreInfoBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const popupId = this.getAttribute("data-popup-id");
      const popup = document.getElementById(popupId);

      if (popup) {
        popup.style.display = "block";
      }
    });
  });

  popups.forEach((popup) => {
    const closeBtn = popup.querySelector(".close");
    if (closeBtn) {
      closeBtn.addEventListener("click", function () {
        popup.style.display = "none";
      });
    }

    window.addEventListener("click", function (event) {
      if (event.target == popup) {
        popup.style.display = "none";
      }
    });
  });
});
