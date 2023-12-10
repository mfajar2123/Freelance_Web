-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 05:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `file_finish` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id_order`, `klien_id`, `id_pekerjaan`, `deskripsi_order`, `file`, `status`, `created_at`, `file_finish`) VALUES
(2, 1, 1, 'kjdksajkdadas', 'code.png', 'Menunggu Pembayaran', '2023-12-02', ''),
(3, 1, 1, 'dsadadadsa', 'hands on 3.png', 'Selesai', '2023-12-02', 'Tugas Praktisi P14_Abdi Surya Perdana.pdf'),
(6, 2, 1, 'asok', 'Screenshot 2023-11-28 163716.png', 'Dalam Pengerjaan', '2023-12-02', ''),
(7, 2, 3, 'cek kandungan saya dong', 'sssssss.png', 'Dalam Pengerjaan', '2023-12-02', ''),
(8, 2, 4, 'kocak kocak', 'Screenshot (100).png', 'Selesai', '2023-12-02', 'WhatsApp Image 2023-11-29 at 22.18.32_4224c21b.jpg'),
(9, 2, 1, 'vvvv', 'Screenshot 2023-10-03 150131.png', 'Dalam Pengerjaan', '2023-12-02', ''),
(10, 1, 5, 'saya ingin bermain game pubg dan digendong ke rank ace', 'Screenshot (96).png', 'Dalam Pengerjaan', '2023-12-02', ''),
(11, 1, 1, 'dsadsadsa', 'Screenshot (124).png', 'Dalam Pengerjaan', '2023-12-02', ''),
(12, 2, 1, 'fsafafafa', 'Screenshot (126).png', 'Selesai', '2023-12-04', 'Kelompok 4_Tugas Turunan Parsial 2 Peubah.pdf'),
(13, 2, 1, 'sdadas', 'qwe.png', 'Dalam Pengerjaan', '2023-12-04', ''),
(16, 1, 1, 'das', 'Screenshot 2023-11-05 162919.png', 'Dalam Pengerjaan', '2023-12-04', ''),
(17, 9, 3, 'saya hamil', 'rtos_code.png', 'Dalam Pengerjaan', '2023-12-07', ''),
(19, 9, 5, 'desssss', 'http-client_code.png', 'Menunggu Pembayaran', '2023-12-07', ''),
(20, 9, 2, 'kocak kocak', 'json.png', 'Dalam Pengerjaan', '2023-12-08', ''),
(21, 9, 5, 'dsadasdasdasd', 'wifi.png', 'Menunggu Pembayaran', '2023-12-08', ''),
(26, 9, 3, 'fdsfdsfs', 'profillink.jpg', 'Dalam Pengerjaan', '2023-12-08', '');

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
  `harga` varchar(255) NOT NULL,
  `status_pekerjaan` varchar(50) DEFAULT 'belum dipesan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `freelancer_id`, `jenis_pekerjaan`, `deskripsi_order`, `foto`, `skills`, `harga`, `status_pekerjaan`) VALUES
(1, 7, 'gamr', 'dsaasd', 'logoo.png', 'sda', '232', 'belum dipesan'),
(2, 5, 'sdads', 'sdadsa', 'logoo.png', 'dsadsa', '2321', 'belum dipesan'),
(3, 7, 'Dokter Kandungan', 'Saya Bisa cek kandungan', 'logoo.png', 'cek kandungan', 'gratis', 'sudah dipesan'),
(4, 7, 'kang service', 'gasgas', 'kocak.png', 'sdadsa12414', '124141', 'belum dipesan'),
(5, 8, 'Gamers', 'Jasa gendong bermain game', 'kocak.png', 'turu', '50.000.000', 'belum dipesan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(13, 16, '', 'Screenshot (113).png'),
(14, 17, '', 'wifi.png'),
(15, 20, '', 'mqtt_client.jpeg'),
(16, 26, '', 'Screenshot 2023-12-07 191758.png'),
(17, 13, '', 'WhatsApp Image 2023-11-18 at 21.14.43_56723945.jpg'),
(18, 6, '', 'WhatsApp Image 2023-11-29 at 22.18.32_4224c21b.jpg');

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
  `education` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city_address` varchar(255) NOT NULL,
  `role` enum('klien','freelancer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `foto_profil`, `no_hp`, `education`, `country`, `city_address`, `role`) VALUES
(1, 'jawir sunda', 'jawir', 'jawir', 'jawir@gmail.com', 'logoo.png', '124153345', '', '', '', 'klien'),
(2, 'aceng', 'aceng', 'aceng', 'aceng', 'kocak.png', '53252352', '', '', '', 'klien'),
(3, 'aa', 'aa', 'aa', 'aa', 'kocak.png', '41432', '', '', '', 'freelancer'),
(4, 'bbb', 'bbb', 'bbb', 'bbb@gmail.com', 'kocak.png', '414141231', '', '', '', 'klien'),
(5, 'qq', 'qq', 'qq', 'qq@gmail.com', 'kocak.png', '21311414', '', '', '', 'freelancer'),
(7, 'abdi', 'abdi', 'abdi', 'abdi@gmail.com', 'kocak.png', '414214141', '', '', '', 'freelancer'),
(8, 'dimas', 'dimas', 'dimas', 'dimas@gmail.com', 'logoo.png', '412414', '', '', '', 'freelancer'),
(9, 'Muhamad Fajar', 'klien', 'klien', 'mfajar22222222@gmail.com', 'download.jpg', '082143651192', 'UPI', 'Indonesia', 'Bandung', 'klien'),
(10, 'Wira nagara selatan', 'wira', 'wira', 'wira@yahoo.com', 'download.jpg', '09090209', '', '', '', 'klien');

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
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
