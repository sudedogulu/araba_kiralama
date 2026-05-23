<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon - DriveNow</title>
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

    <section class="reservation-section">
        <h2>Hemen Rezervasyon Yapın</h2>
        <p class="sub-text">Seyahatinizi planlamaya başlamak için aşağıdaki formu doldurun.</p>

        <div class="reservation-form-container">
            <form action="#" method="POST" class="reservation-form">
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Alış Yeri</label>
                        <select name="pickup_location" required>
                            <option value="">Seçiniz...</option>
                            <option value="istanbul-havalimani">İstanbul Havalimanı</option>
                            <option value="sabiha-gokcen">Sabiha Gökçen Havalimanı</option>
                            <option value="ankara-esenboga">Ankara Esenboğa Havalimanı</option>
                            <option value="izmir-adnan-menderes">İzmir Adnan Menderes Havalimanı</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Teslim Yeri</label>
                        <select name="dropoff_location" required>
                            <option value="">Seçiniz...</option>
                            <option value="istanbul-havalimani">İstanbul Havalimanı</option>
                            <option value="sabiha-gokcen">Sabiha Gökçen Havalimanı</option>
                            <option value="ankara-esenboga">Ankara Esenboğa Havalimanı</option>
                            <option value="izmir-adnan-menderes">İzmir Adnan Menderes Havalimanı</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Alış Tarihi</label>
                        <input type="date" name="pickup_date" required>
                    </div>
                    <div class="form-group">
                        <label>Teslim Tarihi</label>
                        <input type="date" name="dropoff_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tercih Edilen Araç Sınıfı</label>
                    <select name="car_class">
                        <option value="farketmez">Farketmez</option>
                        <option value="ekonomik">Ekonomik</option>
                        <option value="sedan">Sedan</option>
                        <option value="suv">SUV</option>
                        <option value="elektrikli">Elektrikli</option>
                    </select>
                </div>

                <button type="submit" class="action-btn" style="padding: 15px; font-size: 1.1em; cursor: pointer; margin-top: 10px;">Uygun Araçları Bul</button>
            </form>
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