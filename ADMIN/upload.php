<?php
// Pastikan session dimulai dan sertakan file koneksi ke database (db.php)
session_start();
include '../db.php';

// Konfigurasi direktori penyimpanan file
$targetDir = "uploads/";

// Pastikan direktori sudah ada atau buat jika belum
if (!file_exists($targetDir)) {
    if (!mkdir($targetDir, 0777, true)) {
        die('Gagal membuat direktori uploads...');
    }
}

// Periksa apakah terdapat file yang diunggah dan post_id tersedia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["upload"]) && isset($_POST['post_id'])) {
    $file = $_FILES["upload"];
    $fileName = basename($file["name"]);
    $targetFile = $targetDir . $fileName; // Path lengkap file yang akan disimpan
    $post_id = $_POST['post_id'];

    // Cek apakah file sudah diunggah dengan benar
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // File berhasil diunggah, sekarang masukkan informasi ke dalam tabel post

        // Dapatkan program_id dari session
        if (isset($_SESSION['program_id'])) {
            $programId = $_SESSION['program_id'];

            // Update kolom file untuk post yang ada
            $sqlUpdate = "UPDATE post SET file = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $targetFile, $post_id);

            if ($stmtUpdate->execute()) {
                echo "File berhasil diunggah dan data post berhasil diperbarui.";
            } else {
                echo "Terjadi kesalahan saat memperbarui data post: " . $stmtUpdate->error;
            }

            $stmtUpdate->close();
        } else {
            echo "Program ID tidak tersedia dalam sesi.";
        }
    } else {
        // Tampilkan kesalahan yang terjadi saat mengunggah file
        $uploadError = $_FILES["upload"]["error"];
        switch ($uploadError) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "File melebihi batas ukuran yang diizinkan oleh konfigurasi php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "File melebihi batas ukuran yang diizinkan oleh formulir HTML.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "File hanya sebagian yang diunggah.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "Tidak ada file yang diunggah.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Direktori sementara hilang.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Gagal menulis file ke disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "Ekstensi PHP menghentikan pengunggahan file.";
                break;
            default:
                $message = "Kesalahan tidak diketahui.";
                break;
        }
        echo "Terjadi kesalahan saat mengunggah file: " . $message;
    }
} else {
    // Jika tidak ada file yang diunggah atau post_id tidak tersedia
    echo "Mohon unggah file dan pastikan post_id disertakan.";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_FILES["upload"]["name"])) {
        echo " Kolom 'file' masih kosong.";
    }
    if (!isset($_POST['post_id'])) {
        echo " Post ID tidak tersedia.";
    }
}

$conn->close(); // Tutup koneksi database setelah selesai
?>
