<?php
// Include file koneksi ke database
include 'db.php';
header("Access-Control-Allow-Origin: *");
// Izinkan metode GET
header("Access-Control-Allow-Methods: GET");
// Izinkan header yang spesifik
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// Coba jalankan kueri SQL
$sql = "SELECT profile_image, nama, email, divisi, jabatan FROM akun";
$result = $conn->query($sql);

$data = array();

if ($result) {
    if ($result->num_rows > 0) {
        // Loop melalui hasil query dan simpan dalam array
        while($row = $result->fetch_assoc()) {
            $data[] = array(
                "profile_image" => $row['profile_image'],
                "nama" => $row['nama'],
                "email" => $row['email'],
                "divisi" => $row['divisi'],
                "jabatan" => $row['jabatan']
            );
        }
        // Kirimkan data dalam format JSON
        echo json_encode($data);
    } else {
        // Jika tidak ada data
        echo json_encode(array("message" => "Tidak ada data akun."));
    }
} else {
    // Jika terjadi kesalahan dalam menjalankan kueri SQL
    echo json_encode(array("error" => $conn->error));
}
?>
