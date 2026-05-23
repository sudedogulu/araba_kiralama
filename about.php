<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda - DriveNow</title>
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

    <section class="content-section">
        <h2>Hakkımızda</h2>
        <p> 
            <strong> Yolculuğunuzda Güvenin ve Konforun Yeni Adresi: DriveNow</strong>
        </p>
        <p>
DriveNow olarak yola çıktığımız ilk günden bu yana müşteri memnuniyetini her zaman en ön planda tutuyor; sizlere yalnızca bir araç değil, güvenilir, konforlu ve yenilikçi bir seyahat deneyimi sunuyoruz.<br>

Geniş, bakımlı ve sürekli yenilenen araç filomuzla, hem bireysel hem de kurumsal seyahat ihtiyaçlarınız için en esnek çözümleri üretiyoruz. İster kısa bir hafta sonu kaçamağı, ister uzun soluklu bir iş gezisi olsun; her bütçeye ve tarza uygun seçeneklerimizle yolculuklarınızı standart bir rutinden çıkarıp güvenli bir keyfe dönüştürüyoruz.<br><br>

<i>Misyonumuz</i><br><br>
Araç kiralama sürecini yorucu ve karmaşık prosedürlerden arındırarak; hızlı, şeffaf ve herkes için ulaşılabilir hale getirmek. Müşterilerimizin direksiyon başına geçtiği her an, kendilerini güvende ve özel hissetmelerini sağlamak.<br><br>

<i>Vizyonumuz</i><br><br>
Sektördeki küresel dinamikleri ve yenilikleri yakından takip ederek kiralama deneyimini yeni nesil teknolojilerle kusursuzlaştırmak; Türkiye’nin en çok tercih edilen ve tavsiye edilen yenilikçi araç kiralama markası olmak.<br><br><br>

<strong><i>Neden DriveNow'ı Seçmelisiniz?</i></strong><br><br>

Yeni Nesil ve Geniş Filo: Ekonomik sınıftan lüks SUV modellere kadar, periyodik bakımları eksiksiz yapılmış son model araç seçenekleri.<br><br>

Şeffaf Fiyatlandırma Politikası: Gizli maliyetler veya sürpriz ek ücretler olmadan, baştan sona dürüst ve bütçe dostu hizmet anlayışı.<br><br>

7/24 Kesintisiz Destek: Yalnızca aracı kiralarken değil, yolculuğunuzun her anında bir telefon uzağınızda olan profesyonel müşteri hizmetleri.<br><br>

Hızlı ve Kolay Rezervasyon: Kullanıcı dostu web sitemiz sayesinde, dilediğiniz aracı sadece dakikalar içinde kiralama özgürlüğü.<br><br>

Yolculuk nereye olursa olsun, DriveNow ile direksiyon hep güvenli ellerde. Hayalinizdeki rotayı belirleyin, gerisini bize bırakın!
        </p>
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