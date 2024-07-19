<?php
// Mulai session jika belum dimulai
session_start();

// Pastikan request dari AJAX dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Baca data JSON yang diterima
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Pastikan data category ada dalam JSON yang diterima
    if (isset($data['category'])) {
        // Ambil nilai kategori dari data JSON
        $category = $data['category'];

        // Set nilai kategori ke dalam session
        $_SESSION['category'] = $category;

        // Kirim respons kembali ke JavaScript
        header('Content-Type: application/json');
        $response = ['message' => 'Nilai kategori berhasil diatur', 'category' => $category];
        echo json_encode($response);
        exit; // Berhenti eksekusi skrip PHP setelah mengirim respons JSON
    } else {
        // Jika tidak ada data kategori yang diterima, kirim respons error
        http_response_code(400); // Bad Request
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Parameter kategori tidak diterima']);
        exit; // Berhenti eksekusi skrip PHP setelah mengirim respons JSON
    }
} else {
    // Jika bukan permintaan POST, kirim respons error
    http_response_code(405); // Method Not Allowed
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Metode request tidak diizinkan']);
    exit; // Berhenti eksekusi skrip PHP setelah mengirim respons JSON
}
?>
