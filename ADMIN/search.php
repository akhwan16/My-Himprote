<?php
include '../db.php';

if (isset($_GET['q'])) {
    // Tangkap kueri pencarian dari URL dan bersihkan untuk mencegah serangan SQL Injection
    $searchQuery = mysqli_real_escape_string($conn, $_GET['q']);

    // Buat kueri untuk mencari data berdasarkan nama atau email yang cocok dengan kueri pencarian
    $query = "SELECT * FROM akun WHERE nama LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%'";

    // Lakukan kueri ke database
    $result = mysqli_query($conn, $query);

    // Periksa apakah ada hasil yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Tampilkan hasil pencarian
        while ($data = mysqli_fetch_assoc($result)) {
           // Tampilkan hasil pencarian sesuai dengan format yang diinginkan
           echo "<div class='containerlist'>";
           echo "<div class='card'>";
           echo "<div class='card-content'>";
           echo "<img id='profileImage' src='" . $data['profile_image'] . "' alt='Profile Image' class='profile-image'>";
           echo "<div class='text-content'>";
           echo "<div id='divisi' class='division'>" . $data['divisi'] . "</div>";
           echo "<div id='jabatan' class='title'>" . $data['jabatan'] . "</div>";
           echo "<div id='nama' class='name'>" . $data['nama'] . "</div>";
           echo "<div id='email' class='email'>" . $data['email'] . "</div>";
           echo "</div>";
           echo "</div>";
           echo '<div class="icon-container">';
           echo '<i alt="Edit Icon" class="fas fa-pencil" id="icon1" ></i> ';
           echo '<i onclick="hapusData(\'' . htmlspecialchars($data['email']) . '\')" alt="delete Icon" class="fas fa-trash" id="icon2"></i>';
        
           echo "</div>";
           echo "</div>";
           echo "</div>";
        }
    } else {
        echo "Tidak ada hasil.."; // Tampilkan pesan jika tidak ada hasil yang ditemukan
    }
} else {
    echo "No search query provided."; // Tampilkan pesan jika tidak ada kueri pencarian yang diberikan
}
?>