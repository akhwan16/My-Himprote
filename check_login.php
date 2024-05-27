<?php
// Include file koneksi ke database
include 'D:\My-Himprote\db.php';

// Mulai session
session_start();

// Mengecek apakah ada email yang dikirimkan melalui metode POST
if(isset($_POST['email'])) {
    // Mengambil email dari metode POST
    $email = $_POST['email'];

    // Query database untuk memeriksa apakah email ada dalam tabel akun
    $sql = "SELECT * FROM akun WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Periksa jumlah baris hasil query
    if(mysqli_num_rows($result) > 0) {
        // Email ditemukan dalam database, ambil data pengguna dari hasil query
        $user = mysqli_fetch_assoc($result);

        // Simpan email dalam variabel session
        $_SESSION['email'] = $email;

        // Periksa rolenya
        if($user['role'] == 'Admin') {
            // Jika pengguna adalah admin, arahkan ke halaman admin menggunakan JavaScript
            echo '<script>window.location.href = "../ADMIN/dashboardadmin1.php";</script>';
            exit;
        } elseif($user['role'] == 'User') {
            // Jika pengguna adalah user, arahkan ke halaman user menggunakan PHP header
            header("Location: ../dashboarduser1.php");
            exit;
        } 
    } else {
          $_SESSION['status'] = "NO";
        // Jika email tidak ditemukan dalam database, tampilkan pesan kesalahan menggunakan jendela peringatan
        echo '<script>alert("Email '.$email.' tidak terdaftar sebagai FUNGSIONARIS HIMPROTE FT UNNES.");</script>';
       
        // Redirect ke halaman utama
        echo '<script>window.location.href = "../index.html";</script>';
        exit;
    }
} else {
    // Redirect ke halaman utama jika tidak ada email yang dikirimkan
    echo '<script>window.location.href = "../index.html";</script>';
    exit;
}
?>
