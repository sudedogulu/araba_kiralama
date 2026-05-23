<?php
$conn = mysqli_connect("localhost", "root", "", "ARABA_KIRALAMA");

if (!$conn) {
    die("Bağlantı başarısız: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

if (mysqli_query($conn, $sql)) {
    echo "<h2 style='color: green; font-family: Arial;'>✅ Tablo başarıyla oluşturuldu!</h2>";
    echo "<p>Users tablosu ARABA_KIRALAMA veritabanında oluşturulmuştur.</p>";
    echo "<p><a href='../index.php'>Ana sayfaya dön</a></p>";
} else {
    echo "<h2 style='color: red; font-family: Arial;'>❌ Hata oluştu!</h2>";
    echo "<p>Hata: " . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);
?>