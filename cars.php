<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araç Kategorileri - DriveNow</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
   <nav>
    <h1>DriveNow</h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        <li><a href="cars.php">Araçlar</a></li>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <li class="user-menu">
                <button class="profile-btn">
                    <img src="<?php echo !empty($_SESSION['profile_pic']) ? 'uploads/' . $_SESSION['profile_pic'] : 'images/default-avatar.png'; ?>" alt="Profil" class="avatar">
                    <?php echo htmlspecialchars($_SESSION['full_name']); ?> ▼
                </button>
                <div class="dropdown-content">
                    <a href="profile.php">Profilim</a>
                    <a href="php/logout.php">Çıkış Yap</a>
                </div>
            </li>
        <?php else: ?>
            <li><button class="login-btn" onclick="openLogin(event)">Giriş Yap/Kayıt Ol</button></li>
        <?php endif; ?>
    </ul>
</nav>

    <div class="login-modal" id="loginModal">
      <div class="modal-box">
        <button class="close" type="button" onclick="closeLogin()">×</button>
        <h2>Giriş Yap</h2>
        <form method="post" action="php/login.php">
            <input type="email" name="email" placeholder="E-posta" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit" class="action-btn">Giriş Yap</button>
        </form>
        <p>Hesabın yok mu? <a href="#" onclick="openRegister(event)">Kayıt ol</a></p>
      </div>
    </div>

    <div class="login-modal" id="registerModal">
      <div class="modal-box">
        <button class="close" type="button" onclick="closeRegister()">×</button>
        <h2>Kayıt Ol</h2>
        <form method="post" action="php/register.php">
            <input type="text" name="full_name" placeholder="Ad Soyad" required>
            <input type="tel" name="phone" placeholder="Telefon Numarası" required>
            <input type="email" name="email" placeholder="E-posta" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <input type="password" name="password2" placeholder="Şifreyi Tekrarla" required>
            <button type="submit" class="action-btn">Kayıt Ol</button>
        </form>
        <p>Zaten hesabın var mı? <a href="#" onclick="openLogin(event)">Giriş yap</a></p>
      </div>
    </div>

    <div class="category-container">
        <h2>Araç Kategorilerini Seçin</h2>
        <p>Sizin için en uygun araç kategorisini seçin</p>

        <div class="category-grid">
            <a href="sedan.php" class="category-card">
                <div class="category-image">
                    <img src="images/poster/sedan_poster.jpeg" alt="Sedan">
                </div>
                <div class="category-info">
                    <h3>Sedan</h3>
                    <p>Konforlu ve ekonomik</p>
                </div>
            </a>

            <a href="suv.php" class="category-card">
                <div class="category-image">
                    <img src="images/poster/suv_poster.jpeg" alt="SUV">
                </div>
                <div class="category-info">
                    <h3>SUV</h3>
                    <p>Güçlü ve geniş</p>
                </div>
            </a>

            <a href="electric.php" class="category-card">
                <div class="category-image">
                    <img src="images/poster/elektrikli_poster.jpeg" alt="Elektrikli">
                </div>
                <div class="category-info">
                    <h3>Elektrikli Araçlar</h3>
                    <p>Çevre dostu ve modern</p>
                </div>
            </a>

            <a href="economy.php" class="category-card">
                <div class="category-image">
                    <img src="images/poster/ekonomik_poster.jpeg" alt="Ekonomik">
                </div>
                <div class="category-info">
                    <h3>Ekonomik</h3>
                    <p>Uygun fiyatlı seçenek</p>
                </div>
            </a>
        </div>
    </div>

    <footer class="bottom-barrier">
        <h3>DriveNow</h3>
        <div class="bottom-links">
            <a href="about.php">Hakkımızda</a>
            <a href="contact.php">İletişim</a>
        </div>
    </footer>

    <script src="js/style.js"></script>
</body>
</html>