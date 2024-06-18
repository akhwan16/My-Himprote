<?php
// upload.php
$targetDir = "uploads/";

// Periksa apakah direktori sudah ada, jika belum, buat
if (!file_exists($targetDir)) {
    if (!mkdir($targetDir, 0777, true)) {
        die('Gagal membuat direktori uploads...');
    }
}
// Pastikan file telah diunggah dengan benar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["upload"])) {
    $file = $_FILES["upload"];

    // Konfigurasi direktori penyimpanan file
    $targetDir = "uploads/"; // Direktori tempat menyimpan file
    $targetFile = $targetDir . basename($file["name"]); // Path lengkap file yang akan disimpan

    // Cek apakah file sudah diunggah dengan benar
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // File berhasil diunggah, sekarang masukkan informasi ke dalam tabel post
        session_start();
        include 'db.php'; // Include koneksi ke database

        // Pastikan program_id telah diset di sesi sebelumnya
        if (isset($_SESSION['program_id'])) {
            $programId = $_SESSION['program_id'];
            $judul = "Judul postingan"; // Misalnya, Anda dapat mengganti dengan judul yang diperlukan
            $konten = "Konten postingan"; // Misalnya, Anda dapat mengganti dengan konten yang diperlukan

            // Siapkan query untuk menyimpan data ke dalam tabel post
            $sql = "INSERT INTO post (program_id, judul, konten, file) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $programId, $judul, $konten, $targetFile); // Mengikat parameter ke statement

            // Lakukan eksekusi query
            if ($stmt->execute()) {
                echo "File berhasil diunggah dan data post berhasil disimpan.";
            } else {
                echo "Terjadi kesalahan saat menyimpan data post: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Program ID tidak tersedia dalam sesi.";
        }

        $conn->close();
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
} else {
    echo "Mohon unggah file.";
}
?>
