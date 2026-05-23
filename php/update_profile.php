<?php
ob_start();
session_start();
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$userId   = $_SESSION['user_id'];
$fullName = trim($_POST['full_name'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$email    = trim($_POST['email'] ?? '');

if (empty($fullName) || empty($phone) || empty($email)) {
    $_SESSION['error_message'] = 'Lütfen tüm alanları doldurun.';
    header('Location: ../profile.php');
    exit;
}

// E-posta adresi başka bir kullanıcı tarafından kapılmış mı kontrolü
$checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
$checkEmail->bind_param("si", $email, $userId);
$checkEmail->execute();
if ($checkEmail->get_result()->num_rows > 0) {
    $_SESSION['error_message'] = 'Bu e-posta adresi başka bir hesap tarafından kullanılıyor.';
    header('Location: ../profile.php');
    exit;
}

// PROFİL FOTOĞRAFI YÜKLEME İŞLEMİ
$profilePicName = null;
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
    $fileName    = $_FILES['profile_pic']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    // Sadece resim formatlarına izin ver
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileExtension, $allowedExtensions)) {
        // Benzersiz bir dosya adı oluştur (Örn: user_1_17154823.png)
        $profilePicName = 'user_' . $userId . '_' . time() . '.' . $fileExtension;
        
        // Yükleme klasörünü kontrol et, yoksa oluştur
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $destPath = $uploadDir . $profilePicName;
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Eski resmi veritabanından bulup klasörden silme (Temizlik)
            $oldPicQuery = $conn->prepare("SELECT profile_pic FROM users WHERE id = ?");
            $oldPicQuery->bind_param("i", $userId);
            $oldPicQuery->execute();
            $oldPic = $oldPicQuery->get_result()->fetch_assoc()['profile_pic'];
            if (!empty($oldPic) && file_exists($uploadDir . $oldPic)) {
                unlink($uploadDir . $oldPic);
            }
        } else {
            $profilePicName = null; // Yükleme başarısızsa null kalır
        }
    }
}

// VERİTABANI GÜNCELLEME
if ($profilePicName !== null) {
    // Fotoğraf değiştiyse her şeyi güncelle
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, phone = ?, email = ?, profile_pic = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $fullName, $phone, $email, $profilePicName, $userId);
    $_SESSION['profile_pic'] = $profilePicName; // Session'ı güncelle
} else {
    // Fotoğraf değişmediyse sadece metinleri güncelle
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, phone = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $fullName, $phone, $email, $userId);
}

if ($stmt->execute()) {
    $_SESSION['full_name'] = $fullName; // Navbardaki ismin anında değişmesi için
    $_SESSION['success_message'] = 'Profil bilgileriniz başarıyla güncellendi.';
} else {
    $_SESSION['error_message'] = 'Güncelleme sırasında bir hata oluştu.';
}

header('Location: ../profile.php');
ob_end_flush();
exit;
?>