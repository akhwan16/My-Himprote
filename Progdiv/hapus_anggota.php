<?php
session_start();
include '../Database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['program_id'])) {
    // Ambil email_pengguna dan program_id dari data yang dikirimkan
    $email_pengguna = $_POST['email'];
    $program_id = $_POST['program_id'];

    // Query untuk menghapus anggota dari PenggunaProgramDivisi berdasarkan email_pengguna dan program_id
    $sqlDeleteAnggota = "DELETE FROM PenggunaProgramDivisi WHERE email_pengguna = '$email_pengguna' AND program_id = '$program_id'";

    if ($conn->query($sqlDeleteAnggota)) {
        echo "<script>alert('Berhasil Menghapus Anggota'); </script>";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error: " . $sqlDeleteAnggota . "<br>" . $conn->error;
    }
} else {
    echo "Permintaan tidak valid atau data tidak diberikan.";
}

$conn->close();
?>
