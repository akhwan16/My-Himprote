<?php
// Sertakan file koneksi ke database
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $email = $_POST['email']; // Gunakan nilai email dari formulir sebagai nilai yang akan diupdate
    $value = $_POST['emailValue'];
    $name = $_POST['name'];
    $division = $_POST['division'];
    $position = $_POST['position'];


    // Proses update data di database
    // Gunakan $email sebagai parameter untuk kueri UPDATE
    $stmt = $conn->prepare("UPDATE akun SET nama=?, departemen=?, jabatan=?, email=? WHERE email=?");
    $stmt->bind_param("sssss", $name, $division, $position, $email, $value); // Menggunakan $email sebagai email yang akan diupdate
    $stmt->execute();
    

    // Periksa jika update berhasil atau tidak
    if ($stmt->affected_rows > 0) {
        // Jika update berhasil, tampilkan pesan berhasil dengan alert
        echo "<script>window.history.back();</script>";
    } else {
        // Jika update gagal, tampilkan pesan error dengan alert
        echo "<script>alert('Failed to update data: " . $stmt->error . "'); </script>";
    }
    $stmt->close();
    $conn->close();
} else {
    // Tangani jika metode request bukan POST
    echo "Invalid request method";
}
?>
