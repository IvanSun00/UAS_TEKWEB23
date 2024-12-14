-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 09:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uastekweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `nama`, `password`, `status`) VALUES
(39, 'admin', 'admin', '$2y$10$3rZBmfCf6JBPn0L/uDQEgONgZHFWuOnBX7rSV01Z7HDAPH0qUc.r2', 1),
(46, 'user', 'user', '$2y$10$RjaEHtJNRglen1HyQXrmpOgyLvSvaWwpB7zBeH11Ju6CIKyet1Y9i', 0),
(47, 'ivan', 'ivansunjaya', '$2y$10$O1zDBmmQI3p4eeHgVEtO1eT3TksJEtSLEXgSi83QoHsjPuZSyugv2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_resi`
--

CREATE TABLE `detail_resi` (
  `id` int(11) NOT NULL,
  `no_resi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kota` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_resi`
--

INSERT INTO `detail_resi` (`id`, `no_resi`, `tanggal`, `kota`, `keterangan`) VALUES
(4, 'adf', '2023-12-07', 'afdafda', 'adfa'),
(5, 'adfafa', '2023-12-19', 'malang', 'hujan parah'),
(6, 'adfafa', '2023-12-14', 'surabaya', 'mantappu jiwa'),
(7, 'afda', '2023-12-23', 'afda', 'adfa'),
(8, 'RS-001', '2023-12-13', 'malang', 'sampai hub malang\n'),
(9, 'RS-001', '2023-12-14', 'surabaya', 'barang sampai di hub surabaya, persiapan masuk rute jakarta'),
(10, 'RS-001', '2023-12-14', 'Jakarta', 'Barang Hilang'),
(12, 'RS-002', '2023-12-12', 'jakarta', 'barang siap dikirim\n'),
(13, 'RS-002', '2023-12-14', 'surabaya', 'barang sudah tiba di hub surabaya'),
(14, 'RS-002', '2023-12-15', 'Surabaya', 'Abang GoHar siap mengirim paket ketujuan\n'),
(15, 'RS-002', '2023-12-16', 'Surabaya', 'Barang telah diterima'),
(16, 'RS-003', '2023-12-12', 'Malang', 'Barang akan dikirmm'),
(17, 'RS-003', '2023-12-15', 'surabaya', 'Barang telah diterima ');

-- --------------------------------------------------------

--
-- Table structure for table `resi`
--

CREATE TABLE `resi` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resi`
--

INSERT INTO `resi` (`id`, `tanggal`, `nomor`) VALUES
(21, '2023-12-01', 'RS-001'),
(22, '2023-12-13', 'RS-002'),
(23, '2023-12-12', 'RS-003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_resi`
--
ALTER TABLE `detail_resi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resi`
--
ALTER TABLE `resi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `detail_resi`
--
ALTER TABLE `detail_resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `resi`
--
ALTER TABLE `resi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
