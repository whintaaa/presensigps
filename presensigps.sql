-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 06:03 AM
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
-- Database: `presensigps`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_magang`
--

CREATE TABLE `data_magang` (
  `id_pkl` varchar(10) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nmr_induk` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_pl` int(11) NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `remember_token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_magang`
--

INSERT INTO `data_magang` (`id_pkl`, `nama_lengkap`, `nmr_induk`, `email`, `no_hp`, `password`, `id_divisi`, `id_pl`, `id_instansi`, `id_lokasi`, `remember_token`) VALUES
('1234', 'Whinta Virginia', '12452', 'whintavirginia@gmail.com', '082230968357', '$2y$12$Na2eUgkjzPYep5kGPRTLxuGfpLMySizw01LtY3Gvk/aW1zxypq7JG', 2, 1, 1, 1, NULL),
('24017', 'lala', '210999', 'lalalalallalallalalallalallalalla@gmail.com', '0109201930', '$2y$12$yqifnBuHzGO4rHR1S6Z0R.2dhgi6iHC6pKl7UINF/x.orgiEDeZ4G', 1, 1, 1, 2, NULL),
('24018', 'Whinta Virginia Putri', '210411100047', 'whintavirginia@gmail.com', '082230968314', '$2y$12$NCpiY9dqK0dBRS3kf.ILM.tQw/rngo.87QztvnPRt.BFEI2Vvt/TK', 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Corporate Support'),
(2, 'Supply Chain Management'),
(5, 'Product');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id_instansi` int(11) NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `alamat_instansi` varchar(100) NOT NULL DEFAULT ' ',
  `contact_instansi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instansi`, `nama_instansi`, `alamat_instansi`, `contact_instansi`) VALUES
(1, 'Universitas Trunojoyo Madura', 'Jl. Raya Telang, Telang Kec. Kamal\r\nKabupaten Bangkalan Jawa Timur', ' '),
(3, 'Politeknik Manufaktur Bandung (POLMAN Bandung)', 'Jl. Kanayakan No.21 Kec. Coblong Kota Bandung', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_pkl`
--

CREATE TABLE `lokasi_pkl` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(25) NOT NULL,
  `alamat_lokasi` varchar(100) NOT NULL,
  `lat_long` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_pkl`
--

INSERT INTO `lokasi_pkl` (`id_lokasi`, `nama_lokasi`, `alamat_lokasi`, `lat_long`) VALUES
(1, 'CIKUPA', 'Millennium Industrial Estate,  Jl. Millennium Raya Blok F1 (Tigaraksa)  Tangerang-Banten 15720', '-6.251331995631018, 106.49895703598136'),
(2, 'JAKARTA', 'Gedung TMT I, 5th Floor, Suite 501 Jl. Cilandak KKO No. 1 Jakarta 12560', '-6.292996845070444, 106.8152155011684');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id_pl` int(11) NOT NULL,
  `nama_pl` varchar(100) NOT NULL,
  `email_pl` varchar(25) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id_pl`, `nama_pl`, `email_pl`, `id_divisi`) VALUES
(1, 'Cucu Juanda', 'whintavirginia@gmail.com', 1),
(2, 'Ahmad Mazza', 'Mazza123@ptssb.co.id', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_izin`
--

CREATE TABLE `pengajuan_izin` (
  `id_izin` int(11) NOT NULL,
  `id_pkl` varchar(10) NOT NULL,
  `tgl_izin` date NOT NULL,
  `status` char(1) NOT NULL COMMENT 'i: izin ; s: sakit',
  `ket_izin` varchar(100) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status_approved` char(1) NOT NULL DEFAULT '0' COMMENT '0: pending;1:disetujui;2:ditolak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_izin`
--

INSERT INTO `pengajuan_izin` (`id_izin`, `id_pkl`, `tgl_izin`, `status`, `ket_izin`, `file`, `status_approved`) VALUES
(1, '24018', '2024-04-04', 's', 'sakit demam', NULL, '1'),
(2, '24018', '2024-04-05', 'i', 'Konsultasi ke dosen pembimbing', NULL, '1'),
(3, '24018', '2024-04-06', 's', 'Sakit flu', NULL, '0'),
(4, '24017', '2024-04-29', 'i', 'bimbingan', NULL, '1'),
(13, '24018', '2024-05-03', 's', 'mmmmm', '24018-2024-05-03-1714460602.jpg', '1'),
(14, '24018', '2024-05-04', 'i', 'pergi', NULL, '0'),
(16, '24018', '2024-05-06', 'i', 'bimbingan', NULL, '1'),
(17, '24018', '2024-05-05', 'i', 'pergi', NULL, '0'),
(18, '24018', '2024-05-20', 'i', 'bimbingan bimbingan laporan akhir', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `id_pkl` varchar(10) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_in` time NOT NULL,
  `jam_out` time DEFAULT NULL,
  `lokasi_in` text NOT NULL,
  `lokasi_out` text DEFAULT NULL,
  `aktivitas` text NOT NULL,
  `alasan_terlambat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `id_pkl`, `tgl_presensi`, `jam_in`, `jam_out`, `lokasi_in`, `lokasi_out`, `aktivitas`, `alasan_terlambat`) VALUES
(13, '24018', '2024-03-18', '14:10:57', '14:13:44', '-6.251124,106.4983154', '-6.2511268,106.4983074', 'kkkkkkk', NULL),
(15, '24018', '2024-03-19', '07:08:57', NULL, '-6.2511191,106.4983132', NULL, 'mengerjakan project lanjut', NULL),
(16, '24018', '2024-03-20', '15:28:38', NULL, '-6.2929623,106.8151732', NULL, 'aktivitas', NULL),
(17, '24018', '2024-03-22', '13:20:28', NULL, '-6.2511381,106.4983286', NULL, 'membuat profil fitur', NULL),
(18, '24018', '2024-03-25', '14:56:01', '14:56:30', '-6.2511231,106.4983022', '-6.251115,106.4983176', 'yyyy', NULL),
(19, '24018', '2024-03-27', '13:33:00', '13:33:20', '-6.2511227,106.4983016', '-6.2511153,106.498309', 'yayayaya', NULL),
(20, '24018', '2024-04-05', '07:49:14', NULL, '-6.2930229,106.8152612', NULL, 'nnnn', NULL),
(21, '24018', '2024-04-25', '15:34:41', '15:37:06', '-6.292978,106.8151727', '-6.2929735,106.8151607', 'perbaiki', 'lupaa'),
(22, '24018', '2024-04-30', '10:12:51', NULL, '-6.251636499996289,106.49802969133945', NULL, 'mencoba', 'lupa'),
(23, '24018', '2024-05-02', '10:35:18', NULL, '-6.293256333320924,106.81540238880356', NULL, 'mencoba', 'lupa'),
(24, '24018', '2024-05-08', '07:54:32', NULL, '-6.251138,106.498302', NULL, 'merapikan list role', NULL),
(25, '24018', '2024-05-14', '08:57:26', '08:57:30', '-6.2511264,106.4983043', '-6.2511264,106.4983043', 'melakukan input list role ke sap', 'lupa melakukan absensi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email_admin`, `departement`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Putri', 'putri13@ptssb.co.id', 'Learning & Academy', NULL, '$2y$12$NCpiY9dqK0dBRS3kf.ILM.tQw/rngo.87QztvnPRt.BFEI2Vvt/TK', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_magang`
--
ALTER TABLE `data_magang`
  ADD PRIMARY KEY (`id_pkl`),
  ADD KEY `id_divisi` (`id_divisi`),
  ADD KEY `id_instansi` (`id_instansi`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_pl` (`id_pl`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indexes for table `lokasi_pkl`
--
ALTER TABLE `lokasi_pkl`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id_pl`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pkl` (`id_pkl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokasi_pkl`
--
ALTER TABLE `lokasi_pkl`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id_pl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_magang`
--
ALTER TABLE `data_magang`
  ADD CONSTRAINT `data_magang_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`),
  ADD CONSTRAINT `data_magang_ibfk_2` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`),
  ADD CONSTRAINT `data_magang_ibfk_3` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_pkl` (`id_lokasi`),
  ADD CONSTRAINT `data_magang_ibfk_4` FOREIGN KEY (`id_pl`) REFERENCES `pembimbing` (`id_pl`);

--
-- Constraints for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD CONSTRAINT `pembimbing_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`);

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`id_pkl`) REFERENCES `data_magang` (`id_pkl`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
