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
        // Simpan program_id dalam session
        $_SESSION['program_id'] = $program_id;
        $conn->close();

    } else {
        // Jika program kerja tidak ditemukan
        $conn->close();
        echo "<script>alert('Program kerja tidak ditemukan.'); window.history.back();</script>";
        exit;
    }
} else {
  
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
    .delete-icon {
    border: none;
    background-color: transparent;
    
    cursor: pointer;
    padding: 5px;
    margin-left: 10px; /* Atur margin jika diperlukan */
}

.delete-icon:hover {
    color: darkred;
}
/* Form styles */
.form {
    display: flex;
    flex-direction: column;
}

.form label {
    margin: 10px 0 5px;
    font-weight: bold;
}

.form input[type="text"],
.form input[type="date"],
.form input[type="nama"],
.form textarea,
.form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Textarea resize */
.form textarea {
    resize: vertical;
    height: 100px;
}


  </style>
  
<body>
  <main>
        <div class="slide fade">

          <div class="button-back">
          <button class="back" onclick="window.location.href = 'progdiv.php';">
  <i class="fa-solid fa-arrow-left"></i> 
</button>


      <!-- Form untuk menambahkan anggota ke divisi -->
<div id="popup7" class="popup">
  <div class="popup-content">
    <span id="closePopupBtn7" class="close">&times;</span>
    <h2>Silahkan isi form</h2>
    <input type="hidden" name="program_id" value="<?php echo htmlspecialchars($program['id']); ?>">
    <form method="POST" action="tambah_anggota.php">
        
      <div class="form">
      <label for="namaCreate">Masukkan Nama-nama (pisahkan dengan koma atau baris baru) *</label>
      <textarea id="namaCreate" name="nama" required></textarea>
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
      </div>
    </form>
  </div>
</div>
                

          <!-- Popup 6 -->
<div class="anggotadiv">
    <div id="popup6" class="popup">
        <div class="popup-content">
            <span id="closePopupBtn6" class="close">&times;</span>
            <h2>Daftar Anggota</h2>
            <div class="list-view" id="listView">
            <?php
include '../db.php';

// Misalkan program_id telah diset sebelumnya di sesi
if (isset($_SESSION['program_id'])) {
    $program_id = $_SESSION['program_id'];

    // Query untuk mendapatkan email ketua program berdasarkan program_id
    $sql_ketua = "SELECT ketua_email FROM programkerja WHERE id = ?";
    $stmt_ketua = $conn->prepare($sql_ketua);
    $stmt_ketua->bind_param("i", $program_id);
    $stmt_ketua->execute();
    $stmt_ketua->bind_result($email_ketua);
    $stmt_ketua->fetch();
    $stmt_ketua->close();

    // Periksa role dari tabel akun
    $local_storage_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $isAdmin = false;

    // Query untuk memeriksa role dari tabel akun berdasarkan email
    $sql_role = "SELECT role FROM akun WHERE email = ?";
    $stmt_role = $conn->prepare($sql_role);
    $stmt_role->bind_param("s", $local_storage_email);
    $stmt_role->execute();
    $stmt_role->bind_result($role);
    $stmt_role->fetch();
    $stmt_role->close();

    // Query untuk mendapatkan daftar anggota dari program kerja dan divisinya
    $sql_anggota = "SELECT akun.nama AS nama_anggota, Divisi.nama AS nama_divisi, PenggunaProgramDivisi.email_pengguna
                    FROM PenggunaProgramDivisi
                    INNER JOIN akun ON PenggunaProgramDivisi.email_pengguna = akun.email
                    INNER JOIN Divisi ON PenggunaProgramDivisi.divisi_id = Divisi.id
                    WHERE PenggunaProgramDivisi.program_id = ?";

    $stmt_anggota = $conn->prepare($sql_anggota);
    $stmt_anggota->bind_param("i", $program_id);
    $stmt_anggota->execute();
    $result = $stmt_anggota->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="list-item">';
            echo '<div class="field">' . htmlspecialchars($row['nama_anggota']) . ' - ' . htmlspecialchars($row['nama_divisi']) . '</div>';
            echo '<form method="post" action="hapus_anggota.php">';
            echo '<input type="hidden" name="email" value="' . htmlspecialchars($row['email_pengguna']) . '">';
            echo '<input type="hidden" name="program_id" value="' . htmlspecialchars($program_id) . '">';
            
            // Tampilkan tombol hapus hanya jika role adalah admin atau email ketua sama dengan local storage email
            if ($role === 'admin' || $email_ketua === $local_storage_email) {
                echo '<button type="submit" class="delete-icon" onclick="return confirm(\'Apakah Anda yakin ingin menghapus anggota ini?\')">';
                echo '<i style="color: red; font-size: 16px;" class="fas fa-trash-alt"></i>';
                echo '</button>';
            }
            
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo '<p>Tidak ada anggota yang tersedia.</p>';
    }

    $stmt_anggota->close();
} else {
    echo '<p>Program ID tidak ditemukan dalam session.</p>';
}

$conn->close();
?>

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
             
                
              <?php
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Misalkan program_id telah diset sebelumnya di sesi
if (isset($_SESSION['program_id'])) {
    $program_id = $_SESSION['program_id'];

    // Query untuk mendapatkan email ketua program berdasarkan program_id
    $sql = "SELECT ketua_email FROM programkerja WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $program_id);
    $stmt->execute();
    $stmt->bind_result($email_ketua);
    $stmt->fetch();
    $stmt->close();

    // Periksa role dari tabel akun
    $local_storage_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $isAdmin = false;

    // Query untuk memeriksa role dari tabel akun berdasarkan email
    $sql_role = "SELECT role FROM akun WHERE email = ?";
    $stmt_role = $conn->prepare($sql_role);
    $stmt_role->bind_param("s", $local_storage_email);
    $stmt_role->execute();
    $stmt_role->bind_result($role);
    $stmt_role->fetch();
    $stmt_role->close();

    if ($role === 'admin' || $email_ketua === $local_storage_email) {
        // Tampilkan ikon fa-list-check jika role adalah admin atau email sama dengan email ketua program
       
        echo '<div id="pengaturanprogja">';
        echo '<i id="openPopupBtn7" class="fa-solid fa-plus"></i>';
        echo '<i id="openPopupBtn6" class="fas fa-user-circle"></i>';
        echo '</div>';
      
        
        
        
    } else {
        echo '<div id="pengaturanprogja">';
      
       
     
       
echo '<i id="openPopupBtn6" class="fas fa-user-circle"></i>';
echo '</div>';
    }
}
?>
             
              </div>
            </div>

          </section>

          <section id="deskripsi">

            <div class="deskripsi">

              <div class="judul">Deskripsi :</div>
              <div class="teks">
              <?php echo htmlspecialchars($program['deskripsi']); ?>
              </div>
            </div>
          </section>
         <!-- HTML -->
<section id="choice">
    <div id="categoryChoices" class="choice">
        <div class="choice-item" data-category="Administrasi">
            <span>Administrasi</span>
        </div>
        <div class="choice-item" data-category="Persiapan">
            <span>Persiapan</span>
        </div>
        <div class="choice-item" data-category="Hari Acara">
            <span>Hari Acara</span>
        </div>
        <?php
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Misalkan program_id telah diset sebelumnya di sesi
if (isset($_SESSION['program_id'])) {
    $program_id = $_SESSION['program_id'];

    // Query untuk mendapatkan email ketua program berdasarkan program_id
    $sql = "SELECT ketua_email FROM programkerja WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $program_id);
    $stmt->execute();
    $stmt->bind_result($email_ketua);
    $stmt->fetch();
    $stmt->close();

    // Periksa role dari tabel akun
    $local_storage_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $isAdmin = false;

    // Query untuk memeriksa role dari tabel akun berdasarkan email
    $sql_role = "SELECT role FROM akun WHERE email = ?";
    $stmt_role = $conn->prepare($sql_role);
    $stmt_role->bind_param("s", $local_storage_email);
    $stmt_role->execute();
    $stmt_role->bind_result($role);
    $stmt_role->fetch();
    $stmt_role->close();

    if ($role === 'admin' || $email_ketua === $local_storage_email) {
        // Tampilkan ikon fa-list-check jika role adalah admin atau email sama dengan email ketua program
         echo '<i id="openPopupBtn1" class="fa-solid fa-circle-plus" ></i>'; 
       
        
        
    } else {
        // Jika bukan email ketua program dan bukan admin, maka tidak perlu menampilkan ikon
        // Tidak perlu menampilkan ikon fa-list-check di sini
    }
}
?>
       
 
    </div>
    
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const choiceItems = document.querySelectorAll('.choice-item');

    choiceItems.forEach(item => {
        item.addEventListener('click', function() {
            // Menghapus kelas 'active' dari semua choice-item
            choiceItems.forEach(item => {
                item.classList.remove('active');
            });

            // Menambahkan kelas 'active' ke choice-item yang diklik
            this.classList.add('active');

            // Simpan nilai 'activeCategory' ke localStorage
            const selectedCategory = this.getAttribute('data-category');
            localStorage.setItem('activeCategory', selectedCategory);

            // Contoh tindakan lain setelah menetapkan 'active'
            console.log('Nilai kategori sekarang:', selectedCategory);

            // Kirim nilai kategori ke PHP menggunakan Fetch API
            fetch('update_category.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ category: selectedCategory }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                
                window.location.reload();
                // Handle respons dari server jika perlu
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    // Set kembali 'active' saat halaman dimuat ulang
    const activeCategory = localStorage.getItem('activeCategory');
    if (activeCategory) {
        choiceItems.forEach(item => {
            if (item.getAttribute('data-category') === activeCategory) {
                item.classList.add('active');
            }
        });
    }
});
</script>

          <div id="popup1" class="popup">
  <div class="popup-content">
    <span id="closePopupBtn1" class="close">&times;</span>
    <h2>Silahkan isi form</h2>
    <form action="create_post.php" method="POST">
      <div class="form">
        <label for="judulCreate" style="margin: 0;">Judul *</label>
        <input type="text" id="judulCreate" name="judul" required>

        <label for="kontenCreate" style="margin: 0;">Konten *</label>
        <textarea name="konten" id="kontenCreate" required></textarea>

        <label for="tanggalCreate" style="margin: 0;">Tanggal *</label>
        <input type="date" id="tanggalCreate" name="tanggal" required>

        <label for="kategoriCreate" style="margin: 0;">Pilih Kategori *</label>
        <select id="kategoriCreate" name="kategori" required>
          <option value="">--Pilih Kategori--</option>
          <option value="Administrasi">Administrasi</option>
          <option value="Persiapan">Persiapan</option>
          <option value="Hari Acara">Hari Acara</option>
        </select>

        <label for="divisionCreate" style="margin: 0;">Pilih Divisi *</label>
        <select id="divisionCreate" name="division" required>
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
      </div>
    </form>
  </div>
</div>


          <section id="job-list">
            <div class="job-list">

              <div class="jobdesk-create">

              </div>

              <?php


include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Ambil program_id dari session
// Ambil program_id dari parameter URL jika ada
$program_id = isset($_GET['program_id']) ? $_GET['program_id'] : '';


$category = isset($_SESSION['category']) ? $_SESSION['category'] : 'Administrasi';


// Pastikan program_id tidak kosong
if (!empty($program_id)) {
    $sql = "SELECT post.id, post.judul, post.konten, post.tanggal, post.validasi, post.program_id, post.divisi_id, post.file, post.kategori, divisi.nama AS divisi_nama 
            FROM post 
            JOIN divisi ON post.divisi_id = divisi.id 
            WHERE post.program_id = ? AND post.kategori = ?"; // Gabungkan dengan tabel divisi untuk mengambil nama divisi
    
    // Siapkan statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $program_id, $category); // "is" menunjukkan bahwa parameter adalah integer dan string
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $posts = array(); // Array untuk menyimpan data post dari database

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $posts[] = array(
                'id' => $row['id'],
                'judul' => htmlspecialchars($row['judul']),
                'konten' => htmlspecialchars($row['konten']),
                'tanggal' => htmlspecialchars($row['tanggal']),
                'validasi' => htmlspecialchars($row['validasi']),
                'program_id' => htmlspecialchars($row['program_id']),
                'divisi_id' => htmlspecialchars($row['divisi_id']),
                'file' => htmlspecialchars($row['file']),
                'kategori' => htmlspecialchars($row['kategori']),
                'divisi_nama' => htmlspecialchars($row['divisi_nama']) // Simpan nama divisi ke dalam variabel
            );
        }
       
         json_encode($posts);
    } else {
      
        json_encode(['message' => 'Belum ada postingan dalam kategori ini']);
    }

    $stmt->close(); // Tutup statement setelah selesai
} else {
  
     json_encode(['message' => 'Program ID tidak ditemukan dalam session.']);
}

$conn->close(); // Tutup koneksi setelah selesai menggunakan database
?>



<?php foreach ($posts as $post): ?>
              <div class="jobdesk">
                
              <input type="checkbox" class="jobdesk-checkbox" />
              <?php
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Misalkan program_id yang Anda kirimkan lewat session disimpan dalam variabel $program_id
// Gantilah ini dengan cara Anda mengambil program_id dari session atau sumber lainnya
$program_id = $_SESSION['program_id']; // Contoh saja, sesuaikan dengan cara Anda

// Pastikan variabel $post['id'] atau cara lainnya untuk mendapatkan $post_id sudah tersedia
$post_id = isset($post['id']) ? $post['id'] : ''; // Ganti dengan cara yang sesuai untuk mengambil id post

// Query untuk mengambil data validasi dan file dari tabel post berdasarkan id
$sql = "SELECT validasi, file FROM post WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $validasi = $row['validasi'];
    $file = $row['file'];

    // Tentukan class CSS untuk jobdesk-time berdasarkan kondisi
  
    $icon_color = 'red'; // Warna default ikon

    if ($validasi == 1) {
   
        $icon_color = 'green';
    } elseif ($validasi == 0 && !empty($file)) {
      
        $icon_color = 'orange';
    }
} else {
    echo "Post tidak ditemukan.";
}

$stmt->close();
$conn->close();
?>

         <i class="fa-solid fa-circle" id= "bundar"style="color: <?php echo $icon_color; ?> " ></i>
                <div class="jobdesk-time">
                <?php


include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Misalkan program_id telah diset sebelumnya di sesi
if (isset($_SESSION['program_id'])) {
    $program_id = $_SESSION['program_id'];

    // Query untuk mendapatkan email ketua program berdasarkan program_id
    $sql = "SELECT ketua_email FROM programkerja WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $program_id);
    $stmt->execute();
    $stmt->bind_result($email_ketua);
    $stmt->fetch();
    $stmt->close();

    // Periksa role dari tabel akun
    $local_storage_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $isAdmin = false;

    // Query untuk memeriksa role dari tabel akun berdasarkan email
    $sql_role = "SELECT role FROM akun WHERE email = ?";
    $stmt_role = $conn->prepare($sql_role);
    $stmt_role->bind_param("s", $local_storage_email);
    $stmt_role->execute();
    $stmt_role->bind_result($role);
    $stmt_role->fetch();
    $stmt_role->close();

    if ($role === 'admin' || $email_ketua === $local_storage_email) {
        // Tampilkan ikon fa-list-check jika role adalah admin atau email sama dengan email ketua program
        echo '<i class="fa-solid fa-list-check" style="color: ' . htmlspecialchars($icon_color) . '" data-postid="' . htmlspecialchars($post['id']) . '"></i>';
    } else {
        // Jika bukan email ketua program dan bukan admin, maka tidak perlu menampilkan ikon
        // Tidak perlu menampilkan ikon fa-list-check di sini
    }
}


?>

                  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk setiap ikon fa-list-check
    document.querySelectorAll('.fa-list-check').forEach(icon => {
        icon.addEventListener('click', function() {
            const postId = this.getAttribute('data-postid');
            const currentValidation = this.style.color === 'green' ? 0 : 1; // Ubah logika untuk toggle validasi

            // Konfirmasi sebelum mengubah nilai validasi
            if (confirm(`Anda yakin ingin mengubah nilai validasi menjadi ${currentValidation === 1 ? 'Valid' : 'Tidak Valid'}?`)) {
                // Kirim permintaan untuk mengubah validasi
                fetch('update_validation.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ post_id: postId, validation: currentValidation })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Terjadi kesalahan saat menghubungi server.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Ganti warna ikon sesuai dengan nilai validasi baru
                      
                        alert('Nilai validasi berhasil diperbarui.');
                        location.reload(); // Muat ulang halaman setelah perubahan berhasi
                    } else {
                       
                    }
                })
                .catch(error => {
                    console.error('Error updating validation:', error);
                    alert('Terjadi kesalahan saat memperbarui nilai validasi.');
                });
            }
        });
    });
});

                  </script>
                </div>

            
                <div class="jobdesk-content">
                                
                  <div class="jobdesk-title"><?php echo $post['judul']; ?></div>
                  <div class="jobdesk-subtitle">
                  <?php echo htmlspecialchars($program['nama']); ?>
                  </div>


                  <!--more info-->
                  <div class="jobdesk-more-info">
                    More info
              
                      <i style="color:darkred;   cursor: pointer;" class="fa-solid fa-circle-exclamation openPopupBtn" data-popup="popup3"  data-postid="<?php echo $post['id']; ?> "></i>
                 
                    <!--more info-->
                    <div id="popup3" class="popup">

                      <div class="popup-content">
                        <span id="closePopupBtn3" class="close">&times;</span>
                        <h2>More Info</h2>
                        <div class="form3">
                          <p id="konteni">
                          <?php echo htmlspecialchars($post['konten']); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="jobdesk-subtitle"> SIE: 
                  <?php echo htmlspecialchars($post['divisi_nama']); ?>
                  </div>

                  <div class="icon-container">
                  <?php if (!empty($post['file'])) : ?>
    <i class="fa-solid fa-download" style="color: darkblue; cursor: pointer;" 
       data-file="<?php echo htmlspecialchars($post['file']); ?>" 
       data-postid="<?php echo htmlspecialchars($post['id']); ?>"></i>
<?php endif; ?>
                  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk setiap ikon fa-download
    document.querySelectorAll('.fa-download').forEach(icon => {
        icon.addEventListener('click', function() {
            const fileUrl = this.getAttribute('data-file');
            if (fileUrl) {
                // Membuat elemen anchor untuk mengunduh file
                const link = document.createElement('a');
                link.href = fileUrl;
                link.target = '_blank'; // Buka link di tab baru (opsional)
                link.setAttribute('download', ''); // Memastikan browser menganggap ini sebagai unduhan
                document.body.appendChild(link); // Menambahkan link ke dalam dokumen
                link.click(); // Klik pada link secara otomatis
                document.body.removeChild(link); // Hapus link setelah proses unduh selesai
            } else {
                alert('Tautan unduhan tidak tersedia.');
            }
        });
    });
});

                  </script>
                  <?php
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Misalkan program_id telah diset sebelumnya di sesi
if (isset($_SESSION['program_id'])) {
    $program_id = $_SESSION['program_id'];

    // Query untuk mendapatkan email ketua program berdasarkan program_id
    $sql = "SELECT ketua_email FROM programkerja WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $program_id);
    $stmt->execute();
    $stmt->bind_result($email_ketua);
    $stmt->fetch();
    $stmt->close();

    // Periksa role dari tabel akun
    $local_storage_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $isAdmin = false;

    // Query untuk memeriksa role dari tabel akun berdasarkan email
    $sql_role = "SELECT role FROM akun WHERE email = ?";
    $stmt_role = $conn->prepare($sql_role);
    $stmt_role->bind_param("s", $local_storage_email);
    $stmt_role->execute();
    $stmt_role->bind_result($role);
    $stmt_role->fetch();
    $stmt_role->close();

    if ($role === 'admin' || $email_ketua === $local_storage_email) {
        // Tampilkan ikon fa-list-check jika role adalah admin atau email sama dengan email ketua program
         echo '<i style="color:green; cursor: pointer;" class="fa-solid fa-pencil openPopupBtn" data-popup="popup8" data-postid="' . $post['id'] . '"></i>'; 
         echo '<i style="color:darkred; cursor: pointer;" class="fa-solid fa-trash deleteIcon" data-postid="' . htmlspecialchars($post['id']) . '"></i>'; 
        
        
    } else {
        // Jika bukan email ketua program dan bukan admin, maka tidak perlu menampilkan ikon
        // Tidak perlu menampilkan ikon fa-list-check di sini
    }
}
?>

                 
<script>// Event listener untuk ikon hapus
document.querySelectorAll('.deleteIcon').forEach(icon => {
    icon.addEventListener('click', function() {
        const postId = this.getAttribute('data-postid');
        if (confirm('Anda yakin ingin menghapus postingan ini?')) {
            deletePost(postId);
        }
    });
});

// Fungsi untuk menghapus postingan
function deletePost(postId) {
    fetch('delete_post.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ post_id: postId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Postingan berhasil dihapus.');
            location.reload(); // Muat ulang halaman setelah penghapusan berhasil
        } else {
            alert('Gagal menghapus postingan: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error deleting post:', error);
        alert('Terjadi kesalahan saat menghapus postingan.');
    });
}
</script>
                  </div>
        
                </div>

              </div>

              <?php endforeach; ?>
              <div id="popup8" class="popup">
                
              <?php
include '../db.php'; // Pastikan file koneksi database sudah di-include dengan benar

// Misalkan program_id yang Anda kirimkan lewat session disimpan dalam variabel $program_id
// Gantilah ini dengan cara Anda mengambil program_id dari session atau sumber lainnya
$program_id = $_SESSION['program_id']; // Contoh saja, sesuaikan dengan cara Anda

// Contoh pengambilan data dari database (disesuaikan dengan implementasi Anda)
$sql = "SELECT validasi, file FROM post WHERE id = ?"; // Sesuaikan dengan query yang sesuai
$post_id = 1; // Ganti dengan id post yang sesuai, bisa diambil dari $_GET atau $_POST atau sesuai dengan implementasi Anda

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $validasi = $row['validasi'];
    $file = $row['file'];

    // Tentukan class CSS untuk jobdesk-time berdasarkan kondisi
    $jobdesk_class = 'jobdesk-time';
    if ($validasi == 1) {
        $jobdesk_class .= ' valid';
    } elseif ($validasi == 0 && !empty($file)) {
        $jobdesk_class .= ' pending';
    }
} else {
    echo "Post tidak ditemukan.";
}

$stmt->close();
$conn->close();
?>

    <div class="popup-content">
        <span id="closePopupBtn8" class="close">&times;</span>
        <h2>Edit Post</h2>
        
        <div class="form">
            <form action="update_post.php" method="POST">
                <input type="hidden" id="postId" name="post_id" value="<?php echo $post['id']; ?>">

                <label for="judul">Judul *</label>
                <input type="text" id="judul" name="judul" value="<?php echo $post['judul']; ?>" required>

                <label for="konten">Konten *</label>
                <textarea name="konten" id="konten" required><?php echo $post['konten']; ?></textarea>

                <label for="tanggal">Tanggal *</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo $post['tanggal']; ?>" required>

                <label for="kategori">Kategori *</label>
                <select id="kategori" name="kategori" required>
                    <option value="Administrasi" <?php echo $post['kategori'] == 'Administrasi' ? 'selected' : ''; ?>>Administrasi</option>
                    <option value="Persiapan" <?php echo $post['kategori'] == 'Persiapan' ? 'selected' : ''; ?>>Persiapan</option>
                    <option value="Hari Acara" <?php echo $post['kategori'] == 'Hari Acara' ? 'selected' : ''; ?>>Hari Acara</option>
                </select>
                <label for="division">Pilih Divisi *</label>
<select id="division" name="division" required>
    <?php
    include '../db.php';

    // Misalkan program_id yang Anda kirimkan lewat session disimpan dalam variabel $program_id
    // Gantilah ini dengan cara Anda mengambil program_id dari session atau sumber lainnya
    $program_id = $_SESSION['program_id']; // Contoh saja, sesuaikan dengan cara Anda

    // Query untuk mengambil divisi yang terkait dengan program_id tertentu
    $sql_divisi = "SELECT id, nama FROM divisi WHERE program_id = ?";
    $stmt_divisi = $conn->prepare($sql_divisi);
    $stmt_divisi->bind_param('i', $program_id);
    $stmt_divisi->execute();
    $result_divisi = $stmt_divisi->get_result();

    while ($row_divisi = $result_divisi->fetch_assoc()) {
        $selected = $row_divisi['id'] == $post['divisi_id'] ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($row_divisi['id']) . '" ' . $selected . '>' . htmlspecialchars($row_divisi['nama']) . '</option>';
    }

    $stmt_divisi->close();
    $conn->close();
    ?>
</select>



                <button type="submit" class="submit-button"><i class="fa-solid fa-upload"></i> Update</button>
                
            </form>
            
        </div>
        
    </div>
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tangkap semua elemen dengan kelas openPopupBtn
    var editButtons = document.querySelectorAll('.openPopupBtn');

    // Loop melalui setiap elemen dan tambahkan event listener untuk klik
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var postId = this.getAttribute('data-postid'); // Ambil post_id dari atribut data-postid
            if (postId) {
                // Lakukan apa yang Anda inginkan dengan postId di sini
                console.log('Post ID yang diklik:', postId);

                // Contoh: Buka popup dengan id popup8
                var popupId = this.getAttribute('data-popup');
                var popup = document.getElementById(popupId);
                if (popup) {
                    popup.style.display = 'block';
                    // Lakukan pengiriman AJAX untuk mengambil data post dengan post_id
                    fetchPostData(postId); // Fungsi untuk mengambil data post menggunakan AJAX
                } else {
                    console.error('Popup dengan id ' + popupId + ' tidak ditemukan.');
                }
            } else {
                console.error('Data post_id tidak tersedia.');
            }
        });
    });

    // Fungsi untuk mengambil data post menggunakan AJAX
    function fetchPostData(postId) {
    fetch('get_post_data.php?post_id=' + postId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan saat mengambil data post. Status: ' + response.status);
            }
            return response.text(); // Mengambil teks dari respons (bukan JSON)
        })
        .then(data => {
            try {
                // Coba untuk menguraikan JSON dari data yang diterima
                const jsonData = JSON.parse(data);
                
                // Pastikan data tidak berisi error
                if (jsonData.error) {
                    throw new Error(jsonData.error); // Melempar error jika ada pesan error dalam JSON
                }

                // Tampilkan data di form edit
                document.getElementById('judul').value = jsonData.judul;
                document.getElementById('konten').value = jsonData.konten;
                document.getElementById('konteni').textContent = jsonData.konten;
                document.getElementById('tanggal').value = jsonData.tanggal;
                document.getElementById('kategori').value = jsonData.kategori;
                document.getElementById('division').value = jsonData.divisi_id;

                // Debug: Tampilkan data yang diterima di console
                console.log('Data post yang diterima:', jsonData);
            } catch (error) {
                // Tangani error saat parsing JSON
                console.error('Error parsing JSON:', error);
                alert('Terjadi kesalahan saat memproses data post.');
            }
        })
        .catch(error => {
            // Tangani error saat fetching data
            console.error('Error fetching post data:', error);
            alert('Terjadi kesalahan saat mengambil data post.');
        });
}


});
</script>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

          
              <script src="popup.js"></script>
          
          </section>
        </div>

      
       
  </main>

</body>


</html>