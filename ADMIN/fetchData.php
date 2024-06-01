<?php
include 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Fetch all records from the 'akun' table
    $query = "SELECT * FROM akun";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[$row['email']] = array(
                "profile_image" => $row['profile_image'],
                "nama" => $row['nama'],
                "email" => $row['email'],
                "divisi" => $row['divisi'],
                "jabatan" => $row['jabatan']
            );
        }

        // Check if the email exists in the retrieved data
        if (isset($data[$email])) {
            $response = $data[$email];

        } else {
            $response = [
                'email' => $email,
                'profile_image' => 'No data available',
                'nama' => 'No data available',
                'divisi' => 'No data available',
                'jabatan' => 'No data available'
            ];
        }

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
