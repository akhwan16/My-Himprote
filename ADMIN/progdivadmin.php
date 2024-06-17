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
$sql = "SELECT pk.id, pk.nama, pk.deskripsi 
        FROM ProgramKerja pk ";
// Ambil kata kunci pencarian dari URL
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Query untuk mendapatkan program kerja berdasarkan pencarian
if (!empty($q)) {
    $sql = "SELECT pk.id, pk.nama, pk.deskripsi 
            FROM ProgramKerja pk
            WHERE pk.nama LIKE '%$q%'";
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
        $programs[] = $row;
    }
}

$conn->close();
?>



<?php if (count($programs) > 0) : ?>
              
                <?php foreach ($programs as $program) : ?>
                    <div class="progja">
                        <div class="judul"><?php echo htmlspecialchars($program['nama']); ?></div>
              
                        <div class="button">
                            <form method="GET" action="details.php">
                            <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
                                <button type="submit"class="fa-solid fa-info-circle" style="background-color: transparent; border:none; cursor:pointer;"></button>
                            </form>
                            <form method="GET" action="divisi.php">
                                <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
                                <button type="submit" onclick="changeSlide(2)" class="fa-solid fa-users" style="background-color: transparent; border:none; cursor:pointer;"></button>
                            </form>
                            <?php if ($role === 'admin') : ?>
                                <!-- Form untuk menghapus program kerja -->
                                <form method="POST" action="hapus_program.php" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program kerja ini?')">
                                    <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
                                    <button type="submit" class="hapus">
                                        <i class="fa-solid fa-trash" style="font-size: 14px; color: black;"></i> 
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

        <div class="slide fade">

          <div class="button-back">

            <button class="back" onclick="changeSlide(-1)">
              <i class="fa-solid fa-arrow-left"></i>

            </button>

            <!--more info-->
            <div id="popup7" class="popup">

              <div class="popup-content">
                <span id="closePopupBtn7" class="close">&times;</span>

                <h2>Silahkan isi form</h2>
                <div class="form">
                  <label for="namaCreate">Nama *</label>
                  <input type="nama" id="namaCreate" name="nama" required>
                  <label for="division">Pilih Divisi *</label>
                  <select id="division" name="division" required>
                    <option value="">--Pilih Divisi--</option>
                    <option value="Acara">Acara</option>
                    <option value="Kreatif">Kreatif</option>
                    <option value="Humas">Humas</option>
                    <option value="Perkab">Perkab</option>
                    <option value="PDD">PDD</option>
                    <option value="Kestari">Kestari</option>
                    <option value="Konsumsi">Konsumsi</option>
                    <option value="P3K">P3K</option>
                    <option value="Disman">Disman</option>
                    <option value="Korlap">Korlap</option>
                  </select>
                  <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
                  </button>
                </div>
              </div>
            </div>

            <!-- Popup 6 -->
            <div class="anggotadiv">
              <div id="popup6" class="popup">
                <div class="popup-content">
                  <span id="closePopupBtn6" class="close">&times;</span>
                  <h2>Daftar Anggota</h2>
                  <div class="list-view" id="listView">
                    <!-- Example Items -->
                    <div class="list-item">
                      <div class="field">John Doe - HR</div>
                      <div class="delete-icon"><i class="fas fa-trash-alt"></i></div>
                    </div>
                    <div class="list-item">
                      <div class="field">Jane Smith - Marketing</div>
                      <div class="delete-icon"><i class="fas fa-trash-alt"></i></div>
                    </div>
                    <div class="list-item">
                      <div class="field">Alice Johnson - IT</div>
                      <div class="delete-icon"><i class="fas fa-trash-alt"></i></div>
                    </div>
                    <!-- Add more items here as needed, total at least 15 for demo -->
                  </div>
                  <div class="pagination" id="pagination"></div>
                </div>
              </div>
            </div>

            <script>
              // Pagination Functionality
              const itemsPerPage = 10;
              let currentPage = 1;
              const listView = document.getElementById('listView');
              const pagination = document.getElementById('pagination');

              function displayItems(items, page) {
                listView.innerHTML = '';
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const paginatedItems = items.slice(start, end);

                paginatedItems.forEach(item => {
                  listView.appendChild(item);
                });
              }

              function setupPagination(items) {
                pagination.innerHTML = '';
                const pageCount = Math.ceil(items.length / itemsPerPage);
                for (let i = 1; i <= pageCount; i++) {
                  const btn = document.createElement('button');
                  btn.textContent = i;
                  btn.classList.add('page-btn');
                  if (i === currentPage) btn.classList.add('active');
                  btn.addEventListener('click', () => {
                    currentPage = i;
                    displayItems(items, currentPage);
                    document.querySelector('.pagination button.active').classList.remove('active');
                    btn.classList.add('active');
                  });
                  pagination.appendChild(btn);
                }
              }

              // Initial setup
              const listItems = Array.from(document.querySelectorAll('.list-item'));
              setupPagination(listItems);
              displayItems(listItems, currentPage);
            </script>

          </div>

          <section id="progja-ketua">

            <div class="progja-ketua">

              <div class="nama-progja">
              <?php echo htmlspecialchars($program['nama']); ?>
              </div>
              <div class="nama-ketua">
                Ketua: Haikal Rijaldi

              </div>
              <div id="pengaturanprogja"> <i id="openPopupBtn7" class="fa-solid fa-plus"></i>
                <i id="openPopupBtn6" class="fas fa-user-circle"></i>
              </div>
            </div>

          </section>

          <section id="deskripsi">

            <div class="deskripsi">

              <div class="judul">Deskripsi :</div>
              <div class="teks">
                Elektro Bersuara 2024 adalah forum inisiatif HIMPROTE Fakultas
                Teknik Universitas Negeri Semarang, membuka ruang bagi mahasiswa
                Teknik Elektro untuk menyampaikan aspirasi dan solusi inovatif
                kepada pihak birokrasi. Melalui dialog konstruktif, kami
                berharap menjembatani kesenjangan antara mahasiswa dan
                birokrasi, menciptakan lingkungan akademik yang inklusif dan
                responsif. Kegiatan ini bukan hanya wacana, tapi langkah konkret
                menuju perubahan positif bagi kemajuan bersama.
              </div>
            </div>
          </section>

          <section id="choice">
            <div class="choice">
              <div class="choice-item active">
                <span>Administrasi</span>
              </div>
              <div class="choice-item" >
                <span>Persiapan</span>
              </div>
              <div class="choice-item" >
                <span>Hari Acara</span>
              </div>

              <i id="openPopupBtn1" class="fa-solid fa-circle-plus"></i>

            </div>

          </section>

          <div id="popup1" class="popup">
                <div class="popup-content">
                  <span id="closePopupBtn1" class="close">&times;</span>
                  <h2>Silahkan isi form</h2>
                  <div class="form">
                    <label for="namaCreate">Nama *</label>
                    <input type="nama" id="namaCreate" name="nama" required>
                    <label for="deskripsi">More Info *</label>
                    <textarea name="textbox" id="deskripsi-box"></textarea>
                    <label for="kategori">Pilih Kategori *</label>
                    <select id="katgeori" name="katgeori" required>
                      <option value="">--Pilih Kategori--</option>
                      <option value="Administrasi">Administrasi</option>
                      <option value="Persiapan">Persiapan</option>
                      <option value="Harid Acara">Hari Acara</option>
                    </select>
                    <label for="division">Pilih Divisi *</label>
                    <select id="division" name="division" required>
                      <option value="">--Pilih Divisi--</option>
                      <option value="Acara">Acara</option>
                      <option value="Kreatif">Kreatif</option>
                      <option value="Humas">Humas</option>
                      <option value="Perkab">Perkab</option>
                      <option value="PDD">PDD</option>
                      <option value="Kestari">Kestari</option>
                      <option value="Konsumsi">Konsumsi</option>
                      <option value="P3K">P3K</option>
                      <option value="Disman">Disman</option>
                      <option value="Korlap">Korlap</option>
                    </select>
                    <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
                    </button>
                  </div>
                </div>
              </div>

          <section id="job-list">
            <div class="job-list">

              <div class="jobdesk-create">

              </div>

              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">Absensi Rapat ELCO</div>
                  <div class="jobdesk-subtitle">
                    Electrical Campus Observation
                  </div>


                  <!--more info-->
                  <div class="jobdesk-more-info">
                    More info
                    <button id="openPopupBtn3" class="more-info">
                      <i class="fa-solid fa-circle-exclamation"></i>
                    </button>
                    <!--more info-->
                    <div id="popup3" class="popup">

                      <div class="popup-content">
                        <span id="closePopupBtn3" class="close">&times;</span>
                        <h2>More Info</h2>
                        <div class="form3">
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
                  <!--more info-->


                  <div class="icon-container">
                    <i class="fa-solid fa-pencil" id="openPopupBtn8"></i>
                    <!--more info-->
                    <div id="popup8" class="popup">

                      <div class="popup-content">
                        <span id="closePopupBtn8" class="close">&times;</span>

                        <h2>Silahkan isi form</h2>
                        <div class="form">
                          <label for="namaCreate">Nama *</label>
                          <input type="nama" id="namaCreate" name="nama" required>
                          <label for="deskripsi">More Info *</label>
                          <textarea name="textbox" id="deskripsi-box"></textarea>
                          <label for="kategori">Pilih Kategori *</label>
                    <select id="katgeori" name="katgeori" required>
                      <option value="">--Pilih Kategori--</option>
                      <option value="Administrasi">Administrasi</option>
                      <option value="Persiapan">Persiapan</option>
                      <option value="Harid Acara">Hari Acara</option>
                    </select>
                    <label for="division">Pilih Divisi *</label>
                    <select id="division" name="division" required>
                      <option value="">--Pilih Divisi--</option>
                      <option value="Acara">Acara</option>
                      <option value="Kreatif">Kreatif</option>
                      <option value="Humas">Humas</option>
                      <option value="Perkab">Perkab</option>
                      <option value="PDD">PDD</option>
                      <option value="Kestari">Kestari</option>
                      <option value="Konsumsi">Konsumsi</option>
                      <option value="P3K">P3K</option>
                      <option value="Disman">Disman</option>
                      <option value="Korlap">Korlap</option>
                    </select>
                          <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
                          </button>
                        </div>
                      </div>
                    </div>
                    <i class="fa-solid fa-trash" id="icon2"></i>
                  </div>
                </div>

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