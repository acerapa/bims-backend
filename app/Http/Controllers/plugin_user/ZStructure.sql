/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
*/

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2023 at 03:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foxc_shop_national`
--

-- --------------------------------------------------------

--
-- Table structure for table `plugin_user`
--

CREATE TABLE `plugin_user` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `middlename` varchar(60) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT '["IMG_REFID", "PATH"]',
  `access` int(3) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_user`
--
ALTER TABLE `plugin_user`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `reference_id` (`reference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_user`
--
ALTER TABLE `plugin_user`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
