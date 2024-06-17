<?php
session_start();
include '../db.php'; // Ubah sesuai dengan lokasi file koneksi database Anda

// Periksa apakah ID program kerja diterima dari URL
if (isset($_GET['program_id'])) {
    $program_id = $_GET['program_id'];

    // Query untuk mendapatkan detail program kerja
    $sql = "SELECT pk.id, pk.nama, pk.deskripsi, a.nama AS ketua_nama 
            FROM ProgramKerja pk 
            JOIN akun a ON pk.ketua_email = a.email 
            WHERE pk.id = '$program_id'";
    
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $program = $result->fetch_assoc();
        $nama_progja = htmlspecialchars($program['nama']); // Simpan nama progja ke variabel
        $deskripsi = htmlspecialchars($program['deskripsi']); // Simpan deskripsi ke variabel
        $ketua_nama = htmlspecialchars($program['ketua_nama']); // Simpan nama ketua ke variabel
        $conn->close();

    } else {
        // Jika program kerja tidak ditemukan
        $conn->close();
        echo "<script>alert('Program kerja tidak ditemukan.'); window.history.back();</script>";
        exit;
    }
} else {
    // Jika ID program kerja tidak diterima
    echo "<script>alert('ID program kerja tidak diterima.'); window.history.back();</script>";
    exit;
}
?>
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
        <div class="slide fade">

          <div class="button-back">
          <button class="back" onclick="window.location.href = 'progdivadmin.php';">
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
                Ketua:  <?php echo htmlspecialchars($program['ketua_nama']); ?>
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

      
       
  </main>

</body>


</html>