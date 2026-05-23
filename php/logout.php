<?php
session_start();

// 1. Tüm session değişkenlerini temizle
$_SESSION = array();

// 2. Eğer varsa oturum çerezini (cookie) sil
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Oturumu tamamen yok et
session_destroy();

// 4. Ana sayfaya yönlendir
header('Location: ../index.php');
exit;
?>