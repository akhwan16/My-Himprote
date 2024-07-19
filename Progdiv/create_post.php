<?php
session_start(); // Mulai session, pastikan dipanggil di awal script

include '../Database/db.php'; // Pastikan file koneksi database sudah di-include dengan benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $tanggal = $_POST['tanggal'];
    $kategori = $_POST['kategori'];
    $nama_divisi = $_POST['division']; // Ambil nama divisi dari form

    // Validasi data jika diperlukan
    if (empty($judul) || empty($konten) || empty($tanggal) || empty($kategori) || empty($nama_divisi)) {
        echo "<script>alert('Harap isi semua field yang wajib diisi.'); window.location.href = 'javascript:history.back()';</script>";
        exit;
    }

    // Cek apakah program_id sudah tersedia dari session
    if (!isset($_SESSION['program_id']) || empty($_SESSION['program_id'])) {
        echo "<script>alert('Program ID tidak tersedia dalam session.'); window.location.href = 'javascript:history.back()';</script>";
        exit;
    }

    $program_id = $_SESSION['program_id'];

    // Ambil divisi_id berdasarkan nama divisi dan program_id
    $sql_divisi = "SELECT id FROM divisi WHERE nama = ? AND program_id = ?";
    $stmt_divisi = $conn->prepare($sql_divisi);
    $stmt_divisi->bind_param('si', $nama_divisi, $program_id);
    $stmt_divisi->execute();
    $result_divisi = $stmt_divisi->get_result();

    if ($result_divisi->num_rows > 0) {
        $row_divisi = $result_divisi->fetch_assoc();
        $divisi_id = $row_divisi['id'];

        // Insert data ke dalam tabel post
        $sql = "INSERT INTO post (judul, konten, tanggal, kategori, divisi_id, program_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssii', $judul, $konten, $tanggal, $kategori, $divisi_id, $program_id);

        if ($stmt->execute()) {
            echo "<script>alert('Postingan berhasil ditambahkan.'); window.location.href = 'javascript:history.back()';</script>";
            exit;
        } else {
            echo "Terjadi kesalahan: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Nama divisi tidak valid untuk program ini.'); window.location.href = 'javascript:history.back()';</script>";
    }

    $stmt_divisi->close();
} else {
    echo "<script>alert('Metode permintaan tidak valid.'); window.location.href = 'javascript:history.back()';</script>";
}

$conn->close(); // Tutup koneksi setelah selesai menggunakan database
?>
