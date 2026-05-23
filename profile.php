<?php 
session_start(); 
require_once __DIR__ . '/php/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT full_name, phone, email, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$avatarPath = !empty($user['profile_pic']) ? 'uploads/' . $user['profile_pic'] : 'images/default-avatar.png';
?>
<!DOCTYPE html>
<html lang="tr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim - DriveNow</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="profile-page">
    
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

    <div class="profile-container">
        <div class="profile-box">
            <a href="index.php" class="profile-close-btn">&times;</a>
            
            <h2>Profil Bilgileri</h2>
            
            <?php if(isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
            <?php endif; ?>

            <form method="post" action="php/update_profile.php" enctype="multipart/form-data">
                
                <div class="avatar-current-box">
                    <img src="<?php echo $avatarPath; ?>" alt="Mevcut Profil Resmi" class="current-profile-img">
                    <label class="file-label">
                        Visual Değiştir
                        <input type="file" name="profile_pic" accept="image/*">
                    </label>
                </div>

                <div class="input-group">
                    <label>Ad Soyad</label>
                    <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                </div>

                <div class="input-group">
                    <label>Telefon Numarası</label>
                    <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                </div>

                <div class="input-group">
                    <label>E-posta Adresi</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <button type="submit" class="save-btn">Değişiklikleri Kaydet</button>
            </form>
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