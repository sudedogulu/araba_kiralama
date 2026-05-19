<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../main_menu.php');
    exit;
}

$fullName = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';

// Validasyon
if (empty($fullName) || empty($phone) || empty($email) || empty($password) || empty($password2)) {
    die('<p>Lütfen tüm alanları doldurun.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('<p>Geçerli bir e-posta adresi girin.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

if (!preg_match('/^[0-9+\s()-]{7,20}$/', $phone)) {
    die('<p>Geçerli bir telefon numarası girin.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

if ($password !== $password2) {
    die('<p>Şifreler eşleşmiyor.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

if (strlen($password) < 6) {
    die('<p>Şifre en az 6 karakter olmalıdır.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

// E-posta zaten kayıtlı mı kontrol et
$checkEmail = $conn->prepare('SELECT id FROM users WHERE email = ?');
$checkEmail->bind_param('s', $email);
$checkEmail->execute();
$result = $checkEmail->get_result();

if ($result->num_rows > 0) {
    die('<p>Bu e-posta zaten kayıtlı.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}

// Şifreyi hash'le ve kaydet
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO users (full_name, phone, email, password_hash) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $fullName, $phone, $email, $passwordHash);

if ($stmt->execute()) {
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['user_email'] = $email;
    header('Location: ../../main_menu.php');
    exit;
} else {
    die('<p>Kayıt sırasında hata oluştu. Tekrar deneyin.</p><p><a href="../../main_menu.php">Geri dön</a></p>');
}
?>