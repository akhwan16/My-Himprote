<?php
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $post_id = $_POST['post_id'];
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $tanggal = $_POST['tanggal'];
    $kategori = $_POST['kategori'];
    $divisi_id = $_POST['division']; // Ambil divisi_id dari form

    // Validasi data jika diperlukan
    if (empty($judul) || empty($konten) || empty($tanggal) || empty($kategori) || empty($divisi_id)) {
        echo "Harap isi semua field yang wajib diisi.";
        exit;
    }

    // Update data di database
    $sql = "UPDATE post SET judul=?, konten=?, tanggal=?, kategori=?, divisi_id=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssii', $judul, $konten, $tanggal, $kategori, $divisi_id, $post_id);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close(); // Tutup koneksi setelah selesai menggunakan database
} else {
    echo "Metode permintaan tidak valid.";
}
?>
