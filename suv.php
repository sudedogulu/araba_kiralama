<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUV Araçlar - DriveNow</title>
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

    <div class="login-modal" id="rentModal">
      <div class="modal-box">
        <button class="close" type="button" onclick="closeRentModal()">×</button>
        <h2 id="rentCarTitle" style="color: #333;">Araç Kirala</h2>
        <p style="color:#666; margin-bottom:10px;">Lütfen kiralama sürenizi seçin:</p>
        
        <form method="get" action="reservation.php">
            <input type="hidden" name="car_name" id="hiddenCarName">
            
            <div class="rent-options">
                <label>
                    <input type="radio" name="duration" value="1" checked>
                    1 Günlük - <strong id="price1"></strong> ₺
                </label>
                <label>
                    <input type="radio" name="duration" value="3">
                    3 Günlük (%5 İndirimli) - <strong id="price3"></strong> ₺
                </label>
                <label>
                    <input type="radio" name="duration" value="7">
                    7 Günlük (%10 İndirimli) - <strong id="price7"></strong> ₺
                </label>
            </div>
            
            <button type="submit" class="action-btn">Rezerve Et</button>
        </form>
      </div>
    </div>
    
    <div class="gallery-modal" id="galleryModal">
        <div class="gallery-content">
            <span class="gallery-close" onclick="closeGalleryModal()">&times;</span>
            <div class="main-image-container">
                <img src="" alt="" class="main-image" id="mainGalleryImage">
            </div>
            <div class="thumbnail-container" id="thumbnailContainer">
            </div>
        </div>
    </div>

    <section class="cars-section">
        <h2>SUV Araçlar</h2>
        <p class="section-desc">Geniş iç hacmi, yüksek sürüş pozisyonu ve güçlü performansıyla maceralarınız için ideal SUV araçlarımız.</p>

        <div class="car-grid">
            
            <div class="car-card">
                <img src="images/suv/bmw_x5_suv.png" alt="BMW X5" onclick="openGalleryModal('BMW X5', ['images/suv/bmw_ön.png', 'images/suv/bmw_iç.png', 'images/suv/bmw_bagaj.png'])">
                <h3>BMW X5</h3>
                <p class="info">Lüks ve dinamik sürüş deneyimini geniş iç hacimle birleştiren premium SUV.</p>
                <p class="price">Günlük: 5.000 ₺</p>
                <button class="action-btn" onclick="openRentModal('BMW X5', 5000)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/suv/mercedes_g-class_suv.png" alt="Mercedes G-Class" onclick="openGalleryModal('Mercedes G-Class', ['images/suv/mercedesg_ön.png', 'images/suv/mercedesg_iç.png', 'images/suv/mercedesg_bagaj.png'])">
                <h3>Mercedes G-Class</h3>
                <p class="info">İkonik tasarımı ve üstün arazi yetenekleriyle rakipsiz bir prestij sembolü.</p>
                <p class="price">Günlük: 15.000 ₺</p>
                <button class="action-btn" onclick="openRentModal('Mercedes G-Class', 15000)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/suv/porsche_cayanne_suv.png" alt="Porsche Cayenne" onclick="openGalleryModal('Porsche Cayenne', ['images/suv/porsche_ön.png', 'images/suv/porsche_iç.png', 'images/suv/porsche_bagaj.png'])">
                <h3>Porsche Cayenne</h3>
                <p class="info">Spor otomobil ruhunu SUV pratikliğiyle harmanlayan eşsiz bir performans aracı.</p>
                <p class="price">Günlük: 9.000 ₺</p>
                <button class="action-btn" onclick="openRentModal('Porsche Cayenne', 9000)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/suv/range_rover_suv.png" alt="Range Rover" onclick="openGalleryModal('Range Rover', ['images/suv/rangerover_ön.png', 'images/suv/rangerover_iç.png', 'images/suv/rangerover_bagaj.png'])">
                <h3>Range Rover</h3>
                <p class="info">İngiliz zarafeti ve üst düzey konforuyla hem şehirde hem de arazide kusursuz.</p>
                <p class="price">Günlük: 12.000 ₺</p>
                <button class="action-btn" onclick="openRentModal('Range Rover', 12000)">Hemen Kirala</button>
            </div>

        </div>
    </section>

    <footer class="bottom-barrier">
        <h3>DriveNow</h3>
        <div class="bottom-links">
            <a href="about.php">Hakkımızda</a>
            <a href="contact.php">İletişim</a>
            <a href="reservation.php">Rezervasyon</a>
        </div>
    </footer>

    <script src="js/style.js"></script>
</body>
</html>