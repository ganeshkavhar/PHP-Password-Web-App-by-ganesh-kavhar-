-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2017 at 08:00 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `passwordhistory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblpasswordhistory`
--

CREATE TABLE IF NOT EXISTS `tblpasswordhistory` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(150) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpasswordhistory`
--

INSERT INTO `tblpasswordhistory` (`id`, `UserEmail`, `password`, `PostingDate`) VALUES
(1, 'anuj@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2017-07-23 17:45:06'),
(3, 'anuj@gmail.com', '12bce374e7be15142e8172f668da00d8', '2017-07-23 18:50:40'),
(4, 'anuj@gmail.com', '5c428d8875d2948607f3e3fe134d71b4', '2017-07-24 17:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblregistration`
--

CREATE TABLE IF NOT EXISTS `tblregistration` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblregistration`
--

INSERT INTO `tblregistration` (`id`, `FullName`, `EmailId`, `Password`, `RegDate`) VALUES
(2, 'Anuj', 'anuj@gmail.com', '5c428d8875d2948607f3e3fe134d71b4', '2017-07-23 17:45:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblpasswordhistory`
--
ALTER TABLE `tblpasswordhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblregistration`
--
ALTER TABLE `tblregistration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpasswordhistory`
--
ALTER TABLE `tblpasswordhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblregistration`
--
ALTER TABLE `tblregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
