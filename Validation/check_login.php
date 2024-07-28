<?php
// Include file koneksi ke database
include '/Kuliah/My-Himprote/Database/db.php';

// Mulai session
session_start();

// Mengecek apakah ada email yang dikirimkan melalui metode POST
if (isset($_POST['email'])) {
    // Mengambil email dan URL gambar profil dari metode POST
    $email = $_POST['email'];
    $profile_image = $_POST['profile_image'];

    // Debug: Tampilkan email dan profile_image yang diterima
    error_log("Email: $email");
    error_log("Profile Image: $profile_image");

    // Query database untuk memeriksa apakah email ada dalam tabel akun
    $sql = "SELECT * FROM akun WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa jumlah baris hasil query
    if ($result->num_rows > 0) {
        // Email ditemukan dalam database, ambil data pengguna dari hasil query
        $user = $result->fetch_assoc();

        // Simpan email dalam variabel session
        $_SESSION['email'] = $email;

        // Update gambar profil
        $update_sql = "UPDATE akun SET profile_image = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $profile_image, $email);
        if ($update_stmt->execute()) {
            // Update berhasil
            header("Location: ../Dashboard/dashboard.php");
            exit;
        } else {
            // Debug: Tampilkan pesan kesalahan jika update gagal
            error_log("Error updating record: " . $conn->error);
        }
    } else {
        // Jika email tidak ditemukan dalam database
        // Debug: Tampilkan pesan kesalahan jika email tidak ditemukan
        error_log("Email not found: $email");

        // Hapus token login Google dari local storage
        echo '<script>localStorage.removeItem("accessToken");</script>';

        // Tampilkan pesan kesalahan menggunakan jendela peringatan
        echo '<script>alert("Email ' . $email . ' tidak terdaftar sebagai FUNGSIONARIS HIMPROTE FT UNNES."); window.location.href = "../index.php";</script>';
        exit;
    }
} else {
    // Redirect ke halaman utama jika tidak ada email yang dikirimkan
    echo '<script>window.location.href = "../index.php";</script>';
    exit;
}
?>
