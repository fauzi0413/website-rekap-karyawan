-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2023 at 01:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekap_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `total_pengisian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id`, `username`, `nama_karyawan`, `nama_kendaraan`, `no_plat`, `total_pengisian`) VALUES
(4, 'nida', 'Nida Farnida', 'Avanza', 'B 1801 MAS', 150000),
(5, 'bayu', 'Ardian Bayu', 'Kijang', 'B 1977 FAU', 0),
(6, 'rifda', 'Rifda Nurhayati', 'Beat', 'B 8100 Q', 0),
(8, 'bagas', 'Bagas Dwi', 'Agya', 'B 7790 BN', 530000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekap_pengisian_bbm`
--

CREATE TABLE `tb_rekap_pengisian_bbm` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `kilometer` int(11) NOT NULL,
  `biaya_pengisian` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rekap_pengisian_bbm`
--

INSERT INTO `tb_rekap_pengisian_bbm` (`id`, `tanggal`, `username`, `kilometer`, `biaya_pengisian`, `keterangan`, `bukti_pembayaran`) VALUES
(2, '2023-03-14', 'bagas', 120, 100000, 'Isi BBM', 'PANITIA FINAL.png'),
(3, '2023-03-16', 'bagas', 200, 150000, 'Isi bensin', 'BG Zoom Fix.jpg'),
(4, '2023-03-16', 'nida', 100, 150000, 'Isi BBM', ''),
(5, '2023-03-17', 'bagas', 1000, 250000, 'BBM', '1564723913_PANITIA FINAL.png'),
(6, '2023-03-17', 'bagas', 1011, 20000, 'BBM', 'BG Zoom Fix.jpg'),
(7, '2023-03-18', 'bagas', 1020, 10000, 'BBM', 'background peserta webinar-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_profil` varchar(100) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama_user`, `jenis_kelamin`, `no_telpon`, `email`, `foto_profil`, `level`) VALUES
(1, 'admin', 'admin', 'Dea Anisa', 'P', '082112014647', 'dea123@gmail.com', '380812805_messages-2.jpg', 'Admin'),
(6, 'nida', 'nida', 'Nida Farnida', 'P', '089288779902', 'nidaa123@gmail.com', '', 'Karyawan'),
(7, 'bayu', 'bayu', 'Ardian Bayu', 'L', '081111114046', 'bayu123@gmail.com', '', 'Karyawan'),
(8, 'rifda', 'rifda', 'Rifda Nurhayati', 'P', '089288779901', 'rifda123@gmail.com', '', 'Karyawan'),
(10, 'bagas', 'bagas', 'Bagas Dwi', 'L', '081908279448', 'bagas123@gmail.com', '1872290940_hello world!.png', 'Karyawan'),
(11, 'riki', 'riki', 'Rizki Budi', 'L', '081908279448', 'riki123@gmail.com', '', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rekap_pengisian_bbm`
--
ALTER TABLE `tb_rekap_pengisian_bbm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_rekap_pengisian_bbm`
--
ALTER TABLE `tb_rekap_pengisian_bbm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
