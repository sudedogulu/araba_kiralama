<?php 
session_set_cookie_params(0);
session_start(); 
?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedan Araçlar - DriveNow</title>
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

    <div id="rentModal" class="modal login-modal">
        <div class="modal-box">
            <button class="close" onclick="closeRentModal()">&times;</button>
            <h2 id="selectedCarName" style="color: #bf94ff; margin-bottom: 20px;">Araç Kirala</h2>
            
            <form action="rent_process.php" method="POST" id="rentForm">
                <input type="hidden" id="carNameInput" name="car_name">
                <input type="hidden" id="dailyPriceInput">
                <input type="hidden" id="totalPriceInput" name="total_price">

                <div class="input-group">
                    <select name="pickup_location" required style="width: 100%; padding: 14px; border-radius: 12px; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.12); color: white;">
                        <option value="" disabled selected>Alış Noktası Seçin</option>
                        <option value="İstanbul - Kadıköy">İstanbul - Kadıköy</option>
                        <option value="İstanbul - Havalimanı">İstanbul - Havalimanı</option>
                        <option value="Ankara - Çankaya">Ankara - Çankaya</option>
                        <option value="İzmir - Alsancak">İzmir - Alsancak</option>
                    </select>
                </div>

                <div class="input-group" style="margin-top: 15px;">
                    <select name="dropoff_location" required style="width: 100%; padding: 14px; border-radius: 12px; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.12); color: white;">
                        <option value="" disabled selected>Teslim Noktası Seçin</option>
                        <option value="İstanbul - Kadıköy">İstanbul - Kadıköy</option>
                        <option value="İstanbul - Havalimanı">İstanbul - Havalimanı</option>
                        <option value="Ankara - Çankaya">Ankara - Çankaya</option>
                        <option value="İzmir - Alsancak">İzmir - Alsancak</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <div class="input-group" style="flex: 1;">
                        <label style="color: #aaa; font-size: 12px; margin-bottom: 5px; display: block;">Alış Tarihi</label>
                        <input type="date" id="startDate" name="start_date" required style="width: 100%;">
                    </div>
                    <div class="input-group" style="flex: 1;">
                        <label style="color: #aaa; font-size: 12px; margin-bottom: 5px; display: block;">Teslim Tarihi</label>
                        <input type="date" id="endDate" name="end_date" required style="width: 100%;">
                    </div>
                </div>

                <div style="text-align: center; background: rgba(0,0,0,0.3); padding: 15px; border-radius: 12px; margin-top: 20px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #aaa; font-size: 14px;">Toplam Tutar</span><br>
                    <strong id="totalPriceDisplay" style="color: #28a745; font-size: 28px;">0 ₺</strong>
                </div>

                <button type="submit" class="action-btn" style="background: #28a745; margin-top: 15px; font-weight: bold; font-size: 16px;">Rezervasyonu Tamamla</button>
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
        <h2>Sedan Araçlar</h2>
        <p class="section-desc">Konforu ve şıklığı bir arada sunan araçlarımızla uzun yollar artık çok daha keyifli.</p>

        <div class="car-grid">
            
            <div class="car-card">
                <img src="images/sedan/honda_civic_sedan.png" alt="Honda Civic" onclick="openGalleryModal('Honda Civic', ['images/sedan/honda_ön.png', 'images/sedan/honda_iç.png', 'images/sedan/honda_bagaj.png'])">
                <h3>Honda Civic</h3>
                <p class="info">Düşük yakıt tüketimi, geniş iç hacmi ve konforuyla şehir içi kullanımın vazgeçilmezi.</p>
                <p class="price">Günlük: 1.500 ₺</p>
                <button class="action-btn" onclick="openRentModal('Honda Civic', 1500)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/sedan/mercedes_amg_sedan.png" alt="Mercedes AMG S" onclick="openGalleryModal('Mercedes AMG S', ['images/sedan/mercedes_ön.png', 'images/sedan/mercedes_iç.png', 'images/sedan/mercedes_bagaj.png'])">
                <h3>Mercedes AMG S Serisi</h3>
                <p class="info">Üst düzey lüks ve high performans. Prestij arayanlar için özel bir deneyim.</p>
                <p class="price">Günlük: 10.000 ₺</p>
                <button class="action-btn" onclick="openRentModal('Mercedes AMG S', 10000)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/sedan/dodge_chalenge_sedan.png" alt="Dodge Challenger" onclick="openGalleryModal('Dodge Challenger', ['images/sedan/dodge_ön.png', 'images/sedan/dodge_iç.png', 'images/sedan/dodge_bagaj.png'])">
                <h3>Dodge Challenger</h3>
                <p class="info">Amerikan kası! Eşsiz V8 motor sesi ve agresif tasarımıyla tüm gözler üzerinizde olsun.</p>
                <p class="price">Günlük: 8.500 ₺</p>
                <button class="action-btn" onclick="openRentModal('Dodge Challenger', 8500)">Hemen Kirala</button>
            </div>

            <div class="car-card">
                <img src="images/sedan/nissan_gtr_sedan.png" alt="Nissan GT-R" onclick="openGalleryModal('Nissan GT-R', ['images/sedan/nissan_ön.png', 'images/sedan/nissan_iç.png', 'images/sedan/nissan_bagaj.png'])">
                <h3>Nissan GT-R</h3>
                <p class="info">Godzilla lakaplı efsane. Pistlerden yollara inen inanılmaz hız ve tutuş performansı.</p>
                <p class="price">Günlük: 12.000 ₺</p>
                <button class="action-btn" onclick="openRentModal('Nissan GT-R', 12000)">Hemen Kirala</button>
            </div>

        </div>
    </section>

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