-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 08:16 AM
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
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification_type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `notification_type`, `message`, `created_at`, `is_read`) VALUES
(1, 1, 'Pembayaran Belum Dilakukan', 'Silakan selesaikan pembayaran untuk pesanan XYZ', '2023-12-22 12:26:13', 0),
(2, 1, 'Perubahan Status', 'dsadsa sdada asdasda', '2023-12-22 15:25:46', 1),
(3, 1, 'tes notif', 'tes notif', '2023-12-22 15:51:34', 1),
(4, 1, 'tes notiftes notiftes notif', 'tes notiftes notif', '2023-12-22 15:51:44', 1),
(5, 2, 'cxcx', 'cxcxcx', '2023-12-22 16:09:46', 1),
(6, 1, 'Order Berhasil', 'Pesanan Anda berhasil dipesan, silahkan lakukan pembayaran!', '2023-12-24 17:14:40', 0),
(7, 1, 'Order Selesai', 'Pesanan Anda telah selesai, terima kasih telah melakukan pembayaran.', '2023-12-24 17:20:15', 0),
(9, 1, 'p', 'p', '2023-12-24 17:43:50', 0),
(10, 1, 'ppp', 'pp', '2023-12-24 17:43:57', 0),
(11, 1, 'zaza', 'zaza', '2023-12-24 17:57:37', 0),
(12, 9, 'Order Berhasil', 'Pesanan Anda berhasil dipesan, silahkan lakukan pembayaran!', '2023-12-24 18:20:37', 1),
(13, 9, 'Order Selesai', 'Terima kasih sudah melakukan pembayaran.', '2023-12-24 18:20:44', 1),
(14, 9, 'Order Berhasil', 'Pesanan Anda berhasil dipesan, silahkan lakukan pembayaran!', '2023-12-24 18:22:18', 1),
(15, 9, 'Order Berhasil', 'Pesanan Anda berhasil dipesan, silahkan lakukan pembayaran!', '2023-12-24 18:26:58', 1),
(16, 9, 'Order Selesai', 'Terima kasih sudah melakukan pembayaran.', '2023-12-24 18:27:02', 1),
(17, 9, 'Selesai', 'Pesanan Anda telah selesai kocak.', '2023-12-24 18:27:24', 1),
(18, 9, 'Order Berhasil', 'Pesanan Anda berhasil dipesan, silahkan lakukan pembayaran!', '2023-12-24 18:30:16', 1),
(19, 9, 'Order Selesai', 'Terima kasih sudah melakukan pembayaran.', '2023-12-24 18:31:20', 1),
(20, 9, 'Pesanan Selesai', 'Selamat!! pesanan anda sudah dikerjakan, silahkan cek :)', '2023-12-24 18:34:12', 1),
(21, 9, 'Order Berhasil', 'Pesanan Anda berhasil dipesan, silahkan lakukan pembayaran!', '2023-12-25 07:10:43', 1),
(22, 9, 'Order Selesai', 'Terima kasih sudah melakukan pembayaran.', '2023-12-25 07:12:22', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id_order`, `klien_id`, `id_pekerjaan`, `deskripsi_order`, `file`, `status`, `created_at`, `file_finish`) VALUES
(3, 1, 1, 'dsadadadsa', 'hands on 3.png', 'Selesai', '2023-12-02', '2858-7050-1-PB.pdf'),
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
(20, 9, 2, 'kocak kocak', 'json.png', 'Dalam Pengerjaan', '2023-12-08', ''),
(26, 9, 3, 'fdsfdsfs', 'profillink.jpg', 'Dalam Pengerjaan', '2023-12-08', ''),
(27, 2, 2, 'coba ajah nich', '', 'Menunggu Pembayaran', '2023-12-18', ''),
(28, 1, 1, 'dsadadadsa', 'bisi.png', 'Dalam Pengerjaan', '2023-12-25', ''),
(29, 9, 5, 'dsa', 'Screenshot (137).png', 'Selesai', '2023-12-25', '373-Article Text-729-1-10-20201020.pdf'),
(31, 9, 5, 'woi', 'Screenshot (138).png', 'Selesai', '2023-12-25', 'arduino-turbidity-sensor-connection-768x388_EY6UVfR5nw.png'),
(32, 9, 4, 'tolong service hp dan pc sayayy', '', 'Selesai', '2023-12-25', 'Screenshot 2023-12-08 024024.png'),
(33, 9, 6, 'dsadada', '888.png', 'Dalam Pengerjaan', '2023-12-25', '');

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
  `status_pekerjaan` varchar(50) DEFAULT 'belum dipesan',
  `nohp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `freelancer_id`, `jenis_pekerjaan`, `deskripsi_order`, `foto`, `skills`, `harga`, `status_pekerjaan`, `nohp`) VALUES
(1, 7, 'gamr', 'dsaasd', 'logoo.png', 'sda', '2325', 'sudah dipesan', '0'),
(2, 5, 'sdads', 'sdadsa', 'logoo.png', 'dsadsa', '2321', 'sudah dipesan', '0'),
(3, 7, 'Doker Mesin', 'Saya Bisa cek permasalahan mesin', 'Museum_Negeri_Sumatera_Utara_Medan.jpg', 'menyehatkan mesin yang sakit', '25252525', 'sudah dipesan', '82285413093'),
(4, 7, 'kang service', 'gasgas', 'kocak.png', 'sdadsa12414', '124141', 'sudah dipesan', '0'),
(5, 8, 'Gamers', 'Jasa gendong bermain game', 'kocak.png', 'turu', '50.000.000', 'sudah dipesan', '0'),
(6, 7, 'web development asik', 'asik asik aja ya ges ya', 'WhatsApp Image 2023-11-18 at 21.14.43_86941312.jpg', 'ya master pis lah', '222222222', 'sudah dipesan', '082285413093'),
(7, 7, 'Full Stack Developer', 'Bikinin Website Kamu', 'esp32-devkitC-v4-pinout 38 Pin.png', 'Frontend,Backend, UI/UX Design', '5000000', 'belum dipesan', '2014961961');

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
(18, 6, '', 'WhatsApp Image 2023-11-29 at 22.18.32_4224c21b.jpg'),
(19, 28, '', 'no1.png'),
(20, 28, '', 'hands on 4.png'),
(21, 29, '', 'Screenshot (138).png'),
(22, 31, '', 'Screenshot 2023-12-07 183335.png'),
(23, 32, '', 'Screenshot 2023-12-07 184912.png'),
(24, 33, '', 'code.png');

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
  `role` enum('klien','freelancer','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `foto_profil`, `no_hp`, `education`, `country`, `city_address`, `role`) VALUES
(1, 'jawir sunda supan santun', 'jawir', 'jawir', 'jawir@gmail.com', 'arduino-turbidity-sensor-connection-768x388_EY6UVfR5nw.png', '124153345', 'Universitas Pendidikan Indonesia', 'jawa tenggara', '', 'klien'),
(2, 'aceng ganteng', 'aceng', 'aceng', 'aceng@gmail.com', 'WhatsApp Image 2023-11-29 at 22.18.32_4224c21b.jpg', '53252352', 'Universitas Pendidikan Indonesia', 'pangandaran', 'aw', 'klien'),
(3, 'aa', 'aa', 'aa', 'aa', 'kocak.png', '41432', '', '', '', 'freelancer'),
(5, 'qq', 'qq', 'qq', 'qq@gmail.com', 'kocak.png', '21311414', '', '', '', 'freelancer'),
(7, 'Abdi Surya Perdana', 'abdi', 'abdi', 'abdisury4@gmail.com', 'WhatsApp Image 2023-11-15 at 10.19.26.jpeg', '082285413093', 'Universitas Pendidikan Indonesia', 'Indonesia', 'Nagari Lubuk Jantan', 'freelancer'),
(8, 'dimas', 'dimas', 'dimas', 'dimas@gmail.com', 'WhatsApp Image 2023-10-21 at 3.46.15 PM (1).jpeg', '412414', '', '', '', 'freelancer'),
(9, 'Muhamad Fajar', 'klien', 'klien', 'mfajar22222222@gmail.com', 'download.jpg', '082143651192', 'UPI', 'Indonesia', 'Bandung', 'klien'),
(10, 'Wira nagara selatan', 'wira', 'wira', 'wira@yahoo.com', 'download.jpg', '09090209', 'Universitas Pendidikan Indonesia', 'Bogor', '', 'klien'),
(11, 'admin', 'admin', 'admin', '', '', '', '', '', '', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
