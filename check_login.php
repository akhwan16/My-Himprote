<?php
// Include file koneksi ke database
include 'db.php';

// Mulai session
session_start();

// Mengecek apakah ada email yang dikirimkan melalui metode POST
if(isset($_POST['email'])) {
    // Mengambil email dan URL gambar profil dari metode POST
    $email = $_POST['email'];
    $profile_image = $_POST['profile_image'];

    // Query database untuk memeriksa apakah email ada dalam tabel akun
    $sql = "SELECT * FROM akun WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Periksa jumlah baris hasil query
    if(mysqli_num_rows($result) > 0) {
        // Email ditemukan dalam database, ambil data pengguna dari hasil query
        $user = mysqli_fetch_assoc($result);

        // Simpan email dalam variabel session
        $_SESSION['email'] = $email;

        if ($result->num_rows > 0) {
            // Email sudah ada, update gambar profil
            $update_sql = "UPDATE akun SET profile_image='$profile_image' WHERE email='$email'";
            if ($conn->query($update_sql) === TRUE) {
                // Update berhasil
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        // Periksa rolenya
        if($user['role'] == 'admin') {
            // Jika pengguna adalah admin, atur slideIndex di localStorage dan arahkan ke halaman admin
            echo '<script>
                localStorage.setItem("slideIndex", 1);
                window.location.href = "../ADMIN/dashboardadmin1.php";
                </script>';
            exit;
        } elseif($user['role'] == 'user') {
            // Jika pengguna adalah user, arahkan ke halaman user menggunakan PHP header
            header("Location: ../dashboarduser1.php");
            exit;
        } 
    } else {
        // Jika email tidak ditemukan dalam database
        // Hapus token login Google dari local storage
        echo '<script>localStorage.removeItem("accessToken");</script>';

        // Tampilkan pesan kesalahan menggunakan jendela peringatan
        echo '<script>alert("Email '.$email.' tidak terdaftar sebagai FUNGSIONARIS HIMPROTE FT UNNES.");</script>';
       
        // Redirect ke halaman utama
        echo '<script>window.location.href = "../index.html";</script>';
        exit;
    }
} else {
    // Redirect ke halaman utama jika tidak ada email yang dikirimkan
    echo '<script>window.location.href = "../index.html";</script>';
    exit;
}
?>
