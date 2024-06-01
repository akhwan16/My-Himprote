<?php
include 'checkakun.php';
include 'listview.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dashboardadmin1.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .popup {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .popup-content {
            background-color: #fefefe;
            margin: 80px auto;
            padding: 20px;
            border: 1px solid #1f4e79;


            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            border: 3px solid navy;
            max-width: 350px;
        }

        .form {
            display: flex;
            flex-direction: column;
            text-align: left;

        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .search-container {
            margin-top: 20px;
            text-align: center;
            padding-bottom: 20px;
        }

        .search-box {

            padding: 10px;
            /* Tambahkan padding di sisi kanan untuk ikon */
            border: 1px solid #ccc;
            border-radius: 20px;
            width: 280px;
            max-width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        .search-button {

            border: none;
            border-radius: 10px;

            color: #1f4e79;
            font-size: 16px;
            cursor: pointer;
        }

        .action-button {

            border: none;
            background-color: #1f4e79;
            border-radius: 5px;
            border-style: 2px;
            margin-right: 10px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            padding: 10px 10px 10px 10px;
        }




        .containerlist {
            display: flex;
            justify-content: center;
            align-items: center;

            width: 100%;
            height: 100%;
            padding-bottom: 20px;
        }

        .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #1f4e79;
            padding: 5px 10px;
            /* Mengurangi padding */
            width: 80%;
            /* Mengurangi lebar */
            max-width: 280px;
            /* Mengurangi lebar maksimal */
        }

        .card-content {
            display: flex;
            align-items: center;
        }

        .profile-image {
            border-radius: 50%;
            width: 40px;
            /* Mengurangi ukuran gambar */
            height: 40px;
            /* Mengurangi ukuran gambar */
            margin-right: 15px;
            /* Mengurangi margin kanan */
        }

        .text-content {
            display: flex;
            flex-direction: column;
        }

        .title {
            font-size: 8px;
            /* Mengurangi ukuran font */
            font-style: italic;
            text-align: left;
        }

        .name {
            font-size: 8px;
            /* Mengurangi ukuran font */
            text-align: left;

        }

        .division {
            font-size: 8px;
            /* Mengurangi ukuran font */
            text-align: left;
            font-weight: bold;
        }

        .email {
            font-size: 8px;
            /* Mengurangi ukuran font */
            text-align: left;
        }

        .delete-button {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .delete-icon {
            width: 20px;
            /* Mengurangi ukuran ikon */
            height: 20px;
            /* Mengurangi ukuran ikon */
        }

        label {
            margin-top: 10px;
        }

        input[type="email"],
        input[type="text"],
        select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;

            background-color: #e8f0fe;
        }

        .submit-button {

            margin: 20px auto;
            /* Membuat tombol berada di tengah secara horizontal */
            padding: 10px 20px;
            background-color: #000080;
            color: #fff;

            width: 150px;
            justify-content: center;

            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .submit-button i {
            margin-right: 5px;
        }

        .icon-container {
            display: flex;
            align-items: center; /* Align icons vertically */
        }

        #icon1 {
            color: darkgreen;
        cursor: pointer;
          
        }

        #icon2 {
            color: darkred;
            padding: 10px;
            cursor: pointer;
        }
    </style>

    <div class="svg-container">
        <div class="header-container">
            <div class="logo">
                <img src="../Assets/img/Group 207.png" alt="Logo">
            </div>
            <div class="reminder">
                REMINDER!
            </div>
        </div>

    </div>

</head>

<body>


    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>

    <div class="slideshow-container">
        <div class="slide fade">
            <div class="slide-content">
                <div class="container-fluid">

                    <div class="welcome-container">
                        <div class="welcome-message">Selamat datang, <?php echo htmlspecialchars($nama); ?></div>
                        <div class="sub-message">Kamu login sebagai <span href="#"><?php echo htmlspecialchars($role); ?></span>!</div>
                    </div>
                </div>
            </div>
            <header>
                <section class="calendar">
                    <header class="calendar-header">
                        <span style="margin-left: -10px;" class="year-change" id="prev-year">
                            <pre>&lt;</pre>
                        </span>
                        <span style="margin-left: -140px; margin-top: 15px; font-size: 11px;" class="month-picker" id="month-picker">&lt;February&gt;</span> <!-- Menggunakan entity HTML untuk tanda <> -->
                        <span style="margin-left: -130px;" class="year-change" id="next-year">
                            <pre>&gt;</pre>
                        </span>



                        <!-- Menggunakan pre untuk tanda < -->
                        </span>
                        <div style="margin-top: 15px;" class="year-picker">
                            <span id="year"></span>

                        </div>
                    </header>
                    <div class="calendar-body">
                        <div class="calendar-week-day">
                            <div>Minggu</div>
                            <div>Senin</div>
                            <div>Selasa</div>
                            <div>Rabu</div>
                            <div>Kamis</div>
                            <div>Jumat</div>
                            <div>Sabtu</div>
                        </div>

                        <div class="calendar-days"></div>
                    </div>
                    <div class="calendar-footer">
                        <div class="toggle"></div>
                    </div>
                    <div id="month-picker"></div>

                    <div class="month-list"></div>
                </section>

                <section class="event">
                    <div class="container">
                        <div class="content1">

                        </div>
                        <div class="content2">

                        </div>
                    </div>
                </section>
                </main>
                <div class="task-list">
                    <div class="task-date"> <span>
                            29 May 2024
                        </span>

                    </div>
                    <div class="task">

                        <div class="task-time">18:40</div>
                        <div class="task-content">
                            <div class="task-title">Absensi Rapat ELCO</div>
                            <div class="task-subtitle">Electrical Campus Observation</div>
                        </div>
                    </div>
                    <div class="task">

                        <div class="task-time">23:59</div>
                        <div class="task-content">
                            <div class="task-title">LPJ</div>
                            <div class="task-subtitle">Electrical Campus Observation</div>
                        </div>
                    </div>

                </div>


        </div>

    </div>



    <div class="slide fade">
        <div class="slide-content">
            <div class="search-container">
                <form method="POST" action="create.php">
                    <button id="openPopupBtn1" type="button" class="action-button"><i class="fas fa-cog"></i></button>


                    <div id="popup1" class="popup">
                        <div class="popup-content">
                            <span id="closePopupBtn1" class="close">&times;</span>
                            <h2>Silahkan isi form</h2>
                            <div class="form">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>

                                <label for="name">Nama *</label>
                                <input type="text" id="name" name="name" required>
                                <label for="division">Pilih Divisi *</label>
                                <select id="division" name="division" required>
                                    <option value="">--Pilih Divisi--</option>
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
                                    <option value="Staf Muda">Staf Muda</option>
                                </select>



                                <button type="submit" class="submit-button"><i class="fas fa-upload"></i> Submit</button>

                            </div>

                        </div>
                    </div>



                    <script src="popup.js"></script>
                    <form method="GET" action="search.php">
                        <input type="text" class="search-box" name="q" placeholder="Cari Akun">

                        <button type="submit" class="search-button"><i class="fas fa-search"></i></button>

                    </form>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('.search-button').click(function(event) {
                                event.preventDefault(); // Mencegah pengiriman formulir default

                                var searchTerm = $('.search-box').val(); // Mendapatkan nilai pencarian dari input
                                $.ajax({
                                    url: 'search.php',
                                    type: 'GET',
                                    data: {
                                        q: searchTerm
                                    }, // Mengirim data pencarian sebagai 'q'
                                    success: function(response) {
                                        $('#searchResult').html(response); // Memperbarui div #searchResult dengan hasil pencarian
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText); // Menampilkan pesan kesalahan jika terjadi kesalahan
                                    }
                                });
                            });
                        });
                    </script>



                </form>
            </div>
            <div id="searchResult">


 
                <?php  while  ($data = mysqli_fetch_assoc($result)) :   ?>
                    <div class="containerlist">
                        <div class="card">
                            <div class="card-content">
                                <img id="profileImage" src="<?php echo $data['profile_image']; ?>" alt="Profile Image" class="profile-image">
                                <div class="text-content">
                                    <div id="divisi" class="division"><?php echo $data['divisi']; ?></div>
                                    <div id="jabatan" class="title"><?php echo $data['jabatan']; ?> </div>
                                    <div id="nama" class="name"><?php echo $data['nama']; ?></div>
                                    <div id="email" class="email"><?php echo $data['email']; ?></div>
                                 
    
                                </div>
                            </div>
                           
                            
                            
                            
                            
    <form id="updateForm" method="POST" action="update.php" ; >
    <div id="popup2" class="popup">
        <div class="popup-content">
            <span id="closePopupBtn2" class="close" onclick="closePopup()">&times;</span>
            <h2>Silahkan isi form</h2>
            <div class="form">
                <!-- Input tersembunyi untuk menyimpan email saat ini -->

                <label for="email">Email *</label>
                <input  type="email" id="email" name="email" required>
                
                <input type="hidden" id="emailValue" name="emailValue" class="value" value="<?php echo $data['email']; ?>">

                <span id="emailValue2" name="emailValue" class="value" ><?php echo $data['email']; ?></span>


                <label for="name">Nama *</label>
                <input type="text" id="name" name="name" required>
                <span id="nameValue" class="value"><?php echo $data['nama'];  ?></span>
      
                
                <label for="division">Pilih Divisi *</label>
                <select id="division" name="division" required>
                    <option value="">--Pilih Divisi--</option>
                    <option value="Pengurus Harian">Pengurus Harian</option>
                    <option value="Departemen A">Departemen A</option>
                    <option value="Departemen B">Departemen B</option>
                    <option value="Departemen C">Departemen C</option>
                    <option value="Departemen D">Departemen D</option>
                    <option value="Departemen E">Departemen E</option>
                    <option value="Departemen F">Departemen F</option>
                </select>
                <span id="divisionValue" class="value"><?php echo $data['divisi'];  ?></span>

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
                    <option value="Staff Muda">Staff Muda</option>
                </select>
                <span id="positionValue" class="value"><?php echo $data['jabatan'];  ?></span>

                <button type="submit" class="submit-button"><i class="fas fa-upload"></i> Update</button>
            </div>
        </div>
    </div>
</form>



<div class="icon-container">
<i alt="Edit Icon" class="fas fa-pencil" id="icon1" onclick="openPopup('<?php echo $data['email']; ?>', '<?php echo $data['nama']; ?>', '<?php echo $data['divisi']; ?>', '<?php echo $data['jabatan']; ?>')"></i>




<div class="delete-button" data-email="<?php echo $data['email']; ?>" onclick="hapusData('<?php echo $data['email']; ?>')">
                                <!-- Tambahkan atribut data-email yang berisi email -->
                                
                                <i alt="delete Icon" class="fas fa-trash" id="icon2"></i>
                            </div>
</div>
<script>
    // Function to close the popup
    function closePopup() {
        document.getElementById('popup2').style.display = 'none';
    }

    // Function to open the popup and fetch data
    function openPopup(email,nama,divisi,jabatan) {
        document.getElementById('popup2').style.display = 'block';
        document.getElementById('emailValue').value = email;
        document.getElementById('emailValue2').textContent = email;
        document.getElementById('nameValue').textContent = nama; 
        document.getElementById('divisionValue').textContent = divisi; 
        document.getElementById('positionValue').textContent = jabatan; 
  
      

function submitForm() {
        var xhr = new XMLHttpRequest();
        var formData = new FormData(document.getElementById("updateForm")); // Get form data
        xhr.open('POST', 'update.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle response from server if needed
                console.log(xhr.responseText);
                   // Contoh: Refresh halaman
                  
            }
        };
        xhr.send(formData); // Send form data to server
    }

        
    }
    
 
</script>


                            <script>
                                function hapusData(email) {
                                    // Konfirmasi apakah pengguna yakin untuk menghapus data
                                    if (confirm("Apakah Anda yakin ingin menghapus data?")) {
                                        // Lakukan permintaan AJAX ke server untuk menghapus data berdasarkan email
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "delete.php", true); // Ganti "delete.php" dengan nama file PHP yang benar
                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState == 4 && xhr.status == 200) {
                                                // Tanggapan dari server
                                                var response = xhr.responseText;
                                                if (response == "success") {
                                                    // Jika penghapusan berhasil, lakukan tindakan sesuai kebutuhan, seperti memperbarui tampilan atau mengarahkan pengguna ke halaman lain
                                                    alert("Data berhasil dihapus!");
                                                    // Contoh: Refresh halaman
                                                    window.location.reload();
                                                } else {
                                                    // Jika penghapusan gagal, tampilkan pesan kesalahan atau lakukan tindakan yang sesuai
                                                    alert("Gagal menghapus data!");
                                                }
                                            }
                                        };
                                        // Kirim data email yang diperlukan
                                        var data = "email=" + email;
                                        xhr.send(data);
                                    }
                                }
                            </script>



                        </div>
                    </div>
                    <?php  endwhile; ?>
            </div>


        </div>
    </div>
    </div>






    </div>


    </div>

</body>
<footer>


    </div>
    <div class="navbar">
        <div class="navbar-item active" id="home">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </div>
        <div class="navbar-item" id="task">
            <i class="fas fa-tasks"></i>
            <span>Progdiv</span>
        </div>
        <div class="navbar-item" id="profile">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="nav.js"></script>
    <script src="slide.js"></script>
    <script src="calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</footer>

</html>