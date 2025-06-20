-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 08:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `batik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_a` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_a`, `username`, `password`, `nama`, `alamat`, `no_hp`, `role`) VALUES
(7, 'admin', '$2y$10$L4Hz3dGdbyNhJXSe4lXd1ujqzNgvEnRrqolAQaVQXPc3VlJYJsIc2', 'min', 'min', '098', 'admin'),
(8, 'tes', '$2y$10$C8cbdaeHXF5UnO8PN9AK5OOv5cN4KoQyX0bJSDiGe5pYFDLIlx2qK', 'tesss', 'tes', '0987', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_ktg` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_ktg`, `kategori`) VALUES
(2, 'Batik Tulis'),
(3, 'Batik Cap'),
(4, 'Request');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_k` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `ukuran` varchar(100) NOT NULL,
  `lengan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_k`, `id_u`, `jenis`, `model`, `ukuran`, `lengan`, `harga`) VALUES
(112, 12, 'Batik 1', 'Model 1', 'S', 'Lengan Panjang', 100000),
(114, 31, 'Batik 4', 'Model 3', 'L', 'Lengan Panjang', 115000),
(115, 25, 'Batik 3', 'Model 1', 'L', 'Lengan Panjang', 110000);

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `last_activity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id`, `ip_address`, `user_agent`, `last_activity`) VALUES
(114, '192.168.10.192', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 1750400645);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_p` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal_pemesanan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_p`, `id_u`, `nama`, `alamat`, `no_hp`, `total`, `tanggal_pemesanan`) VALUES
(35, 23, 'abdul', 'pemalang', '094934738', 110000, '2025-05-09'),
(43, 12, 'Fina', 'Landungsari', '0849384938', 100000, '2025-05-26'),
(44, 24, 'Pratama', 'Yosorejo', '0893489384344', 110000, '2025-05-30'),
(45, 25, 'dhio', 'Yosorejo', '084938943843', 100000, '2025-05-30'),
(46, 12, 'Fina', 'Landungsari', '0849384938', 100000, '2025-06-10'),
(47, 12, 'Fina', 'Landungsari', '0849384938', 115000, '2025-06-10'),
(48, 29, 'Meli', 'Landungsari', '085720174322', 230000, '2025-06-12'),
(49, 30, 'asd', 'asd', '6287387238', 100000, '2025-06-13'),
(50, 25, 'dhio', 'Yosorejo', '084938943843', 100000, '2025-06-13'),
(51, 25, 'dhio', 'Yosorejo', '084938943843', 110000, '2025-06-13'),
(59, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 130000, '2025-06-19'),
(82, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 110000, '2025-06-20'),
(83, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 110000, '2025-06-20'),
(84, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 110000, '2025-06-20'),
(85, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 110000, '2025-06-20'),
(86, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 110000, '2025-06-20'),
(87, 25, 'dhiooo', 'Yosorejoo', '6289537911962', 110000, '2025-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_detail`
--

CREATE TABLE `pemesanan_detail` (
  `id_detail` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `id_ktg` int(11) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `lengan` varchar(50) DEFAULT NULL,
  `harga` int(20) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`id_detail`, `id_p`, `id_ktg`, `jenis`, `model`, `ukuran`, `lengan`, `harga`, `status`) VALUES
(43, 35, 2, 'Batik 1', 'Model 1', 'XL', 'Lengan Panjang', 110000, 'Dibatalkan'),
(52, 43, 2, 'Batik 1', 'Model 1', 'L', 'Lengan Panjang', 100000, 'Menunggu'),
(53, 44, 3, 'Batik 4', 'Model 1', 'L', 'Lengan Panjang', 110000, 'Selesai'),
(54, 45, 2, 'Batik 1', 'Model 1', 'L', 'Lengan Panjang', 100000, 'Dibatalkan'),
(55, 46, 2, 'Batik 2', 'Model 1', 'L', 'Lengan Panjang', 100000, 'Selesai'),
(56, 47, 2, 'Batik 1', 'Model 1', '5XL', 'Lengan Panjang', 115000, 'Selesai'),
(57, 48, 2, 'Batik 2', 'Model 3', 'L', 'Lengan Panjang', 105000, 'Selesai'),
(58, 48, 3, 'Batik 4', 'Model 4', 'XL', 'Lengan Panjang', 125000, 'Selesai'),
(59, 49, 2, 'Batik 1', 'Model 1', 'L', 'Lengan Panjang', 100000, 'Selesai'),
(60, 50, 2, 'Batik 2', 'Model 1', 'L', 'Lengan Panjang', 100000, 'Menunggu'),
(61, 51, 2, 'Batik 1', 'Model 1', 'XL', 'Lengan Panjang', 110000, 'Selesai'),
(68, 59, 3, 'Batik 3', 'Model 3', '3XL', 'Lengan Panjang', 130000, 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `id_ktg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id`, `jenis`, `gambar`, `stok`, `id_ktg`) VALUES
(1, 'Batik 1', 'jenis1.jpg', 5, 2),
(2, 'Batik 2', 'jenis2.jpg', 10, 2),
(3, 'Batik 3', 'jenis3.jpg', 5, 3),
(4, 'Batik 4', 'jenis4.jpg', 2, 3),
(5, 'Request Batik', '1750148758_e8b010a9d541f2974555.png', 98, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_u` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `status` enum('Aktif','Nonaktif') DEFAULT 'Nonaktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_u`, `username`, `password`, `nama`, `alamat`, `no_hp`, `role`, `status`) VALUES
(12, 'fina', '$2y$10$FR9s.PYzefqE0OqCppfOmupXesWPh4tde.vjoQYK4dhrARTDqj3iO', 'Fina', 'Landungsari', '0849384938', 'user', 'Aktif'),
(18, 'linoval', '$2y$10$g5p2JPXppTynyJvaN6RLFemgRZYX2TlBGP3l8ZSjVvMlbR8VGraqi', 'linoval', 'linoval', '0978934738', 'user', 'Aktif'),
(22, 'tes', '$2y$10$Na89hGngEqEc.LXlRdGBX.8FdiTSW3OBCLVSQQovVkCZATgbs2fOO', 'tes', 'tes', '0984938948', 'user', 'Nonaktif'),
(23, 'abdul', '$2y$10$EaSYSbdEeVkUJ/F12..GnOr9QKR.p0Xp4iP0PFVVxaN.3d0bTqw66', 'abdul', 'pemalang', '094934738', 'user', 'Aktif'),
(24, 'pratama', '$2y$10$eYj1WgoPL3fq0IsEqx/VbOnXkz9sV2bX9VoVTV0Pm7UvvDbpLuwZK', 'Pratama', 'Yosorejo', '0893489384344', 'user', 'Aktif'),
(25, 'dhio', '$2y$10$PDFOKt8JhEFeRWgAWQ1v3.n.mI6mrFz8kdqCMe48y9tqnKlDgmX3W', 'dhiooo', 'Yosorejoo', '6289537911962', 'user', 'Aktif'),
(29, 'meli', '$2y$10$iqc.N5vmpSHcYQ6evTr6jeXo2PACkvkXkxz09jsk6F2VqJqAQV2IC', 'Meli', 'Landungsari', '6285720174322', 'user', 'Aktif'),
(30, 'asd', '$2y$10$vXoteuK1XUkr7cJ2rONkSeEQn41HZgFvoK5OZA2HgAk.D9pfIifYa', 'asd', 'asd', '6287387238', 'user', 'Aktif'),
(31, 'al', '$2y$10$W7Ihttq2fd8JW0u3V.S9quRa2jBHu0U5rfTiq6OCZglLihr0HtmWi', 'al', 'pekalongan', '62893893483', 'user', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_a`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_ktg`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_k`),
  ADD KEY `id_u` (`id_u`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_u` (`id_u`);

--
-- Indexes for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_p` (`id_p`),
  ADD KEY `id_ktg` (`id_ktg`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_ibfk_1` (`id_ktg`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_u`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_ktg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_k` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `users` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `users` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_detail`
--
ALTER TABLE `pemesanan_detail`
  ADD CONSTRAINT `pemesanan_detail_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `pemesanan` (`id_p`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_detail_ibfk_2` FOREIGN KEY (`id_ktg`) REFERENCES `kategori` (`id_ktg`) ON DELETE CASCADE;

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_ktg`) REFERENCES `kategori` (`id_ktg`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
