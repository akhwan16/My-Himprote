<?php
// Mulai session
session_start();

// Pastikan email tersedia dalam variabel session
if(isset($_SESSION['email'])) {
    // Email tersedia, ambil nilai email dari session
    $email = $_SESSION['email'];

    // Include file koneksi ke database
    include 'D:\My-Himprote\db.php';

    // Query untuk mendapatkan nama dan role dari database berdasarkan email
    $sql = "SELECT nama, role FROM akun WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($nama, $role);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
} else {
    echo '<script>window.location.href = "../index.html";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dashboardadmin1.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
   
</head>
<body>
  
    <div class="container-fluid">
        <div class="header-container">
            <div class="logo">
                <img src="../Assets/img/Group 207.png" alt="Logo">
            </div>
            <div class="reminder">
                REMINDER!
            </div>
        </div>
        <div class="welcome-container">
          <div class="welcome-message">Selamat datang, <?php echo htmlspecialchars($nama); ?></div>
          <div class="sub-message">Kamu login sebagai <span href="#"><?php echo htmlspecialchars($role); ?></span>!</div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
