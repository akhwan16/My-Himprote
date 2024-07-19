<?php
include '../Database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['post_id'])) {
        $post_id = $data['post_id'];

        // Query untuk menghapus data post dari database berdasarkan post_id
        $sql = "DELETE FROM post WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $post_id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Gagal menghapus postingan.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Parameter post_id tidak ditemukan.']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Permintaan tidak valid.']);
}
?>
