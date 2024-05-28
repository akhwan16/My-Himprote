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
    .task-date {
            font-weight: bold;
           
            padding-bottom: 10px;
     
          
        }
        .task-date span {
            margin-left: 30px; /* Menggeser border ke kanan */
            border-bottom: 2px solid #1f4e79; /* Menambahkan border ke kanan */
        }
    .navbar {
    display: flex;
    align-items: center;
    width: 280px;
    height: 60px;
    background-color: #fff;
    border-radius: 30px;
    position: fixed;
    bottom: 10px; /* Adjust bottom margin if necessary */
    left: 50%; /* Center horizontally */
    transform: translateX(-50%); /* Center horizontally */
    border: 2px solid  #ccc; /* Added border */
justify-content: space-evenly;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), /* existing shadow */
                0 6px 20px rgba(0, 0, 0, 0.1); /* enhanced shadow */
}

.navbar-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #333;
    cursor: pointer;
    transition: color 0.3s ease, transform 0.3s ease;
}

.navbar-item.active {
    color: #002469;
}

.navbar-item i {
    font-size: 24px;
}

.navbar-item span {
    font-size: 12px;
    margin-top: 5px; /* Add space between icon and text */
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
 
<!-- Bootstrap JS and dependencies -->
<script src="calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
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

<script>
    const navbarItems = document.querySelectorAll('.navbar-item');

    navbarItems.forEach(item => {
        item.addEventListener('click', () => {
            navbarItems.forEach(nav => nav.classList.remove('active'));
            item.classList.add('active');
        });
    });
</script>
</footer>
</html>
