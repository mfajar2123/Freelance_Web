-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 11:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freelance_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id_order` int(11) NOT NULL,
  `klien_id` int(11) NOT NULL,
  `id_pekerjaan` int(11) DEFAULT NULL,
  `deskripsi_order` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `status` enum('Menunggu Pembayaran','Dalam Pengerjaan','Selesai','Gagal') NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id_order`, `klien_id`, `id_pekerjaan`, `deskripsi_order`, `file`, `status`, `created_at`) VALUES
(2, 1, 1, 'kjdksajkdadas', 'code.png', 'Menunggu Pembayaran', '2023-12-02'),
(3, 1, 1, 'dsadadadsa', 'hands on 3.png', 'Dalam Pengerjaan', '2023-12-02'),
(5, 2, 2, 'sa', 'mtcna.png', 'Menunggu Pembayaran', '2023-12-02'),
(6, 2, 1, '22', 'Screenshot 2023-11-28 163716.png', 'Menunggu Pembayaran', '2023-12-02'),
(7, 2, 3, 'cek kandungan saya dong', 'sssssss.png', 'Dalam Pengerjaan', '2023-12-02'),
(8, 2, 4, 'kocak kocak', 'Screenshot (100).png', 'Dalam Pengerjaan', '2023-12-02'),
(9, 2, 1, 'vvvv', 'Screenshot 2023-10-03 150131.png', 'Dalam Pengerjaan', '2023-12-02'),
(10, 1, 5, 'saya ingin bermain game pubg dan digendong ke rank ace', 'Screenshot (96).png', 'Dalam Pengerjaan', '2023-12-02'),
(11, 1, 1, 'dsadsadsa', 'Screenshot (124).png', 'Dalam Pengerjaan', '2023-12-02'),
(12, 2, 1, 'fsafafafa', 'Screenshot (126).png', 'Dalam Pengerjaan', '2023-12-04'),
(13, 2, 1, 'sdadas', 'qwe.png', 'Menunggu Pembayaran', '2023-12-04'),
(14, 2, 4, 'sdada', 'Screenshot 2023-11-07 190100.png', 'Menunggu Pembayaran', '2023-12-04'),
(15, 2, 2, 'sss', 'Screenshot (122).png', 'Menunggu Pembayaran', '2023-12-04'),
(16, 1, 1, 'das', 'Screenshot 2023-11-05 162919.png', 'Dalam Pengerjaan', '2023-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `jenis_pekerjaan` varchar(255) NOT NULL,
  `deskripsi_order` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `freelancer_id`, `jenis_pekerjaan`, `deskripsi_order`, `foto`, `skills`, `harga`) VALUES
(1, 7, 'gamr', 'dsaasd', 'logoo.png', 'sda', '232'),
(2, 5, 'sdads', 'sdadsa', 'logoo.png', 'dsadsa', '2321'),
(3, 7, 'Dokter Kandungan', 'Saya Bisa cek kandungan', 'logoo.png', 'cek kandungan', 'gratis'),
(4, 7, 'kang service', 'gasgas', 'kocak.png', 'sdadsa12414', '124141'),
(5, 8, 'Gamers', 'Jasa gendong bermain game', 'kocak.png', 'turu', '50.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_order`, `metode_pembayaran`, `bukti_pembayaran`) VALUES
(1, 2, '', 'menu.png'),
(2, 2, '', 'Screenshot 2023-11-27 205006.png'),
(3, 6, '', 'mtcna.png'),
(4, 7, '', 'qwe.png'),
(5, 7, '', 'Screenshot (132).png'),
(6, 7, '', 'Screenshot (122).png'),
(7, 8, '', 'Screenshot (129).png'),
(8, 9, '', 'Screenshot (108).png'),
(9, 10, '', 'Screenshot (95).png'),
(10, 11, '', 'Screenshot (97).png'),
(11, 12, '', 'Screenshot (119).png'),
(12, 3, '', 'Screenshot (115).png'),
(13, 16, '', 'Screenshot (113).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_profil` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `role` enum('klien','freelancer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `foto_profil`, `no_hp`, `role`) VALUES
(1, 'jawir sunda', 'jawir', 'jawir', 'jawir@gmail.com', 'logoo.png', '124153345', 'klien'),
(2, 'aceng', 'aceng', 'aceng', 'aceng', 'kocak.png', '53252352', 'klien'),
(3, 'aa', 'aa', 'aa', 'aa', 'kocak.png', '41432', 'freelancer'),
(4, 'bbb', 'bbb', 'bbb', 'bbb@gmail.com', 'kocak.png', '414141231', 'klien'),
(5, 'qq', 'qq', 'qq', 'qq@gmail.com', 'kocak.png', '21311414', 'freelancer'),
(7, 'abdi', 'abdi', 'abdi', 'abdi@gmail.com', 'kocak.png', '414214141', 'freelancer'),
(8, 'dimas', 'dimas', 'dimas', 'dimas@gmail.com', 'logoo.png', '412414', 'freelancer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `klien_id` (`klien_id`),
  ADD KEY `id_pekerjaan` (`id_pekerjaan`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`),
  ADD KEY `freelancer_id` (`freelancer_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_3` FOREIGN KEY (`klien_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `order_table_ibfk_4` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`);

--
-- Constraints for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order_table` (`id_order`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
