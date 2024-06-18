<?php
// upload.php

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

// Periksa apakah terdapat file yang diunggah
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["upload"])) {
    $file = $_FILES["upload"];
    $fileName = basename($file["name"]);
    $targetFile = $targetDir . $fileName; // Path lengkap file yang akan disimpan

    // Cek apakah file sudah diunggah dengan benar
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // File berhasil diunggah, sekarang masukkan informasi ke dalam tabel post

        // Dapatkan program_id dari session
        if (isset($_SESSION['program_id'])) {
            $programId = $_SESSION['program_id'];

            // Ambil judul dan konten dari database berdasarkan post_id
            $post_id = $_POST['post_id'];
            $sqlSelect = "SELECT judul, konten FROM post WHERE id = ?";
            $stmtSelect = $conn->prepare($sqlSelect);
            $stmtSelect->bind_param("i", $post_id);
            $stmtSelect->execute();
            $stmtSelect->bind_result($judul, $konten);

            // Ambil hasil query
            $stmtSelect->fetch();
            $stmtSelect->close();

            // Periksa apakah file dengan nama yang sama sudah ada di database
            $sqlCheck = "SELECT id FROM post WHERE program_id = ? AND file = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("is", $programId, $targetFile);
            $stmtCheck->execute();
            $stmtCheck->store_result();

            if ($stmtCheck->num_rows > 0) {
                // Jika file sudah ada, update data yang sudah ada
                $sqlUpdate = "UPDATE post SET judul = ?, konten = ? WHERE program_id = ? AND file = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ssis", $judul, $konten, $programId, $targetFile);

                if ($stmtUpdate->execute()) {
                    echo "File berhasil diunggah dan data post berhasil diperbarui.";
                } else {
                    echo "Terjadi kesalahan saat memperbarui data post: " . $stmtUpdate->error;
                }

                $stmtUpdate->close();
            } else {
                // Jika file belum ada, buat entri baru
                $sqlInsert = "INSERT INTO post (program_id, judul, konten, file) VALUES (?, ?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("isss", $programId, $judul, $konten, $targetFile);

                if ($stmtInsert->execute()) {
                    echo "File baru berhasil diunggah dan data post baru berhasil disimpan.";
                } else {
                    echo "Terjadi kesalahan saat menyimpan data post baru: " . $stmtInsert->error;
                }

                $stmtInsert->close();
            }

            $stmtCheck->close();
        } else {
            echo "Program ID tidak tersedia dalam sesi.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
} else {
    // Jika tidak ada file yang diunggah
    echo "Mohon unggah file.";

    // Atau tambahkan pesan untuk kasus khusus jika kolom 'file' masih kosong
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_FILES["upload"]["name"])) {
        echo " Kolom 'file' masih kosong.";
    }
}

$conn->close(); // Tutup koneksi database setelah selesai
?>
