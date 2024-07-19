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
      position: relative;
      background-color: #ccc; /* Default color */
    }

    .post:hover::after {
      content: attr(data-title);
      position: absolute;
      left: 100%;
      margin-left: 10px;
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 5px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      white-space: nowrap;
      z-index: 10; /* Make sure tooltip is on top */
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

    .back-button {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 0px 8px;
    border-radius: 7px;
    cursor: pointer;
    transition: background-color 0.3s ease;
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
  <a href="progdiv.php" class="back-button"><i class="fa-solid fa-arrow-left-long"></i></a>
    <h1>Rekap Program Kerja</h1>

    <?php
    session_start();
    include '../Database/db.php';


// Ambil email dari session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

if (empty($email)) {
    die("Email ketua tidak ditemukan di sesi.");
}


// Periksa apakah email ada di tabel akun dengan role admin
$adminCheckQuery = "SELECT role FROM akun WHERE email = ? AND role = 'admin'";
$stmt = $conn->prepare($adminCheckQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  // Email ditemukan dengan peran admin, jalankan query utama
  $query = "SELECT 
              pk.id AS program_id, pk.nama AS program_nama, 
              d.id AS divisi_id, d.nama AS divisi_nama,
              p.id AS post_id, p.judul AS post_judul, p.validasi, p.file
            FROM 
              programkerja pk
              LEFT JOIN divisi d ON pk.id = d.program_id
              LEFT JOIN post p ON d.id = p.divisi_id
            ORDER BY 
              pk.id, d.id, p.id";
} else {
  // Email tidak ditemukan dengan peran admin, jalankan query untuk ketua
  $query = "SELECT 
              pk.id AS program_id, pk.nama AS program_nama, 
              d.id AS divisi_id, d.nama AS divisi_nama,
              p.id AS post_id, p.judul AS post_judul, p.validasi, p.file
            FROM 
              programkerja pk
              LEFT JOIN divisi d ON pk.id = d.program_id
              LEFT JOIN post p ON d.id = p.divisi_id
            WHERE 
              pk.ketua_email = ?
            ORDER BY 
              pk.id, d.id, p.id";
}

// Jalankan query yang sesuai
if ($stmt->num_rows > 0) {
  $result = $conn->query($query);
} else {
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
}


    $current_program_id = null;
    $current_divisi_id = null;
    $divisi_posts = [];

    while ($row = $result->fetch_assoc()) {
        if ($row['program_id'] !== $current_program_id) {
            if ($current_divisi_id !== null) {
                echo "<div class='divisi program-divisi divisi-{$current_program_id}'>";
                echo "<h3>{$current_divisi_nama}</h3>";
                echo "<p>Jumlah Jobdesk: " . count($divisi_posts) . "</p>";
                echo "<div class='post-box'>";
                foreach ($divisi_posts as $post) {
                    $class = '';
                    if ($post['validasi'] == 1) {
                        $class = 'validasi-1';
                    } elseif ($post['validasi'] == 0 && $post['file'] !== null) {
                        $class = 'validasi-0-file';
                    } else {
                        $class = 'validasi-0-no-file';
                    }
                    echo "<div class='post $class' data-title='" . htmlspecialchars($post['judul'], ENT_QUOTES, 'UTF-8') . "'></div>";
                }
                echo "</div>";
                echo "</div>";
            }

            echo "<h2 onclick=\"toggleDivisi('divisi-{$row['program_id']}')\">{$row['program_nama']} <i class='fas fa-chevron-down'></i></h2>";
            $current_program_id = $row['program_id'];
            $current_divisi_id = null;
        }

        if ($row['divisi_id'] !== $current_divisi_id) {
            if ($current_divisi_id !== null) {
                echo "<div class='divisi program-divisi divisi-{$current_program_id}'>";
                echo "<h3>{$current_divisi_nama}</h3>";
                echo "<p>Jumlah Jobdesk: " . count($divisi_posts) . "</p>";
                echo "<div class='post-box'>";
                foreach ($divisi_posts as $post) {
                    $class = '';
                    if ($post['validasi'] == 1) {
                        $class = 'validasi-1';
                    } elseif ($post['validasi'] == 0 && $post['file'] !== null) {
                        $class = 'validasi-0-file';
                    } else {
                        $class = 'validasi-0-no-file';
                    }
                    echo "<div class='post $class' data-title='" . htmlspecialchars($post['judul'], ENT_QUOTES, 'UTF-8') . "'></div>";
                }
                echo "</div>";
                echo "</div>";
            }

            $current_divisi_id = $row['divisi_id'];
            $current_divisi_nama = $row['divisi_nama'];
            $divisi_posts = [];
        }

        if ($row['post_id'] !== null) {
            $divisi_posts[] = [
                'judul' => $row['post_judul'],
                'validasi' => $row['validasi'],
                'file' => $row['file']
            ];
        }
    }

    if ($current_divisi_id !== null) {
        echo "<div class='divisi program-divisi divisi-{$current_program_id}'>";
        echo "<h3>{$current_divisi_nama}</h3>";
        echo "<p>Jumlah Jobdesk: " . count($divisi_posts) . "</p>";
        echo "<div class='post-box'>";
        foreach ($divisi_posts as $post) {
            $class = '';
            if ($post['validasi'] == 1) {
                $class = 'validasi-1';
            } elseif ($post['validasi'] == 0 && $post['file'] !== null) {
                $class = 'validasi-0-file';
            } else {
                $class = 'validasi-0-no-file';
            }
            echo "<div class='post $class' data-title='" . htmlspecialchars($post['judul'], ENT_QUOTES, 'UTF-8') . "'></div>";
        }
        echo "</div>";
        echo "</div>";
    }
    ?>

</div>

  <script>
    function toggleDivisi(divisiClass) {
      const divisis = document.querySelectorAll('.' + divisiClass);
      divisis.forEach(divisi => {
        if (divisi.style.display === "none" || divisi.style.display === "") {
          divisi.style.display = "block";
        } else {
          divisi.style.display = "none";
        }
      });
    }
  </script>






</body>
</html>
