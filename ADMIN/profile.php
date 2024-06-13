<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="profile.css" />
    <title>Profil</title>
    <div class="svg-container">
        <div class="header-container">
            <div class="logo">
                <img src="../Assets/img/Group 207.png" alt="Logo">
            </div>
            <div class="reminder">
                Profil
            </div>
        </div>
    </div>
</head>
<body>
    <div class="container">
        <div class="card fade-in">
            <img id="profileImage" src="" alt="Profile Image" class="profile-image">
            <div class="text-content">
                <div id="name" class="name"></div>
                <div id="email" class="email"></div>
                <div id="division" class="division"></div>
                <div id="position" class="position"></div>
            </div>
            <button class="btn btn-danger logout-btn">Logout</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = function() {
            // Ambil email dari localStorage
            var email = localStorage.getItem("email");
            if (email) {
                // Buat objek XMLHttpRequest
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "profiledata.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                // Kirim email ke server
                xhr.send("email=" + encodeURIComponent(email));
                // Tangani respons dari server
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    document.getElementById("profileImage").src = response.profileImage;
                                    document.getElementById("name").textContent = response.name;
                                    document.getElementById("email").textContent = response.email;
                                    document.getElementById("division").textContent = response.division;
                                    document.getElementById("position").textContent = response.position;
                                } else {
                                    console.error("Profile data not found:", response.message);
                                }
                            } catch (e) {
                                console.error("Failed to parse JSON response:", e);
                                console.error("Response text:", xhr.responseText);
                            }
                        } else {
                            console.error("Failed to fetch data from server. Status:", xhr.status);
                        }
                    }
                };
            } else {
                console.error("No email found in localStorage.");
            }
            // Tambahkan event listener untuk tombol logout
            var logoutBtn = document.querySelector('.logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function() {
                    // Hapus token dari localStorage
                    localStorage.removeItem("token");
                    // Redirect ke halaman login atau halaman lain yang sesuai
                    window.location.href = "../index.php";
                });
            }
        };
    </script>
</body>
<footer>
    <div class="navbar">
        <div class="navbar-item " id="home">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </div>
        <div class="navbar-item" id="task">
            <i class="fas fa-tasks"></i>
            <span>Progdiv</span>
        </div>
        <div class="navbar-item active" id="profile">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        var homeNavItem = document.getElementById("home");
        homeNavItem.addEventListener("click", function () {
          // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
          window.location.href = "dashboardadmin.php"; // Ganti "progdivadmin1.html" dengan URL yang sesuai
        });
        var progdivNavItem = document.getElementById('task');
        progdivNavItem.addEventListener('click', function() {
          // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
          window.location.href = "progdivadmin.php";  // Ganti "profile.php" dengan URL yang sesuai
        });
      });
    
    </script>
</footer>
<script src="nav.js"></script>
</html>
