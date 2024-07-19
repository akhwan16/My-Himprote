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
    echo '<script>window.location.href = "../index.php";</script>';
    exit;
}
?>