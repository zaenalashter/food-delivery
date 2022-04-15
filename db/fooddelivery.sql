-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for fooddelivery
CREATE DATABASE IF NOT EXISTS `fooddelivery` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `fooddelivery`;

-- Dumping structure for table fooddelivery.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table fooddelivery.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.kategori: ~0 rows (approximately)
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

-- Dumping structure for table fooddelivery.keranjang
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(2) NOT NULL,
  `total` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `expired` int(11) NOT NULL,
  `id_pelanggan` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.keranjang: ~0 rows (approximately)
/*!40000 ALTER TABLE `keranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `keranjang` ENABLE KEYS */;

-- Dumping structure for table fooddelivery.log_pemesanan
CREATE TABLE IF NOT EXISTS `log_pemesanan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(2) NOT NULL,
  `total` int(11) NOT NULL,
  `kd_pemesanan` varchar(11) NOT NULL,
  `id_pelanggan` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.log_pemesanan: ~0 rows (approximately)
/*!40000 ALTER TABLE `log_pemesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_pemesanan` ENABLE KEYS */;

-- Dumping structure for table fooddelivery.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2022-04-14-215858', 'App\\Database\\Migrations\\Pelanggan', 'default', 'App', 1650035459, 1),
	(2, '2022-04-14-222434', 'App\\Database\\Migrations\\LogPemesanan', 'default', 'App', 1650035459, 1),
	(3, '2022-04-14-222445', 'App\\Database\\Migrations\\Keranjang', 'default', 'App', 1650035459, 1),
	(4, '2022-04-14-222453', 'App\\Database\\Migrations\\Produk', 'default', 'App', 1650035459, 1),
	(5, '2022-04-14-222512', 'App\\Database\\Migrations\\Kategori', 'default', 'App', 1650035459, 1),
	(6, '2022-04-14-222539', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1650035459, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table fooddelivery.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.pelanggan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;

-- Dumping structure for table fooddelivery.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table fooddelivery.produk: ~0 rows (approximately)
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
