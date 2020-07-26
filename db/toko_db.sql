-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2020 at 08:59 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `kode_barcode` varchar(100) NOT NULL,
  `kategori` varchar(150) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` varchar(20) NOT NULL,
  `harga_jual` varchar(20) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id_produk`, `nama_produk`, `kode_barcode`, `kategori`, `stok`, `harga_beli`, `harga_jual`, `tgl_buat`, `tgl_up`, `catatan`) VALUES
(792, 'panci', '123', '23', 1, '1000', '700', '2020-07-26 08:50:55', '2020-07-26 01:50:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `grouping_penjualan`
--

CREATE TABLE `grouping_penjualan` (
  `id_terjual` int(11) NOT NULL,
  `total` varchar(20) NOT NULL,
  `potongan` varchar(20) NOT NULL,
  `opr` varchar(100) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `jumlah_uang_dibayar` varchar(20) NOT NULL,
  `kembalian` varchar(20) NOT NULL,
  `dipotong` varchar(20) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grouping_penjualan`
--

INSERT INTO `grouping_penjualan` (`id_terjual`, `total`, `potongan`, `opr`, `tgl_input`, `jumlah_uang_dibayar`, `kembalian`, `dipotong`, `catatan`) VALUES
(1, '196395', '', 'lintar', '2019-12-22 18:03:55', '0', '0', '', ''),
(2, '196395', '', 'lintar', '2019-12-22 18:04:25', '0', '0', '', ''),
(3, '392790', '', 'lintar', '2019-12-24 21:30:52', '0', '0', '', ''),
(4, '392790', '', 'lintar', '2019-12-24 21:31:16', '0', '0', '', ''),
(5, '392790', '', 'lintar', '2019-12-24 21:33:15', '0', '0', '', ''),
(6, '392790', '', 'lintar', '2019-12-24 21:33:25', '0', '0', '', ''),
(7, '392790', '', 'lintar', '2019-12-24 21:33:31', '0', '0', '', ''),
(8, '392790', '', 'lintar', '2019-12-24 21:38:08', '0', '0', '', ''),
(9, '392790', '', 'lintar', '2019-12-24 21:38:12', '0', '0', '', ''),
(10, '392790', '', 'lintar', '2019-12-24 21:38:22', '0', '0', '', ''),
(11, '24000', '', 'lintar', '2019-12-24 21:38:59', '0', '0', '', ''),
(12, '60477', '5000', 'lintar', '2019-12-24 21:58:36', '60000', '4523', '55477', ''),
(13, '130930', '0', 'lintar', '2019-12-24 22:24:10', '0', '0', '130930', NULL),
(14, '65465', '0', 'lintar', '2019-12-24 22:24:47', '0', '0', '65465', 'tes aja'),
(15, '65465', '0', 'lintar', '2019-12-25 01:35:37', '0', '0', '65465', ''),
(16, '65477', '0', 'lintar', '2019-12-25 10:00:05', '0', '0', '65477', 'hallo'),
(17, '130930', '0', 'lintar', '2019-12-25 10:02:30', '0', '0', '130930', ''),
(18, '65465', '0', 'lintar', '2019-12-27 07:51:40', '0', '0', '65465', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'kategori'),
(23, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `log_stok`
--

CREATE TABLE `log_stok` (
  `no_lstok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `stok_sesudah` varchar(10) NOT NULL,
  `stok_sebelum` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tgl_up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `opr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_stok`
--

INSERT INTO `log_stok` (`no_lstok`, `id_produk`, `stok_sesudah`, `stok_sebelum`, `keterangan`, `tgl_up`, `opr`) VALUES
(0, 1, '517', '518', 'Penjualan (Pengurangan)', '2019-12-27 06:51:40', 'lintar'),
(0, 791, '12', '0', 'Penambahan Produk (Penambahan)', '2019-12-27 07:29:24', 'lintar'),
(0, 791, '120', '120', 'Edit Produk (Pengurangan)', '2019-12-27 07:34:30', 'lintar'),
(0, 791, '12', '120', 'Edit Produk (Pengurangan)', '2019-12-27 07:35:50', 'lintar'),
(0, 791, '120', '12', 'Edit Produk (Penambahan)', '2019-12-27 07:36:02', 'lintar'),
(0, 1, '527', '517', 'Tambah Stok (Penambahan)', '2019-12-27 08:26:48', 'lintar'),
(0, 1, '537', '527', 'Tambah Stok (Penambahan)', '2019-12-27 08:26:55', 'lintar'),
(0, 791, '12', '120', 'Edit Produk (Pengurangan)', '2019-12-27 08:30:35', 'lintar'),
(0, 788, '788', '-788', 'Edit Produk (Penambahan)', '2019-12-27 08:31:41', 'lintar'),
(0, 792, '1', '0', 'Penambahan Produk (Penambahan)', '2020-07-26 01:50:55', 'lintar');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_peritem`
--

CREATE TABLE `penjualan_peritem` (
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_produk` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `hpp` varchar(20) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `opr` varchar(20) NOT NULL,
  `grouping_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_peritem`
--

INSERT INTO `penjualan_peritem` (`id_penjualan`, `id_produk`, `qty`, `harga_produk`, `total`, `hpp`, `tgl_input`, `opr`, `grouping_penjualan`) VALUES
(1, 1, 1, '65465', '65465', '', '2019-12-22 11:03:55', 'lintar', 1),
(2, 2, 1, '65465', '65465', '', '2019-12-22 11:03:55', 'lintar', 1),
(3, 1, 1, '65465', '65465', '', '2019-12-22 11:03:55', 'lintar', 1),
(4, 1, 1, '65465', '65465', '', '2019-12-22 11:04:25', 'lintar', 2),
(5, 2, 1, '65465', '65465', '', '2019-12-22 11:04:25', 'lintar', 2),
(6, 1, 1, '65465', '65465', '', '2019-12-22 11:04:25', 'lintar', 2),
(7, 1, 4, '65465', '261860', '', '2019-12-24 14:30:52', 'lintar', 3),
(8, 1, 1, '65465', '65465', '', '2019-12-24 14:30:52', 'lintar', 3),
(9, 1, 1, '65465', '65465', '', '2019-12-24 14:30:52', 'lintar', 3),
(10, 1, 4, '65465', '261860', '', '2019-12-24 14:31:16', 'lintar', 4),
(11, 1, 1, '65465', '65465', '', '2019-12-24 14:31:16', 'lintar', 4),
(12, 1, 1, '65465', '65465', '', '2019-12-24 14:31:16', 'lintar', 4),
(13, 1, 4, '65465', '261860', '', '2019-12-24 14:33:15', 'lintar', 5),
(14, 1, 1, '65465', '65465', '', '2019-12-24 14:33:15', 'lintar', 5),
(15, 1, 1, '65465', '65465', '', '2019-12-24 14:33:15', 'lintar', 5),
(16, 1, 4, '65465', '261860', '', '2019-12-24 14:33:25', 'lintar', 6),
(17, 1, 1, '65465', '65465', '', '2019-12-24 14:33:25', 'lintar', 6),
(18, 1, 1, '65465', '65465', '', '2019-12-24 14:33:25', 'lintar', 6),
(19, 1, 4, '65465', '261860', '', '2019-12-24 14:33:31', 'lintar', 7),
(20, 1, 1, '65465', '65465', '', '2019-12-24 14:33:31', 'lintar', 7),
(21, 1, 1, '65465', '65465', '', '2019-12-24 14:33:31', 'lintar', 7),
(22, 1, 4, '65465', '261860', '', '2019-12-24 14:38:08', 'lintar', 8),
(23, 1, 1, '65465', '65465', '', '2019-12-24 14:38:09', 'lintar', 8),
(24, 1, 1, '65465', '65465', '', '2019-12-24 14:38:09', 'lintar', 8),
(25, 1, 4, '65465', '261860', '', '2019-12-24 14:38:12', 'lintar', 9),
(26, 1, 1, '65465', '65465', '', '2019-12-24 14:38:12', 'lintar', 9),
(27, 1, 1, '65465', '65465', '', '2019-12-24 14:38:12', 'lintar', 9),
(28, 1, 4, '65465', '261860', '', '2019-12-24 14:38:22', 'lintar', 10),
(29, 1, 1, '65465', '65465', '', '2019-12-24 14:38:22', 'lintar', 10),
(30, 1, 1, '65465', '65465', '', '2019-12-24 14:38:22', 'lintar', 10),
(31, 788, 1000, '12', '12000', '', '2019-12-24 14:38:59', 'lintar', 11),
(32, 788, 1000, '12', '12000', '', '2019-12-24 14:38:59', 'lintar', 11),
(33, 786, 1, '12', '12', '', '2019-12-24 14:58:37', 'lintar', 12),
(34, 1, 1, '65465', '65465', '', '2019-12-24 14:58:37', 'lintar', 12),
(35, 1, 1, '65465', '65465', '', '2019-12-24 15:24:10', 'lintar', 13),
(36, 1, 1, '65465', '65465', '', '2019-12-24 15:24:10', 'lintar', 13),
(37, 1, 1, '65465', '65465', '', '2019-12-24 15:24:47', 'lintar', 14),
(38, 1, 1, '65465', '65465', '', '2019-12-24 18:35:38', 'lintar', 15),
(39, 1, 1, '65465', '65465', '', '2019-12-25 03:00:05', 'lintar', 16),
(40, 786, 1, '12', '12', '', '2019-12-25 03:00:05', 'lintar', 16),
(41, 1, 5, '65465', '65465', '5646', '2019-12-25 04:53:40', 'lintar', 17),
(42, 2, 1, '65465', '65465', '5646', '2019-12-25 03:02:30', 'lintar', 17),
(43, 1, 1, '65465', '65465', '5646', '2019-12-27 00:51:40', 'lintar', 18);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_toko`) VALUES
(1, 'LIFYAN');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'lintar', '202cb962ac59075b964b07152d234b70', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `grouping_penjualan`
--
ALTER TABLE `grouping_penjualan`
  ADD PRIMARY KEY (`id_terjual`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penjualan_peritem`
--
ALTER TABLE `penjualan_peritem`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=793;
--
-- AUTO_INCREMENT for table `grouping_penjualan`
--
ALTER TABLE `grouping_penjualan`
  MODIFY `id_terjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `penjualan_peritem`
--
ALTER TABLE `penjualan_peritem`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
