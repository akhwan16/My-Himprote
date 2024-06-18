<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" href="progdivadmin.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <title>Dashboard</title>
  <style>
  </style>
  <div class="svg-container">
    <div class="header-container">
      <div class="logo">
        <img src="../Assets/img/Group 207.png" alt="Logo" />
      </div>
      <div class="reminder">PROGDIV!</div>
    </div>

<body>
  <main>
    <div class="card fade-in">
      <div class="slideshow-container">
        <div class="slide fade">
        <div class="search-container">
    <form method="GET">
        <div class="search-wrapper">
            <input type="text" class="search-box" name="q" placeholder="Cari Progja" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>"/>
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>
<?php

include '../db.php'; // Pastikan ini mengarah ke file koneksi database yang benar

// Ambil kata kunci pencarian dari URL
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Query SQL untuk mencari program kerja berdasarkan nama
$sql = "SELECT id, nama, deskripsi FROM ProgramKerja WHERE nama LIKE '%$q%'";

$result = $conn->query($sql);

?>
    
          <section id="progja-list">
            <div class="progja-list">
            <?php
session_start();
include '../db.php';

// Ambil email dari session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Ambil role dari tabel akun
$sqlRole = "SELECT role FROM akun WHERE email = '$email'";
$resultRole = $conn->query($sqlRole);

if ($resultRole->num_rows > 0) {
    $rowRole = $resultRole->fetch_assoc();
    $role = $rowRole['role'];
} else {
    // Jika email tidak ditemukan, anggap role sebagai pengguna biasa
    $role = 'user';
}

// Inisialisasi variabel $programs
$programs = [];

// Query untuk mendapatkan program kerja
$sql = "SELECT pk.id, pk.nama, pk.deskripsi, pk.ketua_email 
        FROM ProgramKerja pk ";

// Ambil kata kunci pencarian dari URL
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Query untuk mendapatkan program kerja berdasarkan pencarian
if (!empty($q)) {
    $sql .= "WHERE pk.nama LIKE '%$q%'";
} else {
    if ($role === 'admin') {
        // Jika role adalah admin, tampilkan semua program kerja
        $sql .= "LEFT JOIN PenggunaProgramDivisi ppd ON pk.id = ppd.program_id ";
    } else {
        // Jika bukan admin, tampilkan program kerja yang diikuti oleh pengguna
        $sql .= "LEFT JOIN PenggunaProgramDivisi ppd ON pk.id = ppd.program_id 
                 WHERE ppd.email_pengguna = '$email' ";
        
        // Jika pengguna juga adalah ketua dari suatu program kerja, tambahkan kondisi OR
        $sql .= "OR pk.ketua_email = '$email' ";
    }
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $program_id = $row['id'];
        $nama_program = htmlspecialchars($row['nama']);
        $deskripsi_program = htmlspecialchars($row['deskripsi']);
        $ketua_email = $row['ketua_email'];

        // Query untuk mendapatkan nama ketua berdasarkan email ketua
        $sql_ketua = "SELECT nama FROM akun WHERE email = ?";
        $stmt_ketua = $conn->prepare($sql_ketua);
        $stmt_ketua->bind_param("s", $ketua_email);
        $stmt_ketua->execute();
        $stmt_ketua->bind_result($nama_ketua);
        $stmt_ketua->fetch();
        $stmt_ketua->close();

        // Tambahkan data program ke array $programs
        $programs[] = [
            'id' => $program_id,
            'nama' => $nama_program,
            'deskripsi' => $deskripsi_program,
            'ketua_email' => $ketua_email,
            'nama_ketua' => $nama_ketua
        ];
    }
}

$conn->close();
?>



<?php if (count($programs) > 0) : ?>
              
                <?php foreach ($programs as $program) : ?>
                    <div class="progja">
                        <div class="judul"><?php echo htmlspecialchars($program['nama']); ?> <br>Ketua : <?php echo htmlspecialchars($program['nama_ketua']); ?></div>
                        <div class="konten"> </div>
              
                        <div class="button">
                            <form method="GET" action="details.php">
                            <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
                                <button type="submit"class="fa-solid fa-info-circle" style="background-color: transparent; border:none;  color: darkblue; cursor:pointer;"></button>
                            </form>
                            <form method="GET" action="divisi.php">
                                <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
                                <button type="submit" onclick="changeSlide(2)" class="fa-solid fa-users" style="background-color: transparent; border:none;  color: orange; cursor:pointer; "></button>
                            </form>
                            <?php if ($role === 'admin') : ?>
                                <!-- Form untuk menghapus program kerja -->
                                <form method="POST" action="hapus_program.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program kerja ini?')">
                                    <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
                                    <button type="submit" class="hapus">
                                        <i class="fa-solid fa-trash" style="font-size: 14px; color: darkred;"></i> 
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
           
            <?php endforeach; ?>
        <?php else : ?>
            <p>Tidak ada program kerja</p>
        <?php endif; ?>
              <div class="progja-create">
                
              <?php if ($role === 'admin') : ?>
        <button id="openPopupBtn2" class="create2">
            <i class="fa-solid fa-circle-plus"></i> 
        </button>
    <?php endif; ?>
              </div>

              <div id="popup2" class="popup">
                <div class="popup-content2">
                  <span id="closePopupBtn2" class="close2">&times;</span>
                  <h2>Silahkan isi form</h2>
                  <form  method="POST" action="tambah_progja.php" class="form2">
                
                    <label for="namaCreate">Nama *</label>
                    <input type="nama" id="namaCreate" name="nama" required>
                    <label for="DeskripsiCreate">Deskripsi *</label>
                    <input type="keterangan" id="keteranganCreate" name="keterangan"  required>
                    
                    <label for="email">Pilih Ketua Melalui Email *</label>

                    <input type="keterangan" id="email" name="email"required>
                    <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
              
                </form>
              </div>
            </div>
          </section>
        </div>



              <script src="popup.js"></script>
          </section>
        </div>

        <div class="slide fade">
          <section id="divisiku">
            <div class="button-back2">
              <button class="back2" onclick="changeSlide(-2)">
                <i class="fa-solid fa-arrow-left"></i>
              </button>
              <div class="divisiku">
                <img src="/Assets/img/div.png" alt="" />HUMAS
              </div>
          </section>

          <section id="job-list">
            <div class="job-list">
              <div class="progress">Progress</div>
              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">Absensi Rapat ELCO</div>
                  <div class="jobdesk-subtitle">Electrical Campus Observation</div>
                  <!--EDITT BENTAR -->
                  <!--more info-->
                  <div class="jobdesk-more-info divisi">
                    More info
                    <button id="openPopupBtn4" class="more-info divisi">
                      <i class="fa-solid fa-circle-exclamation"></i>
                    </button>
                    <!--more info-->
                    <div id="popup4" class="popup">

                      <div class="popup-content">
                        <span id="closePopupBtn4" class="close">&times;</span>
                        <h2>More Info</h2>
                        <div class="form4">
                          <p>
                            1. Meminta tanda tangan untuk surat- surat dan proposal. <br>
                            2. Mencari tempat lomba. (bersama sie perkap) <br>
                            3. Mengantar dan mengecek semua surat-surat kegiatan. <br>
                            4. Menghubungi komting kelas/rombel untuk menyiapkan tim dan pendaftaran <br>
                            5. Menghubungi tamu undangan. <br>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="upload-container">
                    <label for="file-upload" class="custom-file-upload">
                      <i class="fas fa-arrow-up-from-bracket"></i>
                    </label>
                    <input id="file-upload" type="file" name="upload">
                  </div>
                </div>

          </section>
        </div>

       
  </main>

</body>

<footer>
  <div class="navbar">
    <div class="navbar-item" id="home">
      <i class="fas fa-home"></i>
      <span>Beranda</span>
    </div>
    <div class="navbar-item active" id="jobdesk">
      <i class="fas fa-tasks"></i>
      <span>Progdiv</span>
    </div>
    <div class="navbar-item" id="profile">
      <i class="fas fa-user"></i>
      <span>Profil</span>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var homeNavItem = document.getElementById("home");
      homeNavItem.addEventListener("click", function() {
        // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
        window.location.href = "dashboardadmin.php"; // Ganti "progdivadmin1.html" dengan URL yang sesuai
      });
      var profileNavItem = document.getElementById("profile");
      profileNavItem.addEventListener("click", function() {
        // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
        window.location.href = "profile.php"; // Ganti "profile.php" dengan URL yang sesuai
      });
    });
  </script>
  <script src="/Assets/js/nav.js"></script>
  <script src="/Assets/js/calendar.js"></script>
  <script src="/Assets/js/slide.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  <script src="/script.js"></script>
</footer>

</html>