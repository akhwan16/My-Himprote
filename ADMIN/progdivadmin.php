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
            <form method="GET" action="">
              <div class="search-wrapper">
                <input type="text" class="search-box" name="q" placeholder="Cari Progja" />
                <button type="submit" class="search-button">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </form>
          </div>
          <section id="progja-list">
            <div class="progja-list">
              <div class="progja">
                <div class="judul">Electrical Campus Observation</div>
                <div class="button">
                  <button class="details" onclick="changeSlide(1)">
                    Details
                  </button>
                  <button class="divisi" onclick="changeSlide(2)">Divisi</button>
                </div>
              </div>
              <div class="progja">
                <div class="judul">Electrical Campus Observation</div>
                <div class="button">
                  <button class="details" onclick="changeSlide(1)">
                    Details
                  </button>
                  <button class="divisi" onclick="changeSlide(2)">Divisi</button>
                </div>
              </div>
              <div class="progja">
                <div class="judul">Electrical Campus Observation</div>
                <div class="button">
                  <button class="details" onclick="changeSlide(1)">
                    Details
                  </button>
                  <button class="divisi" onclick="changeSlide(2)">Divisi</button>
                </div>
              </div>
              <div class="progja">
                <div class="judul">Electrical Campus Observation</div>
                <div class="button">
                  <button class="details" onclick="changeSlide(1)">
                    Details
                  </button>
                  <button class="divisi" onclick="changeSlide(2)">Divisi</button>
                </div>
              </div>

              <div class="progja-create">
                <button id="openPopupBtn2" class="create2">
                  <i class="fa-solid fa-circle-plus"></i>
                </button>
              </div>

              <div id="popup2" class="popup">
                <div class="popup-content2">
                  <span id="closePopupBtn2" class="close2">&times;</span>
                  <h2>Silahkan isi form</h2>
                  <div class="form2">
                    <label for="namaCreate">Nama *</label>
                    <input type="nama" id="namaCreate" name="nama" required>
                    <label for="keteranganCreate">Keterangan *</label>
                    <input type="keterangan" id="keteranganCreate" name="keterangan" required>
                    <label for="kategoriCreate">Kategori *</label>
                    <select id="kategori" name="kategori" required>
                      <option value="administrasi">--Pilih Kategori--</option>
                      <option value="administrasi">Administrasi</option>
                      <option value="persiapan">Persiapan</option>
                      <option value="hari acara">Hari Acara</option>
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
            </div>
          </section>
        </div>

        
        <div class="slide fade">
          <div class="button-back">
            <button class="back" onclick="changeSlide(-1)">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
          </div>
          <section id="progja-ketua">
            <div class="progja-ketua">
              <div class="nama-progja">
                Elektro Bersuara
              </div>
              <div class="nama-ketua">
                Ketua: Haikal Rijaldi
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
<<<<<<< HEAD
            
  <div class="choice">
    
    <div class="choice-item active" data-target="administrasi">
      <span>Administrasi</span>
    </div>
    <div class="choice-item" data-target="persiapan">
      <span>Persiapan</span>
    </div>
    <div class="choice-item" data-target="hari-acara">
      <span>Hari Acara</span>
    </div>
    
  </div>
  
</section>

<section id="job-list">
  
  <div class="job-list">
    
  <div class="jobdesk-create">
=======
            <div class="choice">
              <div class="choice-item" id="administrasi">
                <span>Administrasi</span>
              </div>
              <div class="choice-item" id="Persiapan">
                <span>Persiapan</span>
              </div>
              <div class="choice-item" id="Hari Acara">
                <span>Hari Acara</span>
              </div>
            </div>

            <script>
              document.addEventListener("DOMContentLoaded", function() {
                const choiceItems = document.querySelectorAll(".choice-item");

                choiceItems.forEach(item => {
                  item.addEventListener("click", function() {
                    // Remove active class from all items
                    choiceItems.forEach(i => i.classList.remove("active"));

                    // Add active class to the clicked item
                    this.classList.add("active");

                    // Optional: Scroll to the relevant section or perform any other action

                  });
                });
              });
            </script>
          </section>
          <section id="job-list">
            <div class="job-list">
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
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="icon-container">
                    <i class="fa-solid fa-pencil" id="icon1"></i>
                    <i class="fa-solid fa-trash" id="icon2"></i>
                  </div>
                </div>
              </div>
              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">LPJ</div>
                  <div class="jobdesk-subtitle">
                    Electrical Campus Observation
                  </div>
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="icon-container">
                    <i class="fa-solid fa-pencil" id="icon1"></i>
                    <i class="fa-solid fa-trash" id="icon2"></i>
                  </div>
                </div>
              </div>
              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">LPJ</div>
                  <div class="jobdesk-subtitle">
                    Electrical Campus Observation
                  </div>
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="icon-container">
                    <i class="fa-solid fa-pencil" id="icon1"></i>
                    <i class="fa-solid fa-trash" id="icon2"></i>
                  </div>
                </div>
              </div>



              <div class="jobdesk-create">
>>>>>>> 95358f079b3406d5ce845561eb35f1eb03f6b428
                <button id="openPopupBtn1" class="create">
                  <i class="fa-solid fa-circle-plus"></i>
                </button>
<<<<<<< HEAD
            </div>
    <div class="jobdesk administrasi">
      <input type="checkbox" class="jobdesk-checkbox" />
      <div class="jobdesk-time">
        <i class="fa-solid fa-list-check"></i>
      </div>
      <div class="jobdesk-content">
        <div class="jobdesk-title">Absensi Rapat ELCO</div>
        <div class="jobdesk-subtitle">
          Electrical Campus Observation
        </div>
        <div class="jobdesk-more-info">
          More info <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="icon-container">
          <i class="fa-solid fa-pencil" id="icon1"></i>
          <i class="fa-solid fa-trash" id="icon2"></i>
        </div>
      </div>
    </div>

    <div class="jobdesk persiapan" style="display: none;">
      <input type="checkbox" class="jobdesk-checkbox" />
      <div class="jobdesk-time">
        <i class="fa-solid fa-list-check"></i>
      </div>
      <div class="jobdesk-content">
        <div class="jobdesk-title">LPJ Persiapan</div>
        <div class="jobdesk-subtitle">
          Electrical Campus Observation
        </div>
        <div class="jobdesk-more-info">
          More info <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="icon-container">
          <i class="fa-solid fa-pencil" id="icon1"></i>
          <i class="fa-solid fa-trash" id="icon2"></i>
        </div>
      </div>
    </div>

    <div class="jobdesk hari-acara" style="display: none;">
      <input type="checkbox" class="jobdesk-checkbox" />
      <div class="jobdesk-time">
        <i class="fa-solid fa-list-check"></i>
      </div>
      <div class="jobdesk-content "  >
        <div class="jobdesk-title">LPJ Hari Acara</div>
        <div class="jobdesk-subtitle">
          Electrical Campus Observation
        </div>
        <div class="jobdesk-more-info">
          More info <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="icon-container">
          <i class="fa-solid fa-pencil" id="icon1"></i>
          <i class="fa-solid fa-trash" id="icon2"></i>
        </div>
      </div>
      
    </div>
    
  </div>
  
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const choiceItems = document.querySelectorAll(".choice-item");
  const jobDeskItems = document.querySelectorAll(".jobdesk");

  choiceItems.forEach(item => {
    item.addEventListener("click", function () {
      const target = this.getAttribute("data-target");

      // Remove active class from all choice items
      choiceItems.forEach(i => i.classList.remove("active"));
      // Add active class to the clicked item
      this.classList.add("active");

      // Hide all jobdesk items
      jobDeskItems.forEach(job => {
        job.style.display = "none";
      });

      // Show the jobdesk items corresponding to the clicked category
      document.querySelectorAll(`.jobdesk.${target}`).forEach(job => {
        job.style.display = "";
      });

      // Optional: Scroll to the relevant section or perform any other action
    });
  });
});


</script>
            
            
            <div id="popup1" class="popup">
=======
              </div>

              <div id="popup1" class="popup">
>>>>>>> 95358f079b3406d5ce845561eb35f1eb03f6b428
                <div class="popup-content">
                  <span id="closePopupBtn1" class="close">&times;</span>
                  <h2>Silahkan isi form</h2>
                  <div class="form">
                    <label for="namaCreate">Nama *</label>
                    <input type="nama" id="namaCreate" name="nama" required>
                    <label for="keteranganCreate">Keterangan *</label>
                    <input type="keterangan" id="keteranganCreate" name="keterangan" required>
                    <label for="kategoriCreate">Kategori *</label>
                    <select id="kategori" name="kategori" required>
                      <option value="administrasi">--Pilih Kategori--</option>
                      <option value="administrasi">Administrasi</option>
                      <option value="persiapan">Persiapan</option>
                      <option value="hari acara">Hari Acara</option>
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

              <script src="popup.js"></script>

            </div>
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
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="jobdesk-upload">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                  </div>
                </div>
              </div>
              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">LPJ</div>
                  <div class="jobdesk-subtitle">Electrical Campus Observation</div>
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="jobdesk-upload">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                  </div>
                </div>
              </div>
              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">LPJ</div>
                  <div class="jobdesk-subtitle">Electrical Campus Observation</div>
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="jobdesk-upload">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                  </div>
                </div>
              </div>
              <div class="jobdesk">
                <input type="checkbox" class="jobdesk-checkbox" />
                <div class="jobdesk-time">
                  <i class="fa-solid fa-list-check"></i>
                </div>
                <div class="jobdesk-content">
                  <div class="jobdesk-title">LPJ</div>
                  <div class="jobdesk-subtitle">Electrical Campus Observation</div>
                  <div class="jobdesk-more-info">
                    More info <i class="fa-solid fa-circle-exclamation"></i>
                  </div>
                  <div class="jobdesk-upload">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
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