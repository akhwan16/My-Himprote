document.addEventListener("DOMContentLoaded", function () {
  const moreInfo1Btns = document.querySelectorAll(".create-more-info, .create2-more-info, .edit-more-info");
  const moreInfoBtns = document.querySelectorAll(".more-info");
  const popups = document.querySelectorAll(".popup");

  // Event listener untuk tombol "More Info" versi 1, versi 2, dan edit-more-info
  moreInfo1Btns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const popupId = this.getAttribute("data-popup-id");
      const popup = document.getElementById(popupId);

      if (popup) {
        popup.style.display = "block";
      }
    });
  });

  // Event listener untuk tombol "More Info" versi lainnya
  moreInfoBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      const popupId = this.getAttribute("data-popup-id");
      const popup = document.getElementById(popupId);

      if (popup) {
        popup.style.display = "block";
      }
    });
  });

  // Event listener untuk tombol-tombol close
  popups.forEach((popup) => {
    const closeBtn = popup.querySelector(".close");
    if (closeBtn) {
      closeBtn.addEventListener("click", function () {
        popup.style.display = "none";
      });
    }

    // Menutup popup saat mengklik di luar area popup
    window.addEventListener("click", function (event) {
      if (event.target === popup) {
        popup.style.display = "none";
      }
    });
  });
});
