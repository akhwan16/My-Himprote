<?php
session_start();
include '../Database/db.php'; // Pastikan file koneksi database sudah di-include dengan benar
include 'checkakun.php';
// Pastikan program_id telah diset di sesi sebelumnya
if (isset($_SESSION['program_id'])) {
    $program_id = $_SESSION['program_id'];
    $local_storage_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    // Inisialisasi variabel untuk menyimpan data
    $nama_divisi = '';
    $nama_program = ''; // Menyimpan nama program kerja
    $posts = [];

    // Query untuk memeriksa apakah email ada dalam salah satu divisi di program_id
    $sql = "SELECT divisi.id AS divisi_id, divisi.nama AS nama_divisi, programkerja.nama AS nama_program
            FROM penggunaprogramdivisi
            INNER JOIN divisi ON penggunaprogramdivisi.divisi_id = divisi.id
            INNER JOIN programkerja ON penggunaprogramdivisi.program_id = programkerja.id
            WHERE penggunaprogramdivisi.program_id = ? AND penggunaprogramdivisi.email_pengguna = ?";

    // Persiapan statement SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $program_id, $local_storage_email);
    $stmt->execute();
    $stmt->bind_result($divisi_id, $nama_divisi, $nama_program);

    // Ambil hasil query
    if ($stmt->fetch()) {
        // Jika ditemukan, simpan nama divisi dan nama program kerja
        $nama_divisi = htmlspecialchars($nama_divisi);
        $nama_program = htmlspecialchars($nama_program);
    }
    $stmt->close();

    // Query untuk mendapatkan posting terkait dengan divisi
    if (!empty($divisi_id)) {
        // Pastikan nama kolom di tabel post sesuai dengan skema database Anda
        $sql_posts = "SELECT id, judul, konten, validasi, file
                      FROM post 
                      WHERE divisi_id = ?";
        
        $stmt_posts = $conn->prepare($sql_posts);
        $stmt_posts->bind_param("i", $divisi_id);
        $stmt_posts->execute();
        $stmt_posts->bind_result($post_id, $post_title, $post_content, $validasi, $file);

        // Ambil dan simpan posting terkait
        while ($stmt_posts->fetch()) {
            $posts[] = [
                'id' => $post_id,
                'title' => htmlspecialchars($post_title),
                'content' => htmlspecialchars($post_content),
                'validasi' => $validasi,
                'file' => $file
            ];
        }
        $stmt_posts->close();
    }
} else {
    echo "Program ID tidak tersedia dalam sesi.";
}
$conn->close();
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
  
<body>
        <div class="slide fade">
          <section id="divisiku">
            <div class="button-back2">
              <button class="back2" onclick="goBack()">
              <script>
        // Fungsi untuk kembali ke halaman sebelumnya
        function goBack() {
            window.history.back();
        }
    </script>
 
                <i class="fa-solid fa-arrow-left"></i>
              </button>
              <div class="divisiku">
                
                <img src="/Assets/img/div.png" alt="" /><?php echo $nama_divisi; ?>
              </div>
          </section>

          <section id="job-list">
            <div class="job-list">
              <div class="progress">Progress</div>
              <?php foreach ($posts as $post) : ?>
              <div class="jobdesk">
              <?php
                            $icon_color = 'red'; // Warna default ikon
                            if ($post['validasi'] == 1) {
                                $icon_color = 'green';
                            } elseif ($post['validasi'] == 0 && !empty($post['file'])) {
                                $icon_color = 'orange';
                            }
                            ?>
                <i class="fa-solid fa-circle" id= "bundar"style="color: <?php echo $icon_color; ?> " ></i>
                <div class="jobdesk-time">
               
                </div>
                <div class="jobdesk-content">
                <div class="jobdesk-title"><?php echo $post['title']; ?></div>
                
                            <div class="jobdesk-subtitle"><?php echo $nama_program ?></div>
                  <!--EDITT BENTAR -->
                  <!--more info-->
                  <div class="jobdesk-more-info divisi">
                    More info
                    <button class="more-info divisi openPopupBtn"  data-popup="popup4" data-postid="<?php echo $post['id']; ?> ">
                      <i class="fa-solid fa-circle-exclamation"></i>
                    </button>
                    <!--more info-->
                    <div id="popup4" class="popup">

                      <div class="popup-content">
                        <span id="closePopupBtn4" class="close">&times;</span>
                        <h2>More Info</h2>
                        <div class="form4">
                        <p id="konteni">
                          <?php echo $post['content']; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="upload-container">
                  <form action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="file-upload" class="custom-file-upload">
                      <i class="fas fa-arrow-up-from-bracket"></i>
                    </label>
       
 
        
        <input type="hidden" name="post_id" id="post_id_input" value="">
        <input id="file-upload" type="file" name="upload">
        <button type="submit">Submit</button>
    </form>


                  </div>
                  
                </div>
                </div>
             
                <?php endforeach; ?>
                
          </section>
          
        </div>

       
  </main>

</body>

<footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.openPopupBtn');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postId = this.getAttribute('data-postid').trim();
            if (postId) {
                console.log('Post ID yang diklik:', postId);

                var popupId = this.getAttribute('data-popup');
                var popup = document.getElementById(popupId);
                if (popup) {
                    popup.style.display = 'block';
                    fetchPostData(postId);
                } else {
                    console.error('Popup dengan id ' + popupId + ' tidak ditemukan.');
                }
            } else {
                console.error('Data post_id tidak tersedia.');
            }
        });
    });
});

function fetchPostData(postId) {
    fetch('getdivis.php?post_id=' + postId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan saat mengambil data post. Status: ' + response.status);
            }
            return response.json(); // Mengambil JSON dari respons
        })
        .then(data => {
            try {
                if (data.error) {
                    throw new Error(data.error);
                }

                // Pastikan elemen yang diakses ada
                var kontenElement = document.getElementById('konteni');
                if (kontenElement) {
                    kontenElement.textContent = data.content;
                    console.log('Data post yang diterima:', data);
                } else {
                    throw new Error('Elemen dengan id "konteni" tidak ditemukan.');
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
                alert('Terjadi kesalahan saat memproses data post.');
            }
        })
        .catch(error => {
            console.error('Error fetching post data:', error);
            alert('Terjadi kesalahan saat mengambil data post.');
        });
}

    </script>

<script src="/Assets/js/nav.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>


<script src="popup.js"></script>
</footer>

</html>