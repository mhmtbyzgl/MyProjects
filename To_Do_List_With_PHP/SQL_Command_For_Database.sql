"!!!Veritabanı tablolarını oluşturmak için aşağıdaki kodu veritabanınızda çalıştırınız.!!!"
```SQL

-- Adminer 4.8.1 MySQL 5.5.5-10.6.12-MariaDB-0ubuntu0.22.04.1 dump

-- Adminer 4.8.1 MySQL 5.5.5-10.6.12-MariaDB-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `todolistphp`;
CREATE DATABASE `todolistphp` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci */;
USE `todolistphp`;

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(50) NOT NULL,
  `kullaniciadi` varchar(50) NOT NULL,
  `eposta` varchar(50) NOT NULL,
  `parola` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


DROP TABLE IF EXISTS `nottab`;
CREATE TABLE `nottab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notlar` varchar(250) NOT NULL,
  `nottarihi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;


-- 2023-09-27 20:04:05
<<<<<<< HEAD:PHP_Giris/To_Do_List_PHP/SQL_Command_For_Database.sql
=======

```
>>>>>>> 638627f5f9fd796eea1f82472de383ff2ef80396:PHP_Giris/To_Do_List_PHP/SQL_Command_For_Database.md
