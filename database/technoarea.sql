-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 05:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technoarea`
--
CREATE DATABASE IF NOT EXISTS `technoarea` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `technoarea`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: Apr 07, 2023 at 12:29 AM
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `admin`:
--

--
-- Truncate table before insert `admin`
--

TRUNCATE TABLE `admin`;
--
-- Dumping data for table `admin`
--

INSERT DELAYED IGNORE INTO `admin` (`login_id`, `username`, `password`) VALUES
(1, 'Admin', '0192023a7bbd73250516f069df18b500'),
(2, 'Cashier', 'dbb8c54ee649f8af049357a5f99cede6'),
(3, 'Bendahara', '62f7dec74b78ba0398e6a9f317f55126');

-- --------------------------------------------------------

--
-- Table structure for table `admin_akses`
--
-- Creation: Apr 07, 2023 at 01:11 AM
--

DROP TABLE IF EXISTS `admin_akses`;
CREATE TABLE IF NOT EXISTS `admin_akses` (
  `login_id` int(11) NOT NULL,
  `akses_id` varchar(70) NOT NULL,
  KEY `akses_id` (`akses_id`),
  KEY `login_id` (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `admin_akses`:
--   `akses_id`
--       `master_akses` -> `akses_id`
--   `login_id`
--       `admin` -> `login_id`
--

--
-- Truncate table before insert `admin_akses`
--

TRUNCATE TABLE `admin_akses`;
--
-- Dumping data for table `admin_akses`
--

INSERT DELAYED IGNORE INTO `admin_akses` (`login_id`, `akses_id`) VALUES
(1, 'cashier'),
(1, 'bendahara'),
(2, 'cashier'),
(3, 'bendahara');

-- --------------------------------------------------------

--
-- Table structure for table `master_akses`
--
-- Creation: Apr 07, 2023 at 01:07 AM
--

DROP TABLE IF EXISTS `master_akses`;
CREATE TABLE IF NOT EXISTS `master_akses` (
  `akses_id` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  PRIMARY KEY (`akses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `master_akses`:
--

--
-- Truncate table before insert `master_akses`
--

TRUNCATE TABLE `master_akses`;
--
-- Dumping data for table `master_akses`
--

INSERT DELAYED IGNORE INTO `master_akses` (`akses_id`, `nama`) VALUES
('bendahara', 'bendahara'),
('cashier', 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--
-- Creation: Apr 02, 2023 at 02:34 AM
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `produk`:
--

--
-- Truncate table before insert `produk`
--

TRUNCATE TABLE `produk`;
--
-- Dumping data for table `produk`
--

INSERT DELAYED IGNORE INTO `produk` (`id`, `produk`, `harga`) VALUES
(1, 'GANTUNGAN KUNCI ', '30000'),
(2, 'PAKAN IKAN OTOMATIS', '300000'),
(3, 'SABUN LAUNDRY', '25000'),
(14, 'POSTER ANIMASI', '35000'),
(15, 'VGA GTX 1050', '1500000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--
-- Creation: Apr 08, 2023 at 01:51 AM
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pembeli` varchar(200) NOT NULL,
  `tanggal` varchar(300) NOT NULL,
  `produk` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `total` varchar(200) NOT NULL,
  `hasil` varchar(200) NOT NULL,
  `bayar` varchar(200) NOT NULL,
  `payback` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `transaksi`:
--

--
-- Truncate table before insert `transaksi`
--

TRUNCATE TABLE `transaksi`;
--
-- Dumping data for table `transaksi`
--

INSERT DELAYED IGNORE INTO `transaksi` (`id`, `pembeli`, `tanggal`, `produk`, `harga`, `total`, `hasil`, `bayar`, `payback`) VALUES
(13, 'Abdul Aziz', 'Wednesday, 8-Apr-2023', 'GANTUNGAN KUNCI', '25000', '1', '25000', '25000', '0'),
(16, 'Syahla Nur Azizah', 'Thursday, 8-Apr-2023', 'SABUN LAUNDRY', '25000', '1', '25000', '50000', '-25000'),
(17, 'Erlang Andriyanputra', 'Thursday, 8-Apr-2023', 'VGA GTX 1050', '1500000', '1', '1500000', '1500000', '0'),
(18, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(19, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(20, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(21, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(22, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(23, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(24, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(25, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0'),
(26, 'testing', 'Friday, 8-Apr-2023', 'GANTUNGAN KUNCI ', '30000', '1', '30000', '30000', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD CONSTRAINT `admin_akses_ibfk_1` FOREIGN KEY (`akses_id`) REFERENCES `master_akses` (`akses_id`),
  ADD CONSTRAINT `admin_akses_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `admin` (`login_id`);


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table admin
--

--
-- Truncate table before insert `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Truncate table before insert `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Truncate table before insert `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata for table admin_akses
--

--
-- Truncate table before insert `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Truncate table before insert `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Truncate table before insert `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata for table master_akses
--

--
-- Truncate table before insert `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Truncate table before insert `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Truncate table before insert `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata for table produk
--

--
-- Truncate table before insert `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Truncate table before insert `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Truncate table before insert `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata for table transaksi
--

--
-- Truncate table before insert `pma__column_info`
--

TRUNCATE TABLE `pma__column_info`;
--
-- Truncate table before insert `pma__table_uiprefs`
--

TRUNCATE TABLE `pma__table_uiprefs`;
--
-- Truncate table before insert `pma__tracking`
--

TRUNCATE TABLE `pma__tracking`;
--
-- Metadata for database technoarea
--

--
-- Truncate table before insert `pma__bookmark`
--

TRUNCATE TABLE `pma__bookmark`;
--
-- Truncate table before insert `pma__relation`
--

TRUNCATE TABLE `pma__relation`;
--
-- Truncate table before insert `pma__savedsearches`
--

TRUNCATE TABLE `pma__savedsearches`;
--
-- Truncate table before insert `pma__central_columns`
--

TRUNCATE TABLE `pma__central_columns`;SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
