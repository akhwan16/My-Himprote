<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
</head>

<body>
  <div class="body2">
    <nav>
        <img id="logohimprote" src="Assets/img/Group 75.png" alt="Logo" />
    </nav>
    
    <div class="login-button">
        <span id="masuk">
          Masuk Dengan Email UNNES
        </span>
        
        <form id="loginForm" method="post" action="../Validation/check_login.php"> <!-- Menambahkan formulir dan aksi -->
            <input type="hidden" id="email" name="email"> <!-- Input tersembunyi untuk menyimpan email -->
            <input type="hidden" id="profile_image" name="profile_image">
            <button type="button" onclick="loginWithGoogle()"> <!-- Mengganti tipe tombol menjadi "button" -->
              <img src="Assets/img/google.png" alt="Google Logo" />Sign With Google
            </button>
        </form>  
    </div>
      
    <script>
      function loginWithGoogle() {
          // URL untuk autentikasi dengan Google
          var authUrl = "https://accounts.google.com/o/oauth2/auth";
          // Parameter yang diperlukan untuk autentikasi OAuth dengan Google
          var params = {
              client_id: "482588250991-3shi05uql873ibpskvvt2jtia9nh720g.apps.googleusercontent.com",
              redirect_uri: "http://localhost:3000",
              response_type: "token",
              scope: "email profile", // Anda dapat menyesuaikan ruang lingkup (scope) sesuai kebutuhan aplikasi Anda
              prompt: "select_account" // Memastikan bahwa pengguna dapat memilih akun Google lainnya
          };
          // Membangun URL autentikasi dengan parameter yang diberikan
          var authQueryString = Object.keys(params)
              .map((key) => key + "=" + encodeURIComponent(params[key]))
              .join("&");
          var authUrlWithParams = authUrl + "?" + authQueryString;
          // Redirect ke halaman autentikasi Google
          window.location.href = authUrlWithParams;
      }
  
      function handleLoginResponse() {
          var token = new URLSearchParams(window.location.hash.substr(1)).get("access_token");
          if (token) {
              // Panggil fungsi untuk mengambil informasi pengguna setelah berhasil login
              getUserInfo(token);
          } else {
              // Tampilkan pesan atau menu pilih akun Google lainnya
            
          }
      }
  
      function showAlternativeAccountOptions() {
        
          // Menampilkan pesan atau elemen lainnya
          var messageElement = document.getElementById("alternativeAccountMessage");
          if (messageElement) {
              messageElement.style.display = "block";
          }
      }
  
      function getUserInfo(token) {
          // Mengirim permintaan ke Google API untuk mendapatkan informasi pengguna dengan token
          // Anda perlu menyesuaikan URL API sesuai dengan dokumentasi Google
          var userInfoUrl = "https://www.googleapis.com/oauth2/v3/userinfo?access_token=" + token;
  
          // Mengirim permintaan AJAX
          var xhr = new XMLHttpRequest();
          xhr.open("GET", userInfoUrl, true);
          xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                      // Jika permintaan berhasil, ambil informasi pengguna
                      var response = JSON.parse(xhr.responseText);
                      var email = response.email; // Ambil email pengguna dari respons
                      var profileImage = response.picture; // Ambil URL foto profil dari respons
                      document.getElementById("email").value = email; // Setel nilai input tersembunyi dengan email
                      document.getElementById("profile_image").value = profileImage; // Setel nilai input tersembunyi dengan URL gambar profil
                      document.getElementById("loginForm").submit(); // Kirim formulir
                      // Simpan data profil di localStorage atau sessionStorage
                      localStorage.setItem("profileImage", profileImage);
                      localStorage.setItem("email", email);
                  } else {
                      console.error("Failed to fetch user info:", xhr.status);
                      // Tampilkan pesan atau menu pilih akun Google lainnya
                      showAlternativeAccountOptions();
                  }
              }
          };
          xhr.send();
      }
  
      handleLoginResponse(); // Panggil fungsi untuk menangani respons setelah login
    </script>
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous">
    </script>
  </div>
</body>

<footer>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f3f4f5" fill-opacity="1" d="M0,224L60,202.7C120,181,240,139,360,112C480,85,600,75,720,85.3C840,96,960,128,1080,117.3C1200,107,1320,53,1380,26.7L1440,0L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
</footer>

</html>
