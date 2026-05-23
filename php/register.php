<?php
ob_start();
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$fullName = trim($_POST['full_name'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';

if (empty($fullName) || empty($phone) || empty($email) || empty($password) || empty($password2)) {
    $_SESSION['error_message'] = 'Lütfen tüm alanları doldurun.';
    $_SESSION['open_modal'] = 'register';
    header('Location: ../index.php');
    exit;
}

if ($password !== $password2) {
    $_SESSION['error_message'] = 'Şifreler eşleşmiyor.';
    $_SESSION['open_modal'] = 'register';
    header('Location: ../index.php');
    exit;
}

$checkEmail = $conn->prepare('SELECT id FROM users WHERE email = ?');
$checkEmail->bind_param('s', $email);
$checkEmail->execute();
if ($checkEmail->get_result()->num_rows > 0) {
    $_SESSION['error_message'] = 'Bu e-posta zaten kayıtlı.';
    $_SESSION['open_modal'] = 'register';
    header('Location: ../index.php');
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO users (full_name, phone, email, password_hash) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $fullName, $phone, $email, $passwordHash);

if ($stmt->execute()) {
    $_SESSION['success_message'] = 'Başarıyla kayıt oldunuz! Lütfen giriş yapın.';
    $_SESSION['open_modal'] = 'login'; // Başarılıysa kayıt kutusunu kapat, login kutusunu aç!
    header('Location: ../index.php');
} else {
    $_SESSION['error_message'] = 'Kayıt sırasında bir hata oluştu.';
    $_SESSION['open_modal'] = 'register';
    header('Location: ../index.php');
}

ob_end_flush();
exit;
?>