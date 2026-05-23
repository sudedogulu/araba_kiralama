<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekonomik Araçlar - DriveNow</title>
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
        <h2>Ekonomik Araçlar</h2>
        <p class="section-desc">Bütçe dostu ve yakıt tüketimi düşük olan araçlarımızla ekonomik ve konforlu bir yolculuk deneyimi yaşayın.</p>

        <div class="car-grid">
            
            <div class="car-card">
                <img src="images/ekonomik/renault_clio_ekonomik.png" alt="Renault Clio" onclick="openGalleryModal('Renault Clio', ['images/ekonomik/renault_ön.png', 'images/ekonomik/renault_iç.png', 'images/ekonomik/renault_bagaj.png'])">
                <h3>Renault Clio</h3>
                <p class="info">Şehir içi kullanımda üstün yakıt tasarrufu ve dinamik sürüş keyfi bir arada.</p>
                <p class="price">Günlük: 800 ₺</p>
                <button class="action-btn" onclick="openRentModal('Renault Clio', 800)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/ekonomik/fiat_egea_ekonomik.png" alt="Fiat Egea" onclick="openGalleryModal('Fiat Egea', ['images/ekonomik/fiat_ön.png', 'images/ekonomik/fiat_iç.png', 'images/ekonomik/fiat_bagaj.png'])">
                <h3>Fiat Egea</h3>
                <p class="info">Geniş bagaj hacmi ve ferah iç mekanıyla tam bir aile ve seyahat aracı.</p>
                <p class="price">Günlük: 850 ₺</p>
                <button class="action-btn" onclick="openRentModal('Fiat Egea', 850)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/ekonomik/hyundai_i20_ekonomik.png" alt="Hyundai i20" onclick="openGalleryModal('Hyundai i20', ['images/ekonomik/hyundai_ön.png', 'images/ekonomik/hyundai_iç.png', 'images/ekonomik/hyundai_bagaj.png'])">
                <h3>Hyundai i20</h3>
                <p class="info">Kompakt tasarımı, modern teknolojileri ve kolay park imkanıyla pratik bir çözüm.</p>
                <p class="price">Günlük: 800 ₺</p>
                <button class="action-btn" onclick="openRentModal('Hyundai i20', 800)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/ekonomik/dacia_sandero_ekonomik.png" alt="Dacia Sandero" onclick="openGalleryModal('Dacia Sandero', ['images/ekonomik/dacia_ön.png', 'images/ekonomik/dacia_iç.png', 'images/ekonomik/dacia_bagaj.png'])">
                <h3>Dacia Sandero</h3>
                <p class="info">Sağlamlığı, yüksek oturma pozisyonu ve en uygun kiralama maliyetiyle öne çıkıyor.</p>
                <p class="price">Günlük: 750 ₺</p>
                <button class="action-btn" onclick="openRentModal('Dacia Sandero', 750)">Hemen Kirala</button>
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