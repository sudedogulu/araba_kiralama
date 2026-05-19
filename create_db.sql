CREATE DATABASE IF NOT EXISTS `arac_kiralama`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE `arac_kiralama`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(30) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Örnek kullanıcı eklemek için:
-- INSERT INTO users (email, password_hash) VALUES ('test@example.com', '$2y$10$abcdefghijklmnopqrstuv');

-- Eğer `users` tablosunu daha önce oluşturduysanız ve yeni alanları eklemek isterseniz:
-- ALTER TABLE users ADD COLUMN full_name VARCHAR(255) NOT NULL AFTER id;
-- ALTER TABLE users ADD COLUMN phone VARCHAR(30) NOT NULL AFTER full_name;
