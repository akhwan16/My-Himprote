<?php
include 'checkakun.php'
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
        <span style ="margin-left: -10px;" class="year-change" id="prev-year"><pre>&lt;</pre></span>
        <span style ="margin-left: -140px; margin-top: 15px; font-size: 11px;" class="month-picker" id="month-picker">&lt;February&gt;</span> <!-- Menggunakan entity HTML untuk tanda <> -->
        <span style ="margin-left: -130px;" class="year-change" id="next-year"><pre>&gt;</pre></span>
        
      
       
      <!-- Menggunakan pre untuk tanda < -->
        </span>
        <div  style ="margin-top: 15px;" class="year-picker">
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
   <!-- Tombol untuk berganti slide -->
 

    <div class="slide fade">
        <div class="slide-content">
            <h2>Slide 2</h2>
            <p>Ini adalah konten slide 2.</p>
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
