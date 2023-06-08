-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 01:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: May 19, 2023 at 11:30 AM
-- Last update: Jun 08, 2023 at 10:48 AM
--

CREATE TABLE `admin` (
  `login_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'Bendahara', '62f7dec74b78ba0398e6a9f317f55126'),
(4, 'Manager', '0795151defba7a4b5dfa89170de46277');

-- --------------------------------------------------------

--
-- Table structure for table `admin_akses`
--
-- Creation: May 19, 2023 at 11:30 AM
-- Last update: Jun 08, 2023 at 11:32 AM
--

CREATE TABLE `admin_akses` (
  `login_id` int(11) NOT NULL,
  `akses_id` varchar(70) NOT NULL
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
(1, 'bendahara'),
(1, 'cashier'),
(3, 'bendahara'),
(2, 'cashier'),
(3, 'manager'),
(2, 'manager'),
(4, 'cashier'),
(4, 'bendahara'),
(4, 'cashier'),
(4, 'bendahara'),
(4, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `master_akses`
--
-- Creation: May 19, 2023 at 11:30 AM
-- Last update: Jun 08, 2023 at 10:46 AM
--

CREATE TABLE `master_akses` (
  `akses_id` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL
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
('admin', 'Admin'),
('bendahara', 'Bendahara'),
('cashier', 'Cashier'),
('manager', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--
-- Creation: May 19, 2023 at 11:37 AM
-- Last update: Jun 08, 2023 at 11:39 AM
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode` varchar(70) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `gambar` text NOT NULL,
  `produk` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

INSERT DELAYED IGNORE INTO `produk` (`id`, `kode`, `tanggal_masuk`, `gambar`, `produk`, `harga`) VALUES
(6, 'asd', '2023-06-08', '6481b903f11f1.png', 'barang_testing', '30000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--
-- Creation: May 19, 2023 at 11:30 AM
-- Last update: Jun 08, 2023 at 11:42 AM
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `pembeli` varchar(200) NOT NULL,
  `tanggal` varchar(300) NOT NULL,
  `produk` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL,
  `total` varchar(200) NOT NULL,
  `hasil` varchar(200) NOT NULL,
  `bayar` varchar(200) NOT NULL,
  `payback` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'tes', '2023-06-08', 'barang_testing', '30000', '1', '30000', '30000', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD KEY `akses_id` (`akses_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `master_akses`
--
ALTER TABLE `master_akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_akses`
--
ALTER TABLE `admin_akses`
  ADD CONSTRAINT `admin_akses_ibfk_1` FOREIGN KEY (`akses_id`) REFERENCES `master_akses` (`akses_id`),
  ADD CONSTRAINT `admin_akses_ibfk_2` FOREIGN KEY (`login_id`) REFERENCES `admin` (`login_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
