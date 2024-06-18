<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Kerja, Divisi, dan Post</title>
  <link rel="stylesheet" href="progdivadmin.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Global styles */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f0f0;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    h1, h2, h3 {
      margin-bottom: 10px;
      color: #007bff;
      cursor: pointer;
      display: flex;
      align-items: center;
    }

    h2 {
      font-size: 1.5rem;
    }

    h3 {
      font-size: 1.2rem;
    }

    .program-divisi {
      margin-bottom: 20px;
    }

    .divisi {
      margin-bottom: 15px;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #f9f9f9;
      display: none; /* Sembunyikan divisi secara default */
    }

    .post-box {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
    }

    .post {
      width: 25px;
      height: 25px;
      border-radius: 5px;
      margin: 3px;
      display: inline-block;
    }

    .validasi-1 {
      background-color: #28a745; /* Hijau */
    }

    .validasi-0-file {
      background-color: #f39c12; /* Orange */
    }

    .validasi-0-no-file {
      background-color: #dc3545; /* Merah */
    }

    /* Anak panah dropdown */
    .fa-chevron-down {
      margin-left: 5px;
    }

    /* Responsif */
    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }
      h2 {
        font-size: 1.4rem;
      }
      h3 {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Rekap Program Kerja</h1>

    <?php
// Menggunakan include untuk menyertakan file db.php yang mengandung koneksi ke database
include '../db.php';

// Query untuk mendapatkan semua program kerja beserta divisi dan jumlah post per divisi
$query = "SELECT 
            pk.id AS program_id, pk.nama AS program_nama, 
            d.id AS divisi_id, d.nama AS divisi_nama,
            p.judul,  -- Assuming this column stores the title of the post
            COUNT(p.id) AS jumlah_post,
            COUNT(CASE WHEN p.validasi = 1 THEN p.id END) AS validasi_1_count,
            COUNT(CASE WHEN p.validasi = 0 AND p.file IS NOT NULL THEN p.id END) AS validasi_0_file_count
          FROM 
            programkerja pk
            LEFT JOIN divisi d ON pk.id = d.program_id
            LEFT JOIN post p ON d.id = p.divisi_id
          GROUP BY 
            pk.id, pk.nama, d.id, d.nama, p.judul
          ORDER BY 
            pk.id, d.id";


$result = $conn->query($query);

// Memeriksa jika query berhasil dieksekusi
if (!$result) {
    die("Query error: " . $conn->error);
}

// Inisialisasi variabel untuk menyimpan program dan divisi saat ini
$current_program_id = null;
$current_divisi_id = null;

// Loop through the results and display data
while ($row = $result->fetch_assoc()) {
    // Jika program kerja berubah, tampilkan nama program kerja baru
    if ($row['program_id'] !== $current_program_id) {
        // Tampilkan nama program kerja sebagai judul h2 yang bisa di-klik
        echo "<h2 onclick=\"toggleDivisi('divisi-{$row['program_id']}')\">{$row['program_nama']} <i class='fas fa-chevron-down'></i></h2>";
        // Simpan program_id saat ini
        $current_program_id = $row['program_id'];
    }

    // Tampilkan divisi dan jumlah postnya dengan class yang spesifik
    echo "<div class='divisi program-divisi divisi-{$row['program_id']}'>";
    echo "<h3>{$row['divisi_nama']}</h3>";
    echo "<p>Jumlah Post: {$row['jumlah_post']}</p>";

    // Tentukan warna untuk setiap kotak post berdasarkan validasi dan keberadaan file
    echo "<div class='post-box'>";
    for ($i = 0; $i < $row['jumlah_post']; $i++) {
        $class = '';
        if ($i < $row['validasi_1_count']) {
            $class = 'validasi-1'; // Hijau
        } elseif ($i < $row['validasi_0_file_count']) {
            $class = 'validasi-0-file'; // Orange
        } else {
            $class = 'validasi-0-no-file'; // Merah
        }

        // Tampilkan nama post di samping dot
       
        echo "<div class='post $class' ></div>";
    }
    echo "</div>"; // tutup post-box
    echo "</div>"; // tutup divisi
}

// Tutup koneksi database
$conn->close();
?>


  </div>

  <footer>
    <script src="/Assets/js/nav.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="popup.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script>
      // Fungsi untuk menampilkan atau menyembunyikan divisi saat program kerja di-klik
      function toggleDivisi(divisiClass) {
        let divisiElements = document.querySelectorAll(`.${divisiClass}`);
        divisiElements.forEach(divisi => {
          divisi.style.display = (divisi.style.display === 'none' || divisi.style.display === '') ? 'block' : 'none';
        });
      }
    </script>
  </footer>
</body>
</html>
