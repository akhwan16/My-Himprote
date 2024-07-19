<?php
session_start();
include '../Database/db.php'; // Ubah sesuai dengan lokasi file koneksi database Anda

// Pastikan ID program kerja yang akan dihapus diterima dari formulir POST
if (isset($_POST['program_id'])) {
    $program_id = $_POST['program_id'];

    // Lakukan penghapusan program kerja dari tabel ProgramKerja
    $sqlDelete = "DELETE FROM ProgramKerja WHERE id = $program_id";

    if ($conn->query($sqlDelete) === TRUE) {
        // Jika penghapusan berhasil, catat pesan sukses dalam log
        $log_message = "Program kerja dengan ID $program_id berhasil dihapus.";
        error_log($log_message);
        echo "<script>alert('Berhasil Menghapus Progam Kerja'); </script>";
        // Kembali ke halaman sebelumnya
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error: " . $sqlDelete . "<br>" . $conn->error;
    }
} else {
    echo "ID program kerja tidak diterima.";
}

$conn->close();
?>
