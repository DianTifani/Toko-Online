-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 03:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_olshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `penjual_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `nama`, `harga`, `stock`, `penjual_id`) VALUES
(1, 'Hoodie Hnm', 235000, 20, 1),
(2, 'Kemeja 3Second', 150000, 25, 3),
(3, 'Jacket Hnm', 300000, 35, 2),
(4, 'Jaket 3Seconnd', 150000, 23, 3),
(5, 'Kemeja Flannel Uniql', 230000, 25, 1),
(6, 'Cardigan Hnm', 175000, 41, 2),
(7, 'Hoodie Uniqlo', 200000, 14, 1),
(8, 'Jeans 3Second', 300000, 10, 10),
(9, 'Kaos Kaki Miniso', 30000, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `detail_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_session` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`detail_id`, `penjualan_id`, `barang_id`, `user_id`, `jumlah_barang`, `total_harga`, `tanggal_session`) VALUES
(5, 0, 3, 5, 10, 20000, '2020-11-01 10:59:31'),
(6, 1, 1, 5, 1, 210, '2020-11-01 02:06:26'),
(7, 2, 3, 5, 20, 40000, '2020-11-01 02:06:26'),
(8, 3, 1, 5, 2, 420, '2020-11-01 02:06:26'),
(10, 3, 6, 5, 1, 3, '2020-11-01 02:06:26'),
(11, 4, 1, 5, 10, 2100, '2020-11-01 02:06:26'),
(12, 5, 1, 5, 100, 21000, '2020-11-01 02:06:26'),
(14, 6, 1, 6, 10, 2100, '2020-11-01 04:36:39'),
(16, 1, 2, 1, 1, 150000, '2020-11-03 01:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `penjual_id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`penjual_id`, `nama`, `alamat`) VALUES
(2, 'Alif Bahar', 'Jl Veteran'),
(3, 'Bagas', 'Jl Sumatra GKB'),
(4, 'Arif Baharudin', 'Jl Jakarta GKB'),
(5, 'Putri ', 'Jl Surabaya no 17'),
(6, 'Erika', 'Jl Kalimantan GKB'),
(7, 'Indra Bagas', 'Jl Panglima Sudirman no 20'),
(8, 'Yudha Iswara', 'Jl Ahmad Yani'),
(9, 'Ajeng Kartika', 'Jl Wates no 19'),
(10, 'Dita Paranda', 'Jl GKA block 1'),
(11, 'Devan', 'Jl Majapahit no 20'),
(12, 'Satria reyhan', 'Jl Jendral Sudirman no 18');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `tanggal_penjualan`, `user_id`, `total_harga`, `status`) VALUES
(1, '2020-11-03', 1, 150000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'User Pertama', 'user', 'password', 'Admin'),
(16, 'Dian Tifani', 'dian', 'dian', 'Admin'),
(17, 'Kanu Habib Bagus', 'kanu', 'kanu', 'User'),
(18, 'Iqbal Pelu', 'iqbal', 'iqbal', 'User'),
(19, 'Bunga Inda', 'bunga', 'bunga', 'User'),
(20, 'Karina Bunga', 'karina', 'karina', 'User'),
(21, 'Nur Aini', 'aini', 'aini', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`penjual_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `penjual`
--
ALTER TABLE `penjual`
  MODIFY `penjual_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
