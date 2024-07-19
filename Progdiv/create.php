<?php
include '../Database/db.php';

// Tangkap data dari form
$email = mysqli_real_escape_string($conn, $_POST['email']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$division = mysqli_real_escape_string($conn, $_POST['division']);
$position = mysqli_real_escape_string($conn, $_POST['position']);

// Posisi yang harus unik
$posisi_unik = array(
    'Ketua HIMPROTE',
    'Wakil Ketua HIMPROTE',
    'Sekretaris umum',
    'Bendahara umum',
    'Sekretaris 2',
    'Bendahara 2',
    'Ketua Departemen',
    'Sekretaris Departemen'
);

// Periksa apakah posisi unik
if (in_array($position, $posisi_unik)) {
    $query_periksa_posisi = "SELECT * FROM akun WHERE jabatan='$position'";
    $result = $conn->query($query_periksa_posisi);
    if ($result->num_rows > 0) {
        // Jika posisi sudah ada, berikan pesan kesalahan
        echo "<script>document.getElementById('error-message').innerHTML = 'Posisi sudah ada. Data tidak dapat ditambahkan.'; document.getElementById('error-message').style.display = 'block';</script>";
        exit();
    }
}

// Periksa apakah email sudah ada
$query_periksa_email = "SELECT * FROM akun WHERE email='$email' LIMIT 1";
$result = $conn->query($query_periksa_email);
if ($result->num_rows > 0) {
    // Jika email sudah ada, berikan pesan kesalahan
    echo "<script>document.getElementById('error-message').innerHTML = 'Email sudah terdaftar. Data tidak dapat ditambahkan.'; document.getElementById('error-message').style.display = 'block';</script>";
    exit();
}

// Tetapkan peran berdasarkan posisi
if ($position === 'Ketua HIMPROTE') {
    $peran = 'admin';
} else {
    $peran = 'user'; // Peran default jika bukan Ketua HIMPROTE
}

// Buat query untuk menambahkan data ke tabel akun
$sql = "INSERT INTO akun (email, nama, departemen ,jabatan, role) VALUES ('$email', '$name', '$division', '$position', '$peran')";

// Jalankan query
if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke halaman yang diinginkan dengan slide index
    header("Location: ../dashboard/dashboard.php?slide=2");
    exit(); // Pastikan eksekusi kode berhenti setelah pengalihan
} else {
    // Jika penyisipan gagal, berikan pesan kesalahan
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
