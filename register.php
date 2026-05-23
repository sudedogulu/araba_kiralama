<?php session_start(); ?>
<!DOCTYPE html>
<html lang="tr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Kayıt Ol - DriveNow</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body class="home-page">
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

    <form action="php/register.php" method="POST">
        <h2>Kayıt Ol</h2>
        <input type="text" name="full_name" placeholder="Ad Soyad" required>
        <input type="text" name="phone" placeholder="Telefon Numarası" required>
        <input type="email" name="email" placeholder="E-posta" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <input type="password" name="password2" placeholder="Şifreyi Doğrula" required>
        <button type="submit">Kayıt Ol</button>
    </form>
    
    <script src="js/style.js"></script>
</body>
</html>