<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Profile Card</title>

    <style>
        body {
            background-color: #f0f2f5;
            font-family: Poppins;
        }

        .container {
            display: flex;
            padding-top: 100px;
            justify-content: center;
            align-items: flex-start; /* Changed to flex-start */
            height: 100vh;
        }

        .card {
            align-items: top;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #1f4e79;
            padding: 20px;
            max-width: 400px;
            position: relative; /* Position relative for absolute positioning */
        }

        .profile-image {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin: 0 auto 20px; /* Center horizontally and add bottom margin */
            display: block; /* Ensure it's treated as a block element */
       
        }

        .text-content {
            text-align: center;
        }

        .title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .name, .email, .division, .position {
            margin-bottom: 0px;
            font-size: 11px;
        }

        .division {
            font-weight: bold;
        }

        .position {
            font-style: italic;
        }

        .logout-btn {
            position: absolute;
            bottom: -60px; /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <img id="profileImage" src="" alt="Profile Image" class="profile-image">
            <div class="text-content">
                <div id="division" class="division"></div>
                <div id="position" class="position"></div>
                <div id="name" class="name"></div>
                <div id="email" class="email"></div>
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
        window.location.href = "index.html";
    });
}

    };
</script>

<footer>
</div>
    <div class="navbar">
        <div class="navbar-item active" id="home">
            <i class="fas fa-home"></i>
            <span>Beranda</span>

        </div>
        <div class="navbar-item" id="task">
            <i class="fas fa-tasks"></i>
            <span>Progdiv</span>
        </div>
        <div class="navbar-item" id="profile">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen navbar-item untuk Beranda
        var homeNavItem = document.getElementById('home');

        // Menambahkan event listener untuk mengarahkan pengguna ke bagian khusus halaman PHP saat navbar-item Beranda diklik
        homeNavItem.addEventListener('click', function() {
            // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
            window.location.href = "../dashboardadmin.php"; // Ganti "beranda" dengan ID atau anchor pada bagian halaman PHP yang ingin dituju
        });
    });
</script>
</footer>
<script src="../nav.js"></script>
</body>
</html>
