<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <style>       
        body {
            background-color: #f0f2f5;
            font-family: Poppins;
            overflow: hidden;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 5px;
            border-bottom: 2px solid #1f4e79;
            width: auto;
            max-width: 355px;
            margin: 0 auto; /* Center the container horizontally */
        }
        .logo {
            display: flex;
            align-items: left;
        }
        .logo img {
            height: 25px;
        }
        .reminder {
            font-size: small;
            font-weight: bold;
            color: black;
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
        nav {
            width: 100%;
        }
        .navbar {
            display: flex;
            align-items: center;
            width: 304px;
            height: 54px;
            background-color: #fff;
            border-radius: 30px;
            position: fixed;
            bottom: 5px; /* Adjust bottom margin if necessary */
            left: 50%; /* Center horizontally */
            transform: translateX(-50%); /* Center horizontally */
            border: 2px solid #ccc; /* Added border */
            justify-content: space-evenly;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* enhanced shadow */
        }
        .navbar-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #333;
            cursor: pointer;
            padding-top: 1px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .navbar-item.active {
            color: #002469;
        }
        .navbar-item i {
            font-size: 15px;
        }
        .navbar-item span {
            font-size: 9px;
            margin-top: 5px; /* Add space between icon and text */
        }
        .fade-in {
            animation: fadeIn ease 1s;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
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

<?php 
    include "/My-Himprote/layout/footer.html" 
?>

</html>
