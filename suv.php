<?php 
session_set_cookie_params(0);
session_start(); 
?>
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
        </div>
    </footer>

    <script src="js/style.js"></script>
</body>
</html>