<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="progdivadmin.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <title>Dashboard</title>

    <div class="svg-container">
      <div class="header-container">
        <div class="logo">
          <img src="../Assets/img/Group 207.png" alt="Logo" />
        </div>
        <div class="reminder">PROGDIV!</div>
      </div>
    </div>
  </head>

  <body>
    <main>
      <div class="slideshow-container">
        <div class="slide fade">
          <div class="search-container">
            <form method="GET" action="">
              <div class="search-wrapper">
                <input
                  type="text"
                  class="search-box"
                  name="q"
                  placeholder="Cari Progja"
                />
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
              document.addEventListener("DOMContentLoaded", function () {
                const choiceItems = document.querySelectorAll(".choice-item");
              
                choiceItems.forEach(item => {
                  item.addEventListener("click", function () {
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
                <button id="openPopupBtn1" class="create">
                    <i class="fa-solid fa-circle-plus"></i>
                </button>
            </div>
            
            <div id="popup1" class="popup">
                <div class="popup-content">
                    <span id="closePopupBtn1" class="close">&times;</span>
                    <h2>Silahkan isi form</h2>
                    <div class="form">
                        <label for="emailCreate">Email *</label>
                        <input type="email" id="emailCreate" name="email" required>
                        <label for="nameCreate">Nama *</label>
                        <input type="text" id="nameCreate" name="name" required>
                        <label for="divisionCreate">Pilih Departemen*</label>
                        <select id="divisionCreate" name="division" required>
                            <option value="">--Pilih Departemen--</option>
                            <option value="Pengurus Harian">Pengurus Harian</option>
                            <option value="Departemen A">Departemen A</option>
                            <option value="Departemen B">Departemen B</option>
                            <option value="Departemen C">Departemen C</option>
                            <option value="Departemen D">Departemen D</option>
                            <option value="Departemen E">Departemen E</option>
                            <option value="Departemen F">Departemen F</option>
                        </select>
                        <label for="positionCreate">Jabatan *</label>
                        <select id="positionCreate" name="position" required>
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
                            <option value="Staf Muda">Staf Muda</option>
                        </select>
                        <button type="submit" class="submit-button">
                            <i class="fas fa-upload"></i> Submit
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
    </main>
  </body>
  
  <?php 
    include "/My-Himprote/layout/footer.html"
  ?>

</html>