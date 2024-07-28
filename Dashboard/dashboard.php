<?php
include '/Kuliah/My-Himprote/Validation/checkakun.php';
include '/Kuliah/My-Himprote/Progdiv/listview.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <div class="svg-container">
        <div class="header-container">
            <div class="logo">
                <img src="../Assets/img/Group 207.png" alt="Logo">
            </div>
            <div class="reminder">   
                  
              <?php if ($role === 'admin') : ?>
       
           
                <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                <a class="next" onclick="changeSlide(1)">&#10095;</a>
                <?php endif; ?> 
            </div>
        </div>
    </div>
</head>

<body>
    <div class="slideshow-container">
        <div class="slide fade">
            <div class="slide-content">
                <div class="container-fluid">
                    <div class="welcome-container">
                        <div class="welcome-message">Selamat datang, <?php echo htmlspecialchars($nama); ?></div>
                        <div class="sub-message">Kamu login sebagai <span><?php echo htmlspecialchars($role); ?></span> !</div>
                    </div>
                </div>
            </div>
            <header>
                <section class="calendar">
                    <header class="calendar-header">
                        <span class="year-change" id="prev-year">&lt;</span>
                        <span class="month-picker" id="month-picker">&lt;February&gt;</span>
                        <span class="year-change" id="next-year">&gt;</span>
                        <div class="year-picker">
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
                        <div class="content1"></div>
                        <div class="content2"></div>
                    </div>
                </section>
            </header>
            <main>
                
            </main>
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
                                event.preventDefault();
                                var searchTerm = $('.search-box').val();
                                $.ajax({
                                    url: 'search.php',
                                    type: 'GET',
                                    data: { q: searchTerm },
                                    success: function(response) {
                                        $('#searchResult').html(response);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                    }
                                });
                            });
                        });
                    </script>
                </form>
            </div>
            <div id="searchResult">
                <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                    <div class="containerlist">
                        <div class="card">
                            <div class="card-content">
                                <img id="profileImage" src="<?php echo htmlspecialchars($data['profile_image']); ?>" alt="Profile Image" class="profile-image">
                                <div class="text-content">
                                    <div id="departemen" class="division"><?php echo htmlspecialchars($data['departemen']); ?></div>
                                    <div id="jabatan" class="title"><?php echo htmlspecialchars($data['jabatan']); ?></div>
                                    <div id="nama" class="name"><?php echo htmlspecialchars($data['nama']); ?></div>
                                    <div id="email" class="email"><?php echo htmlspecialchars($data['email']); ?></div>
                                </div>
                            </div>
                            <div class="icon-container">
                                <i alt="Edit Icon" class="fas fa-pencil" id="icon1" onclick="openPopup('<?php echo htmlspecialchars($data['email']); ?>', '<?php echo htmlspecialchars($data['nama']); ?>', '<?php echo htmlspecialchars($data['departemen']); ?>', '<?php echo htmlspecialchars($data['jabatan']); ?>')"></i>
                                <div class="delete-button" data-email="<?php echo htmlspecialchars($data['email']); ?>" onclick="hapusData('<?php echo htmlspecialchars($data['email']); ?>')">
                                    <i alt="delete Icon" class="fas fa-trash" id="icon2"></i>
                                </div>
                            </div>
                            <form id="updateForm" method="POST" action="update.php">
                                <div id="popup2" class="popup">
                                    <div class="popup-content">
                                        <span id="closePopupBtn2" class="close" onclick="closePopup()">&times;</span>
                                        <h2>Silahkan isi form</h2>
                                        <div class="form">
                                            <label for="email">Email *</label>
                                            <input type="email" id="email" name="email" required>
                                            <input type="hidden" id="emailValue" name="emailValue" value="<?php echo htmlspecialchars($data['email']); ?>">
                                            <span id="emailValue2" name="emailValue"><?php echo htmlspecialchars($data['email']); ?></span>
                                            <label for="name">Nama *</label>
                                            <input type="text" id="name" name="name" required>
                                            <span id="nameValue"><?php echo htmlspecialchars($data['nama']); ?></span>
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
                                            <span id="divisionValue"><?php echo htmlspecialchars($data['departemen']); ?></span>
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
                                            <span id="positionValue"><?php echo htmlspecialchars($data['jabatan']); ?></span>
                                            <button type="submit" class="submit-button"><i class="fas fa-upload"></i> Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <script>
                                function closePopup() {
                                    document.getElementById('popup2').style.display = 'none';
                                }

                                function openPopup(email, nama, departemen, jabatan) {
                                    document.getElementById('popup2').style.display = 'block';
                                    document.getElementById('emailValue').value = email;
                                    document.getElementById('emailValue2').textContent = email;
                                    document.getElementById('nameValue').textContent = nama;
                                    document.getElementById('divisionValue').textContent = departemen;
                                    document.getElementById('positionValue').textContent = jabatan;
                                }

                                function hapusData(email) {
                                    if (confirm("Apakah Anda yakin ingin menghapus data?")) {
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "delete.php", true);
                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState == 4 && xhr.status == 200) {
                                                var response = xhr.responseText;
                                                if (response == "success") {
                                                    window.location.reload();
                                                } else {
                                                    alert("Gagal menghapus data!");
                                                }
                                            }
                                        };
                                        xhr.send("email=" + email);
                                    }
                                }
                            </script>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="navbar">
            <div class="navbar-item active" id="home">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </div>
            <div class="navbar-item" id="progdiv">
                <i class="fas fa-tasks"></i>
                <span>Progdiv</span>
            </div>
            <div class="navbar-item" id="profile">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </div>
        </div>
        <!-- Bootstrap JS and dependencies -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var progdivNavItem = document.getElementById('progdiv');
            
            progdivNavItem.addEventListener('click', function() {
                // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
                window.location.href = "/Progdiv/progdiv.php"; // Ganti "progdivadmin1.html" dengan URL yang sesuai
            });
            
            var profileNavItem = document.getElementById('profile');
            profileNavItem.addEventListener('click', function() {
                // Mengarahkan pengguna ke bagian khusus halaman PHP dengan menambahkan hash fragment di URL
                window.location.href = "/Profil/profile.php"; // Ganti "profile.php" dengan URL yang sesuai
            });
        });
        
    
        </script>
    
        <script src="/Assets/js/nav.js"></script>
        <script src="/Assets/js/slide.js"></script>
        <script src="/Assets/js/calendar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    </footer>
</body>
</html>