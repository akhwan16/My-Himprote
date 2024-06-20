<?php
session_start();

// Ambil data dari form
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
$email_ketua = isset($_POST['email']) ? $_POST['email'] : '';

// Validasi data (misalnya, pastikan semua input terisi dengan benar)

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myhimprote";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    $error_message = "Koneksi gagal: " . $conn->connect_error;
    error_log($error_message); // Menyimpan error ke log
    die($error_message);
}

// Query untuk memasukkan data ke dalam tabel ProgramKerja
$sql = "INSERT INTO ProgramKerja (nama, deskripsi, ketua_email) VALUES ('$nama', '$keterangan', '$email_ketua')";
// Menjalankan query dan menangani hasilnya
if ($conn->query($sql) === TRUE) {
    echo "Program kerja baru berhasil ditambahkan.";
} else {
    $error_message = "Error: " . $sql . " - " . $conn->error;
    error_log($error_message); // Menyimpan error ke log
    die($error_message);
}

// Menutup koneksi
$conn->close();



header("Location: progdiv.php");
exit();
?>
