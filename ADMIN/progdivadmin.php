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
                    <label for="email">Pilih Ketua Melalui Email *</label>

                    <input type="keterangan" id="email" name="email" required>
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
            <div class="anggotadiv">
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
                Elektro Bersuara
              </div>
              <div class="nama-ketua">
                Ketua: Haikal Rijaldi

              </div>
              <div id="pengaturanprogja"> <i id="openPopupBtn7" class="fa-solid fa-cog"></i>
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
              <div class="choice-item active" data-target="administrasi">
                <span>Administrasi</span>
              </div>
              <div class="choice-item" data-target="persiapan">
                <span>Persiapan</span>
              </div>
              <div class="choice-item" data-target="hari-acara">
                <span>Hari Acara</span>
              </div>
          
                  <i  id="openPopupBtn1" class="fa-solid fa-circle-plus"></i>
            
            </div>
            
          </section>
         


          <section id="job-list">
            <div class="job-list">
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

                  <!-- More info 1 -->
                  <div class="jobdesk-more-info">
                    More info
                    <button class="more-info" data-popup-id="moreInfo1">
                      <i class="fa-solid fa-circle-exclamation"></i>
                    </button>
                    <!-- Popup 1 -->
                    <div id="moreInfo1" class="popup">
                      <div class="popup-content">
                        <span class="close">&times;</span>
                        <h2>Details 1</h2>
                        <div class="form">
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
                  <!-- End More info 1 -->

                  <div class="icon-container">
                    <div class="jobdesk-edit">
                   
                    
                   
                    </div>
                    <div id="popup2" class="popup">
                      <div class="popup-content">
                        <span id="closePopupBtn2" class="close">&times;</span>
                        <h2>Silahkan isi form</h2>
                        <div class="form">
                          <label for="namaedit2">Nama *</label>
                          <input type="text" id="namaedit2" name="nama" required>
                          <label for="keteranganCreate2">Keterangan *</label>
                          <input type="text" id="keteranganedit2" name="keterangan" required>
                          <label for="email">Pilih Ketua Melalui Email *</label>
                          <input type="email" id="email" name="email" required>
                          <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
                        </div>
                      </div>
                    </div>
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

                  <!-- More info 2 -->
                  <div class="jobdesk-more-info">
                    More info
                    <button class="more-info" data-popup-id="moreInfo2">
                      <i class="fa-solid fa-circle-exclamation"></i>
                    </button>
                    <!-- Popup 2 -->
                    <div id="moreInfo2" class="popup">
                      <div class="popup-content">
                        <span class="close">&times;</span>
                        <h2>Details 2</h2>
                        <div class="form">
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
                  <!-- End More info 2 -->

                  <div class="icon-container">
                    <div class="jobdesk-edit">
                   
                      </button>
                    </div>
                    <div id="popup2" class="popup">
                      <div class="popup-content">
                        <span id="closePopupBtn2" class="close">&times;</span>
                        <h2>Silahkan isi form</h2>
                        <div class="form">
                          <label for="namaedit2">Nama *</label>
                          <input type="text" id="namaedit2" name="nama" required>
                          <label for="keteranganCreate2">Keterangan *</label>
                          <input type="text" id="keteranganedit2" name="keterangan" required>
                          <label for="email">Pilih Ketua Melalui Email *</label>
                          <input type="email" id="email" name="email" required>
                          <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
                        </div>
                      </div>
                    </div>
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
                <div class="jobdesk-content">
                  <div class="jobdesk-title">LPJ Hari Acara</div>
                  <div class="jobdesk-subtitle">
                    Electrical Campus Observation
                  </div>

                  <!-- More info 3 -->
                  <div class="jobdesk-more-info">
                    More info
                    <button class="more-info" data-popup-id="moreInfo3">
                      <i class="fa-solid fa-circle-exclamation"></i>
                    </button>
                    <!-- Popup 3 -->
                    <div id="moreInfo3" class="popup">
                      <div class="popup-content">
                        <span class="close">&times;</span>
                        <h2>Details 3</h2>
                        <div class="form">
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
                  <!-- End More info 3 -->

                  <div class="icon-container">
                    <div class="jobdesk-edit">
                    
                    </div>
                    <div id="popup2" class="popup">
                      <div class="popup-content">
                        <span id="closePopupBtn2" class="close">&times;</span>
                        <h2>Silahkan isi form</h2>
                        <div class="form">
                          <label for="namaedit2">Nama *</label>
                          <input type="text" id="namaedit2" name="nama" required>
                          <label for="keteranganCreate2">Keterangan *</label>
                          <input type="text" id="keteranganedit2" name="keterangan" required>
                          <label for="email">Pilih Ketua Melalui Email *</label>
                          <input type="email" id="email" name="email" required>
                          <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i>Submit</button>
                        </div>
                      </div>
                    </div>
                    <i class="fa-solid fa-pencil" id="icon1"></i>
                    <i class="fa-solid fa-trash" id="icon2"></i>
                  </div>
                </div>
              </div>
            </div>

              <script>
              document.addEventListener("DOMContentLoaded", function() {
                const choiceItems = document.querySelectorAll(".choice-item");
                const jobDeskItems = document.querySelectorAll(".jobdesk");

                choiceItems.forEach(item => {
                  item.addEventListener("click", function() {
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
                <div class="popup-content">
                  <span id="closePopupBtn1" class="close">&times;</span>
                  <h2>Silahkan isi form</h2>
                  <div class="form">
                    <label for="namaCreate">Nama *</label>
                    <input type="nama" id="namaCreate" name="nama" required>
                    <label for="keteranganCreate">Keterangan *</label>
                    <input type="keterangan" id="keteranganCreate" name="keterangan" required>

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

          </section>
        </div>

        <div class="slide fade">
          <div class="button-back">
            <button class="back" onclick="changeSlide(1)">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div class="slider">
              <a class="prev" onclick="changeSlide(-2)">&#10094;</a>
              <a class="next" onclick="changeSlide(-3)">&#10095;</a>
            </div>
          </div>
          <form method="POST" action="create.php">
            <div class="popup-content">
              <span id="closePopupBtn1" class="close">&times;</span>
              <h2>Silahkan isi form</h2>
              <div class="form">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
                <label for="name">Nama *</label>
                <input type="text" id="name" name="name" required>
                <label for="division">Pilih Departemen*</label>
                <select id="division" name="division" required>
                  <option value="">--Pilih Departemen--</option>
                  <option value="Pengurus Harian">Pengurus Harian</option>
                  <option value="Departemen A">Departemen A</option>
                  <option value="Departemen B">Departemen B</option>
                  <option value="Departemen C">Departemen C</option>
                  <option value="Departemen D">Departemen D</option>
                  <option value="Departemen E">Departemen E</option>
                  <option value="Departemen F">Departemen F</option>
                </select>
                <label for="position">Jabatan *</label>
                <select id="position" name="position" required>
                  <option value="">--Pilih Jabatan--</option>
                  <option value="Ketua HIMPROTE">Ketua HIMPROTE</option>
                  <option value="Wakil Ketua HIMPROTE">Wakil Ketua HIMPROTE</option>
                  <option value="Sekretaris umum">Sekretaris umum</option>
                  <option value="Bendahara umum">Bendahara umum</option>
                  <option value="Sekretaris 2">Sekretaris 2</option>
                  <option value="Bendahara 2">Bendahara 2</option>
                  <option value="Ketua Departemen">Ketua Departemen</option>
                  <option value="Sekretaris Departemen">Sekretaris Departemen</option>
                  <option value="Staff Ahli">Staff Ahli</option>
                  <option value="Staf Muda">Staff Muda</option>
                </select>
                <button type="submit" class="submit-button"><i class="fas fa-upload"></i> Submit</button>
              </div>
            </div>
            <script src="popup.js"></script>
          </form>
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