-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 01:18 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `isora`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE IF NOT EXISTS `tb_guru` (
  `no_induk` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` varchar(30) NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `agama` text NOT NULL,
  `nama_orang_tua` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`no_induk`, `nisn`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `nama_orang_tua`, `pekerjaan`, `alamat`, `no_telepon`, `status`, `username`, `password`) VALUES
('12124', '123213', 'baba', 'baba', '12-11-2019', 'Laki-Laki', 'Kristen', 'nasnan', '', 'Jember', '12312', 'Kelas 6', 'baba', '21661093e56e24c'),
('657126735', '123213231', 'Birril', 'Saas', '20-11-2019', 'Laki-Laki', 'Islam', 'Nanis', '', 'Baba', '0990909', 'Kelas 2', 'birril', '21661093e56e24c'),
('61342', '17351', 'yweyjga', 'gdhad', '13-11-2000', 'Perempuan', 'Budha', 'dakgakkwkdukw', '', 'adhawjhdw', '163176', 'Kelas 3', '', 'd41d8cd98f00b20'),
('0', '232', 'ass', 'ss', '04-11-2019', 'Laki-Laki', 'Budha', 'as', 'as', 'fsad', '123', 'Kelas 2', 'bab', '21661093e56e24c'),
('', '7135523', 'rterawheag', 'feagehjw', '29-10-2000', 'Laki-Laki', 'Islam', 'akdawkwdh', 'jkdakjdah', 'wajdgawgda', '1752317', 'Kelas 2', 'ahkdaw', '202cb962ac59075');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE IF NOT EXISTS `tb_siswa` (
  `no_induk` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` varchar(30) NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `agama` text NOT NULL,
  `nama_orang_tua` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telepon` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`no_induk`, `nisn`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `nama_orang_tua`, `pekerjaan`, `alamat`, `no_telepon`, `status`, `username`, `password`) VALUES
('276153', '1257317', 'yrqtyeqre', 'ryrqte', '05-11-2019', 'Laki-Laki', 'Kong Hu Cu', 'ldhdeweu', 'heiweu', 'hdqheoh', '1753265', 'Kelas 3', 'hdkq', '202cb962ac59075'),
('61342', '17351', 'yweyjga', 'gdhad', '13-11-2000', 'Perempuan', 'Budha', 'dakgakkwkdukw', 'aa', 'adhawjhdw', '163176', 'Kelas 3', '', 'd41d8cd98f00b20'),
('5173135', '1753612', 'wetqeyjwagj', 'gwjydagj', '26-11-2019', 'Laki-Laki', 'Islam', 'jhdgajha', 'jgadjga', 'agdjahga', '8762386', '', 'ajgd', '202cb962ac59075'),
('185231', '232', 'ass', 'ss', '04-11-2019', 'Laki-Laki', 'Kristen', 'as', '', 'fsad', '123', 'Kelas 2', 'bab', '21661093e56e24c'),
('1526753', '3153215', 'rqyreyqer', 'rqwyerqq', '06-11-2000', 'Perempuan', 'Islam', 'AFHGDFSD', '', 'dgajdg', '273971771', 'Kelas 3', 'uye', '202cb962ac59075'),
('', '4125731', 'rwayra', 'WYRE', '07-11-2019', 'Perempuan', 'Kristen', 'jhdka', 'jhdakhd', 'GJDJGAW', '16328', 'Kelas 3', 'jagdjg', '202cb962ac59075'),
('63131', '541253', 'teaegwa', 'hefaftefa', '05-11-2000', 'Laki-Laki', 'Islam', 'badhada', 'ugwady', 'gadudiauwu', '127389', 'Kelas 5', 'jdwnakd', '202cb962ac59075'),
('', '7135523', 'rterawheag', 'feagehjw', '29-10-2000', 'Laki-Laki', 'Islam', 'akdawkwdh', 'jkdakjdah', 'wajdgawgda', '1752317', 'Kelas 2', 'ahkdaw', '202cb962ac59075');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
