<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Query to fetch post data
    $sql = "SELECT id, judul, konten, tanggal, kategori, divisi_id FROM post WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row); // Output JSON data
    } else {
        echo json_encode(['error' => 'Post not found']); // Handle case where post_id does not exist
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request']); // Handle case where post_id is not provided
}
?>
