-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 03:43 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `smart_admin`
--

CREATE TABLE `smart_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(80) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_admin`
--

INSERT INTO `smart_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Administrasi', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `smart_alternatif`
--

CREATE TABLE `smart_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kelas_alternatif` varchar(10) NOT NULL,
  `nama_alternatif` varchar(45) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat_alternatif` varchar(50) NOT NULL,
  `hasil_alternatif` double NOT NULL,
  `ket_alternatif` text NOT NULL,
  `nis` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_alternatif`
--

INSERT INTO `smart_alternatif` (`id_alternatif`, `kelas_alternatif`, `nama_alternatif`, `jenis_kelamin`, `alamat_alternatif`, `hasil_alternatif`, `ket_alternatif`, `nis`) VALUES
(24, 'Kelas 2', 'Aditya Ahmad', 'Laki-laki', 'Pondok Surya', 60, 'MENERIMA BANTUAN', '20211026'),
(46, 'Kelas 3', 'Afrial Rizky', 'Laki-laki', 'Karang Tengah', 40, 'TIDAK MENERIMA BANTUAN', '20211307'),
(47, 'Kelas 5', 'Aldi Albar Saputra', 'Laki-laki', 'Ciledug Indah ', 25, 'TIDAK MENERIMA BANTUAN', '20211469'),
(48, 'Kelas 2', 'Angga Ramadan', 'Laki-laki', 'Ciledug Indah 2', 100, 'MENERIMA BANTUAN', '20211312'),
(49, 'Kelas 1', 'Aura Syaputri Amalia', 'Perempuan', 'Pinang Griya', 90, 'MENERIMA BANTUAN', '20211913'),
(52, 'Kelas 4', 'Dwi Evania Sabilillah', 'Perempuan', 'Pinang Griya', 30, 'TIDAK MENERIMA BANTUAN', '20211415'),
(53, 'Kelas 5', 'Dita Pramulia', 'Perempuan', 'Ciledug Indah 2', 30, 'TIDAK MENERIMA BANTUAN', '2021018'),
(54, 'Kelas 6', 'Erik Setiawan Ahmad', 'Laki-laki', 'Karang Tengah', 30, 'TIDAK MENERIMA BANTUAN', '20211619'),
(55, 'Kelas 5', 'Fata Ariesta Ramadan', 'Laki-laki', 'Metro Permata', 47.5, 'TIDAK MENERIMA BANTUAN', '20211725'),
(56, 'Kelas 2', 'Fidell Muhammad ', 'Laki-laki', 'Pondok Surya', 50, 'MENERIMA BANTUAN', '20211328');

-- --------------------------------------------------------

--
-- Table structure for table `smart_alternatif_kriteria`
--

CREATE TABLE `smart_alternatif_kriteria` (
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_alternatif_kriteria` double NOT NULL,
  `bobot_alternatif_kriteria` double NOT NULL,
  `periode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_alternatif_kriteria`
--

INSERT INTO `smart_alternatif_kriteria` (`id_alternatif`, `id_kriteria`, `nilai_alternatif_kriteria`, `bobot_alternatif_kriteria`, `periode`) VALUES
(0, 18, 2, 0, '2021'),
(0, 19, 2, 0, '2021'),
(0, 20, 4, 0, '2021'),
(0, 21, 2, 0, '2021'),
(24, 18, 75, 30, '2021'),
(24, 19, 50, 12.5, '2021'),
(24, 20, 50, 10, '2021'),
(24, 21, 50, 7.5, '2021'),
(46, 18, 50, 20, '2021'),
(46, 19, 50, 12.5, '2021'),
(46, 20, 0, 0, '2021'),
(46, 21, 50, 7.5, '2021'),
(47, 18, 25, 10, '2021'),
(47, 19, 0, 0, '2021'),
(47, 20, 75, 15, '2021'),
(47, 21, 0, 0, '2021'),
(48, 18, 100, 40, '2021'),
(48, 19, 100, 25, '2021'),
(48, 20, 100, 20, '2021'),
(48, 21, 100, 15, '2021'),
(49, 18, 75, 30, '2021'),
(49, 19, 100, 25, '2021'),
(49, 20, 100, 20, '2021'),
(49, 21, 100, 15, '2021'),
(51, 18, 2, 0, ''),
(51, 19, 3, 0, ''),
(51, 20, 1, 0, ''),
(51, 21, 1, 0, ''),
(52, 18, 0, 0, '2021'),
(52, 19, 50, 12.5, '2021'),
(52, 20, 50, 10, '2021'),
(52, 21, 50, 7.5, '2021'),
(53, 18, 25, 10, '2021'),
(53, 19, 50, 12.5, '2021'),
(53, 20, 0, 0, '2021'),
(53, 21, 50, 7.5, '2021'),
(54, 18, 50, 20, '2021'),
(54, 19, 0, 0, '2021'),
(54, 20, 50, 10, '2021'),
(54, 21, 0, 0, '2021'),
(55, 18, 0, 0, '2021'),
(55, 19, 100, 25, '2021'),
(55, 20, 75, 15, '2021'),
(55, 21, 50, 7.5, '2021'),
(56, 18, 50, 20, '2021'),
(56, 19, 50, 12.5, '2021'),
(56, 20, 50, 10, '2021'),
(56, 21, 50, 7.5, '2021');

-- --------------------------------------------------------

--
-- Table structure for table `smart_kriteria`
--

CREATE TABLE `smart_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(45) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_kriteria`
--

INSERT INTO `smart_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(18, 'Penghasilan Orang Tua', 0.4),
(19, 'Jumlah Tanggungan Orang Tua', 0.25),
(20, 'Status Anak', 0.2),
(21, 'Kepemilikan Tempat Tinggal', 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `smart_sub_kriteria`
--

CREATE TABLE `smart_sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `nama_sub_kriteria` varchar(45) NOT NULL,
  `nilai_sub_kriteria` double NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_sub_kriteria`
--

INSERT INTO `smart_sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `nilai_sub_kriteria`, `id_kriteria`) VALUES
(40, 'Numpang', 100, 21),
(41, 'Kontrak', 50, 21),
(42, 'Milik Sendiri', 0, 21),
(43, 'Yatim Piatu', 100, 20),
(44, 'Yatim', 75, 20),
(45, 'Piatu', 50, 20),
(46, 'Masih Ada', 0, 20),
(47, '1', 100, 19),
(48, '2', 50, 19),
(49, '>= 3', 0, 19),
(51, '< 500.000', 100, 18),
(52, '500.000 - 1.499.999', 75, 18),
(53, '1.500.000 - 1.999.999', 50, 18),
(54, '2.000.000 - 2.999.999', 25, 18),
(55, '3.000.000 - 3.999.999', 0, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smart_admin`
--
ALTER TABLE `smart_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `smart_alternatif`
--
ALTER TABLE `smart_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `smart_alternatif_kriteria`
--
ALTER TABLE `smart_alternatif_kriteria`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`);

--
-- Indexes for table `smart_kriteria`
--
ALTER TABLE `smart_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `smart_sub_kriteria`
--
ALTER TABLE `smart_sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smart_admin`
--
ALTER TABLE `smart_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `smart_alternatif`
--
ALTER TABLE `smart_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `smart_kriteria`
--
ALTER TABLE `smart_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `smart_sub_kriteria`
--
ALTER TABLE `smart_sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
