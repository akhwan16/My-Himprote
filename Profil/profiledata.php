<?php
// Sertakan file koneksi ke database
include '../Database/db.php';

// Mengatur header respons JSON
header('Content-Type: application/json');

// Mulai output buffering untuk menangkap output tak terduga
ob_start();

$response = array("success" => false, "message" => "Invalid request");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil email dari POST data
    $email = $_POST['email'];

    // Proses pencarian data di database
    $stmt = $conn->prepare("SELECT nama, departemen, jabatan, email, profile_image FROM akun WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $division, $position, $email, $profileImage);
        $stmt->fetch();
        
        // Kembalikan data sebagai respons JSON
        $response = array(
            "success" => true,
            "name" => $name,
            "division" => $division,
            "position" => $position,
            "email" => $email,
            "profileImage" => $profileImage
        );
    } else {
        // Jika data tidak ditemukan
        $response = array("success" => false, "message" => "No data found for the provided email.");
    }
    $stmt->close();
    $conn->close();
} else {
    $response = array("success" => false, "message" => "Invalid request method");
}

// Tangkap output tak terduga dan kosongkan buffer
$unexpected_output = ob_get_clean();
if ($unexpected_output) {
    error_log("Unexpected output detected: $unexpected_output");
}

// Kirim respons JSON
echo json_encode($response);
?>

