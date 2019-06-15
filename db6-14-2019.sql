-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for zayne
CREATE DATABASE IF NOT EXISTS `zayne` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `zayne`;

-- Dumping structure for table zayne.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zayne.admin: ~2 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `created_at`, `updated_at`, `username`, `password`) VALUES
	(2, '2019-06-13 11:42:07', '2019-06-13 11:42:07', 'zay', '$2y$10$J4gyAPAMmNpxACU44Hhndu4WpXlfPAsAY4ebmy2QOyCyk.GAhydVG'),
	(3, '2019-06-13 12:03:50', '2019-06-13 12:03:50', 'zayne', '$2y$10$jHgkx6qGuDUaxVzQ8PyiQek2oI7blAG/OL/yfCmjq6Gab8TIpiYKu');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table zayne.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` blob NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid on comments` (`userid`),
  CONSTRAINT `userid on comments` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This will hold the coments for the website';

-- Dumping data for table zayne.comments: ~0 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table zayne.img
CREATE TABLE IF NOT EXISTS `img` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `imgurl` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table zayne.img: ~4 rows (approximately)
DELETE FROM `img`;
/*!40000 ALTER TABLE `img` DISABLE KEYS */;
INSERT INTO `img` (`id`, `created_at`, `updated_at`, `imgurl`, `title`) VALUES
	(1, '2019-06-12 14:36:41', '2019-06-12 14:36:41', '', ''),
	(2, '2019-06-12 14:44:03', '2019-06-12 14:44:03', './img/1560375843.jpg', 'Apaca'),
	(3, '2019-06-12 14:44:32', '2019-06-12 14:44:32', './img/1560375872.jpg', 'My First Project updated'),
	(4, '2019-06-12 14:46:14', '2019-06-12 14:46:14', './img/1560375974.jpg', 'majestic llama');
/*!40000 ALTER TABLE `img` ENABLE KEYS */;

-- Dumping structure for table zayne.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table will store the user data.';

-- Dumping data for table zayne.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `created_at`, `updated_at`, `password`, `email`, `notes`) VALUES
	(2, '2019-06-11 14:41:49', '2019-06-11 14:41:49', '123456', 'zayne@toeverykid.org', ''),
	(4, '2019-06-12 06:16:54', '2019-06-12 06:16:54', '12345678', 'zaynemayfield@gmail.com', NULL),
	(5, '2019-06-12 14:46:18', '2019-06-12 14:46:18', '12345678', 'zaynemayfield@gmail.com', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
