<?php
session_start();
include '../Database/db.php'; // Ubah sesuai dengan lokasi file koneksi database Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama_input = $_POST['nama'];
    $division = $_POST['division'];

    // Pisahkan nama-nama menjadi array berdasarkan koma atau baris baru
    $nama_array = preg_split('/\r\n|[\r\n]|,/', $nama_input);

    // Ambil program_id dari session atau URL
    $program_id = isset($_SESSION['program_id']) ? $_SESSION['program_id'] : '';

    // Pastikan program_id yang dimasukkan ada di tabel programkerja
    $sqlCheckProgram = "SELECT id FROM ProgramKerja WHERE id = '$program_id'";
    $resultCheckProgram = $conn->query($sqlCheckProgram);

    if ($resultCheckProgram && $resultCheckProgram->num_rows > 0) {
        // Program kerja ditemukan, lanjutkan dengan penambahan divisi
        // Lakukan validasi data jika diperlukan

        // Cetak program_id yang ditemukan (opsional, untuk keperluan debugging)
        echo "Program ID: " . $program_id . "<br>";

        // Cek apakah divisi sudah ada dalam tabel Divisi
        $sqlCheckDivisi = "SELECT id FROM Divisi WHERE nama = '$division' AND program_id = '$program_id'";
        $resultCheckDivisi = $conn->query($sqlCheckDivisi);

        if ($resultCheckDivisi && $resultCheckDivisi->num_rows > 0) {
            // Jika divisi sudah ada, ambil id divisi tersebut
            $rowDivisi = $resultCheckDivisi->fetch_assoc();
            $divisi_id = $rowDivisi['id'];
        } else {
            // Jika divisi belum ada, tambahkan divisi baru ke tabel Divisi
            $sqlInsertDivisi = "INSERT INTO Divisi (nama, program_id) VALUES ('$division', '$program_id')";
            if ($conn->query($sqlInsertDivisi)) {
                $divisi_id = $conn->insert_id; // Ambil id divisi yang baru ditambahkan
            } else {
                echo "Error: " . $sqlInsertDivisi . "<br>" . $conn->error;
                exit;
            }
        }

        // Ambil email_pengguna dari session atau sesuai dengan kebutuhan aplikasi Anda
        $email_pengguna = isset($_SESSION['email']) ? $_SESSION['email'] : '';

        // Loop untuk menyimpan setiap nama ke dalam tabel PenggunaProgramDivisi
        foreach ($nama_array as $nama) {
            // Cari email pengguna berdasarkan nama dari tabel akun
            $sqlSearchEmail = "SELECT email FROM akun WHERE nama = '$nama'";
            $resultSearchEmail = $conn->query($sqlSearchEmail);

            if ($resultSearchEmail && $resultSearchEmail->num_rows > 0) {
                $rowEmail = $resultSearchEmail->fetch_assoc();
                $email_pengguna = $rowEmail['email'];

                // Periksa apakah pengguna sudah terdaftar di divisi yang sama
                $sqlCheckExisting = "SELECT * FROM PenggunaProgramDivisi WHERE email_pengguna = '$email_pengguna' AND program_id = '$program_id' AND divisi_id = '$divisi_id'";
                $resultCheckExisting = $conn->query($sqlCheckExisting);

                if ($resultCheckExisting && $resultCheckExisting->num_rows > 0) {
                    // Pengguna sudah terdaftar di divisi yang sama, lanjutkan ke pengguna berikutnya
                    continue;
                }

                // Query untuk menyimpan data ke tabel PenggunaProgramDivisi
                $sqlInsertPenggunaProgramDivisi = "INSERT INTO PenggunaProgramDivisi (email_pengguna, program_id, divisi_id) VALUES ('$email_pengguna', '$program_id', '$divisi_id')";

                // Gunakan transaction untuk menjalankan query
                $conn->begin_transaction();

                // Tambahkan pengguna ke divisi
                $insertSuccess = true;
                if (!$conn->query($sqlInsertPenggunaProgramDivisi)) {
                    $insertSuccess = false;
                }

                // Check if all queries were successful
                if ($insertSuccess) {
                    $conn->commit();
                    // Redirect ke halaman utama atau halaman lainnya setelah berhasil disimpan
                    echo "<script>alert('Berhasil Menambahkan Anggota Baru'); </script>";
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                } else {
                    $conn->rollback(); // Rollback transaksi jika terjadi kesalahan
                    echo "Error: Gagal menyimpan data pengguna ke divisi.";
                    exit;
                }
            } else {
                // Jika nama tidak ditemukan
                echo "<script>alert('Nama pengguna \"$nama\" tidak ditemukan.'); window.history.back();</script>";
                exit;
            }
        }
    } else {
        // Program kerja tidak ditemukan
        echo "<script>alert('Program kerja dengan ID: $program_id tidak ditemukan.'); window.history.back();</script>";
        exit;
    }
}

$conn->close();
?>
