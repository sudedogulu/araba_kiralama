<?php
session_start();
$userEmail = $_SESSION['user_email'] ?? null;
$isLoggedIn = !empty($userEmail);
?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Araç Kiralama</title>
        <link rel="stylesheet" href="arac-kiralama/css/style.css">
    </head>
<body class="home-page">
    <nav>
        <h1>DriveNow</h1>

        <ul>
            <li><a href="main_menu.php">Ana Sayfa</a></li>
            <li><a href="cars.html">Araçlar</a></li>
            <li><a href="sedan.html">Sedan</a></li>
            <li><a href="electric.html">Elektrikli</a></li>
            <li><a href="economy.html">Ekonomik</a></li>
            <li><a href="suv.html">SUV</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="arac-kiralama/php/logout.php" class="login-btn profile-icon" title="Oturumu Kapat">&#128100;</a></li>
            <?php else: ?>
                <li><button class="login-btn" onclick="openLogin(event)">Giriş Yap/Kayıt Ol</button></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="login-modal" id="loginModal">
      <div class="modal-box">
        <button class="close" type="button" onclick="closeLogin()">×</button>
        <h2>Giriş Yap</h2>
        <form method="post" action="arac-kiralama/php/login.php">
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
        <form method="post" action="arac-kiralama/php/register.php">
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

    <section class="hero">
        <h2>Hayalindeki Aracı Kirala</h2>
        <p>Geniş araç seçeneklerimizle istediğin aracı kolayca kiralayabilirsin.</p>
        <img src="arac-kiralama/images/anasayfa.jpeg" alt="Arac Kiralama" >
    </section>
    <footer class="bottom-barrier">
        <h3>DriveNow</h3>
        <div class="bottom-links">
            <a href="about.html">Hakkımızda</a>
            <a href="contact.html">İletişim</a>
            <a href="reservation.html">Rezervasyon</a>
        </div>
    </footer>
    <script src="arac-kiralama/js/style.js"></script>
</body>
</html>
