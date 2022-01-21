-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 12:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pulsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id` int(11) NOT NULL,
  `id_jenis` varchar(55) NOT NULL,
  `jenis_transaksi` varchar(55) NOT NULL,
  `type` varchar(1) NOT NULL COMMENT 'D = debit, C = credit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id`, `id_jenis`, `jenis_transaksi`, `type`) VALUES
(1, '1', 'Beli Pulsa', 'D'),
(2, '2', 'Bayar Listrik', 'D'),
(3, '3', 'Setor Tunai', 'C'),
(4, '4', 'Tarik Tunai', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `AccountID` int(11) NOT NULL,
  `Name` varchar(55) NOT NULL,
  `Balance` int(11) NOT NULL,
  `Point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`AccountID`, `Name`, `Balance`, `Point`) VALUES
(1, 'Customer 1', 1130000, 85),
(2, 'Customer 2', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `TransactionID` varchar(55) NOT NULL,
  `TransactionType` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `TransactionDate` date NOT NULL,
  `Description` int(11) NOT NULL,
  `DebitCreditStatus` varchar(55) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`TransactionID`, `TransactionType`, `AccountID`, `TransactionDate`, `Description`, `DebitCreditStatus`, `Amount`, `Point`) VALUES
('3IVW7Aqj', 1, 1, '2022-01-21', 1, 'D', 20000, 10),
('6tJ15PZ3', 2, 1, '2022-01-20', 2, 'D', 100000, 25),
('7wsfwr4v', 2, 1, '2022-01-21', 2, 'D', 100000, 25),
('9FRFxp9o', 2, 1, '2022-01-23', 2, 'D', 80000, 15),
('9pe0ERkO', 3, 1, '2022-01-21', 3, 'C', 1000000, 0),
('aIEONVE3', 3, 1, '2022-01-02', 3, 'C', 200000, 0),
('D2WQS1BW', 1, 1, '2022-01-05', 1, 'D', 20000, 10),
('df6Keacu', 2, 1, '2022-01-21', 2, 'D', 20000, 0),
('gOMmpmt4', 1, 1, '2022-01-18', 1, 'D', 10000, 0),
('gyFz166L', 1, 1, '2022-01-21', 1, 'D', 10000, 0),
('l9DwDSbu', 1, 1, '2022-01-21', 1, 'D', 5000, 0),
('r7nGGL5q', 3, 1, '2022-01-21', 3, 'C', 100000, 0),
('XKoAyi4c', 3, 1, '2021-12-21', 3, 'C', 200000, 0),
('Yo16a9zm', 1, 1, '2022-01-21', 1, 'D', 5000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`TransactionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
