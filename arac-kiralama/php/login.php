<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../main_menu.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validasyon
if (empty($email) || empty($password)) {
    die('<p>Lütfen e-posta ve şifre bilgilerinizi girin.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

// Veritabanından kullanıcıyı bul
$stmt = $conn->prepare('SELECT id, password_hash FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die('<p>E-posta veya şifre hatalı.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

$user = $result->fetch_assoc();

// Şifreyi kontrol et
if (!password_verify($password, $user['password_hash'])) {
    die('<p>E-posta veya şifre hatalı.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

// Session oluştur ve yönlendir
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $email;

header('Location: ../../main_menu.php');
exit;
?>