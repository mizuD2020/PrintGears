-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 11:13 AM
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
-- Database: `mizu_stickers`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `SN` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `SN` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`SN`, `Name`, `Description`, `Price`, `Images`) VALUES
(13, 'Naruto', 'One piece', 200, 'http://localhost/mizustickers/uploads/664424d0001457.31380503Screenshot 2024-04-25 162800.png'),
(14, 'Pawan', 'aldhflwk', 12, 'http://localhost/mizustickers/uploads/66442f37acf780.37478164Screenshot 2024-04-25 162800.png'),
(15, 'Naruto', 'Naruto Sticker', 12, 'http://localhost/mizustickers/uploads/66443b7600f529.00691229Screenshot 2024-04-25 162800.png'),
(16, 'fkgsakf', 'asufhioas', 23, 'http://localhost/mizustickers/uploads/66486c26ebc472.74663374Screenshot 2024-05-18 073823.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `SN` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`SN`, `username`, `password`) VALUES
(1, 'Nitesh', '$2y$10$N.Gov49.Nn/VTJCJ9A7FzuNunO6mWzKCy/HmgKwzXwa4ZbxOhFnH.'),
(2, 'Sanjay dai', '$2y$10$4cYOzGNH1VTxoQ9rLvzAJ.AKJQAJPzCI7lqRx.DWTLGV6ZzIlkHYS'),
(3, 'MiZu', '$2y$10$4qX.SlMVk2W07pEuiiNitubXeAodN45FKrZbkX3QeMzfrByk4TxGi'),
(4, 'sakshi', '$2y$10$3BI7IJ7H5RRJCIm.1jxqnOX6eqVC1tTb5JigFJjABO71IEUjjUa5K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`SN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
