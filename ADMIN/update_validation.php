<?php
session_start(); // Mulai session

include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Pastikan ada data yang dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data post_id dan validation dari body JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $post_id = $data['post_id'];
    $validation = $data['validation'];

    // Lakukan update nilai validasi berdasarkan post_id
    $sql = "UPDATE post SET validasi = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $validation, $post_id); // "ii" menunjukkan bahwa kedua parameter adalah integer
    $stmt->execute();

    // Periksa apakah query berhasil dijalankan
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Metode request tidak valid.']);
}
?>
