<?php
ob_start();
session_start();
require_once __DIR__ . '/db.php';

// Kullanıcının geldiği sayfayı hafızaya al, bulamazsa index.php'ye yolla
$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: $redirect_url");
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    $_SESSION['error_message'] = 'Lütfen e-posta ve şifrenizi girin.';
    $_SESSION['open_modal'] = 'login'; 
    header("Location: $redirect_url");
    exit;
}

$stmt = $conn->prepare('SELECT id, full_name, password_hash, profile_pic FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['profile_pic'] = $user['profile_pic'];
        $_SESSION['success_message'] = 'Hoş geldin, ' . $user['full_name'] . '!';
        
        header("Location: $redirect_url");
        exit;
    } else {
        $_SESSION['error_message'] = 'Hatalı şifre girdiniz.';
        $_SESSION['open_modal'] = 'login'; 
        header("Location: $redirect_url");
        exit;
    }
} else {
    $_SESSION['error_message'] = 'Böyle bir kullanıcı yok, lütfen kayıt olun.';
    $_SESSION['open_modal'] = 'login'; 
    header("Location: $redirect_url");
    exit;
}

ob_end_flush();
exit;
?>