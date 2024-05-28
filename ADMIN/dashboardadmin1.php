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
   
</head>
<body>
  
    <div class="container-fluid">
        <div class="header-container">
            <div class="logo">
                <img src="../Assets/img/Group 207.png" alt="Logo">
            </div>
            <div class="reminder">
                REMINDER!
            </div>
        </div>
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
<!-- Bootstrap JS and dependencies -->
<script src="calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
