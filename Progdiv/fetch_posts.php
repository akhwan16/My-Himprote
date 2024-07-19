<?php
session_start(); // Mulai session

include '../Database/db.php'; // Pastikan file koneksi database sudah di-include dengan benar

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['category'])) {
    $category = $_GET['category'];
    
    // Periksa apakah $_SESSION['program_id'] sudah terdefinisi dan tidak kosong
    if (!isset($_SESSION['program_id']) || empty($_SESSION['program_id'])) {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Program ID tidak ditemukan dalam session.']);
        exit; // Keluar dari script setelah mengirim respons
    }

    $program_id = $_SESSION['program_id'];

    // Query untuk mengambil data post berdasarkan program_id dan kategori
    $sql = "SELECT post.id, post.judul, post.konten, post.tanggal, post.validasi, post.program_id, post.divisi_id, post.file, post.kategori, divisi.nama AS divisi_nama 
            FROM post 
            JOIN divisi ON post.divisi_id = divisi.id 
            WHERE post.program_id = ? AND post.kategori = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $program_id, $category); // "is" menunjukkan integer dan string
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $posts = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = array(
                'id' => $row['id'],
                'judul' => htmlspecialchars($row['judul']),
                'konten' => htmlspecialchars($row['konten']),
                'tanggal' => htmlspecialchars($row['tanggal']),
                'validasi' => htmlspecialchars($row['validasi']),
                'program_id' => htmlspecialchars($row['program_id']),
                'divisi_id' => htmlspecialchars($row['divisi_id']),
                'file' => htmlspecialchars($row['file']),
                'kategori' => htmlspecialchars($row['kategori']),
                'divisi_nama' => htmlspecialchars($row['divisi_nama'])
            );
        }
        $stmt->close();
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode($posts);
        exit; // Keluar dari skrip setelah mengirim respons JSON
    } else {
        $stmt->close();
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode(['message' => 'Belum ada postingan dalam kategori ini']);
        exit; // Keluar dari skrip setelah mengirim respons JSON
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Invalid request']);
    exit; // Keluar dari skrip setelah mengirim respons JSON
}
?>
