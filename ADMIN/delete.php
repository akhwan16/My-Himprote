<?php
include '../db.php';

// Pastikan email yang akan dihapus ada dalam permintaan POST
if(isset($_POST['email'])) {
    // Tangkap email dari permintaan POST
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Buat query untuk mendapatkan peran (role) pengguna berdasarkan email
    $role_query = "SELECT role FROM akun WHERE email='$email'";
    $role_result = $conn->query($role_query);

    if ($role_result->num_rows > 0) {
        // Ambil peran (role) dari hasil query
        $row = $role_result->fetch_assoc();
        $role = $row['role'];

        // Periksa apakah peran (role) adalah admin
        if ($role === 'admin') {
            // Jika peran (role) adalah admin, kirimkan respons "error" ke klien
            echo "admin tidak boleh dihapus";
        } else {
            // Buat query untuk menghapus data dengan email yang sesuai dari tabel akun
            $delete_query = "DELETE FROM akun WHERE email='$email'";

            // Jalankan query penghapusan
            if ($conn->query($delete_query) === TRUE) {
                // Jika penghapusan berhasil, kirimkan respons "success" ke klien
                echo "success";
            } else {
                // Jika terjadi kesalahan saat penghapusan, kirimkan respons "error" ke klien
                echo "error";
            }
        }
    } else {
        // Jika tidak ada data yang cocok dengan email, kirimkan respons "error" ke klien
        echo "error";
    }
} else {
    // Jika permintaan POST tidak menyertakan email, kirimkan respons "error" ke klien
    echo "error";
}
?>
