-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 04:55 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `kd_pegawai` char(6) NOT NULL,
  `nik_pegawai` bigint(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` char(15) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `kd_pegawai`, `nik_pegawai`, `nama`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_hp`, `gambar`, `username`, `password`) VALUES
(1, '200101', 3206511010980001, 'Taopiq Hidayat', 'Laki - Laki', 'Islam', 'Tasikmalaya', '1998-10-10', 'Kp. Mekarbakti 005/001 Ds. Kutawaringin', 'taopiqhidayat98@gmail.com', '085353313598', 'default.jpg', 'opiqadmin', '$2y$10$Aw23VFr632yJqwO6wIfaJuIQjvtSNOHRD4eK4h70fTWgBuM24FIT2');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `id` int(11) NOT NULL,
  `nik_anggota` bigint(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` char(15) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nik_anggota`, `nama`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_hp`, `gambar`, `username`, `password`) VALUES
(1, 3206511111990001, 'opiq palsu', 'Laki - Laki', 'Islam', 'Garut', '1998-11-11', 'cilawu', 'opiqbhg10@yahoo.com', '081234567089', 'default.jpg', 'opiq', '$2y$10$ucLJRpDIEt8PXDV.StsMpO1OpSy64CWlF7Ot4e29.jw5.3v8SRQ1i');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE IF NOT EXISTS `keuangan` (
  `id` int(11) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `saldo` int(11) NOT NULL,
  `tarik` int(8) NOT NULL,
  `sisa_saldo` int(8) NOT NULL,
  `total_saldo` int(8) NOT NULL,
  `pinjaman` int(8) NOT NULL,
  `bayar` int(8) NOT NULL,
  `sisa_bayar` int(8) NOT NULL,
  `lama_bayar` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL,
  `kd_transaksi` char(9) NOT NULL,
  `nik` int(16) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `simpan` int(8) NOT NULL,
  `tarik` int(8) NOT NULL,
  `pinjam` int(8) NOT NULL,
  `bayar` int(8) NOT NULL,
  `edit` char(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kd_transaksi`, `nik`, `tanggal_transaksi`, `simpan`, `tarik`, `pinjam`, `bayar`, `edit`) VALUES
(1, '901201', 0, '2020-01-09', 100000, 0, 0, 0, ''),
(2, '901202', 0, '2020-01-09', 0, 50000, 0, 0, ''),
(3, '901203', 0, '2020-01-09', 200000, 0, 0, 0, ''),
(4, '901204', 0, '2020-01-09', 0, 100000, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kd_pegawai`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `nik_pegawai` (`nik_pegawai`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nik_anggota`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kd_transaksi`), ADD UNIQUE KEY `id` (`id`), ADD KEY `nik` (`nik`), ADD KEY `edit` (`edit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `keuangan`
--
ALTER TABLE `keuangan`
ADD CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `anggota` (`nik_anggota`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
