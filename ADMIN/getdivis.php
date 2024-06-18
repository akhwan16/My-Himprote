<?php
session_start();
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Pastikan parameter post_id tersedia
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Pastikan program_id telah diset di sesi sebelumnya
    if (isset($_SESSION['program_id'])) {
        $programId = $_SESSION['program_id'];

        // Lakukan query untuk mendapatkan konten post berdasarkan program_id dan post_id
        $sql = "SELECT konten FROM post WHERE program_id = ? AND id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $programId, $postId);
        $stmt->execute();
        $stmt->bind_result($konten);

        if ($stmt->fetch()) {
            // Mengembalikan data dalam format JSON
            echo json_encode(['content' => $konten]);
        } else {
            echo json_encode(['error' => 'Post tidak ditemukan']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Program ID tidak tersedia dalam sesi']);
    }
} else {
    echo json_encode(['error' => 'Parameter post_id tidak tersedia']);
}

$conn->close(); // Tutup koneksi database
?>
