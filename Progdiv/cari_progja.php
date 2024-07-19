<?php
session_start();
include '../Database/db.php'; // Pastikan ini mengarah ke file koneksi database yang benar

// Ambil kata kunci pencarian dari URL
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Query SQL untuk mencari program kerja berdasarkan nama
$sql = "SELECT id, nama, deskripsi FROM ProgramKerja WHERE nama LIKE '%$q%'";

$result = $conn->query($sql);

// Cek jika ada hasil dari pencarian
if ($result->num_rows > 0) {
    echo "<h2>Hasil Pencarian untuk '$q'</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<strong>Nama:</strong> " . htmlspecialchars($row['nama']) . "<br>";
        echo "<strong>Deskripsi:</strong> " . htmlspecialchars($row['deskripsi']);
        // Tambahkan link atau tombol untuk detail program kerja jika diperlukan
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Tidak ditemukan program kerja dengan kata kunci '$q'.</p>";
}

$conn->close();
?>
