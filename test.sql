-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2018 at 07:20 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garryb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `id` int(11) NOT NULL,
  `hashedUserAgentIP` varchar(200) CHARACTER SET utf8 NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inActive` tinyint(1) NOT NULL DEFAULT '1',
  `inActiveReg` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ip`
--

INSERT INTO `ip` (`id`, `hashedUserAgentIP`, `timestamp`, `inActive`, `inActiveReg`) VALUES
(196, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:26:08', 0, 0),
(197, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:26:11', 0, 0),
(200, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:29:43', 0, 0),
(201, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:49:46', 1, 0),
(202, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:50:56', 1, 1),
(203, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:53:44', 0, 1),
(205, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 17:58:34', 0, 1),
(208, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 18:00:15', 0, 1),
(213, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 18:03:41', 1, 0),
(214, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 18:03:43', 1, 0),
(215, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 18:03:45', 1, 0),
(216, '9c7355ae2a6f6d9d07d4e87fea45d55a', '2018-01-25 18:18:05', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `hashedPassword` varchar(500) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `hashedPassword`) VALUES
(1, 'aaron', '$xs§ÚÂÏR_.€2p¹MEìCà5±3˜8°PÝÆ$7f5dbc2262b66a35f6aeed3c090e500e'),
(36, 'richard', '$X(Ü™óàðç\rUÿ°?À“\0£#ÑD#¿î¼ Ò$ddc324595c5ab62d58098697514bb43e'),
(38, 'fred', '$	rTw…(ÜqÈ]êHj7ÿÙáq„1%cFg¢B^$c4cb19d8ac058a08588d336026b32f3d'),
(46, 'garry', '$1È9˜¤õZÁ‡7ëÙ÷¾©\n±¼¨.iîŒÜÏ¸Ú£õ$58009d6bd0509547fed52ba7489357c5'),
(47, 'rory', '$ŽŠgÊ%RËQÑ‡X(d\0?y½I—©¶^øÿX¬Ó…É$a61853c4ab4a54143f7c7b67b5b232bb'),
(48, 'bob', '$ 5¿o\ZU2Ç4ÛõFñïOd%šƒ‘ßzÖ*3$b0e968bda792ad8a9f2d85aebdf53fa2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
