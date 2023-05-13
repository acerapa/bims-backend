/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2023 at 07:05 AM
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
-- Table structure for table `plugin_photo`
--

CREATE TABLE `plugin_photo` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagged` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `extension` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_no` int(3) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plugin_photo_tagging`
--

CREATE TABLE `plugin_photo_tagging` (
  `dataid` int(10) NOT NULL,
  `photo_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagged` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_photo`
--
ALTER TABLE `plugin_photo`
  ADD PRIMARY KEY (`dataid`);

--
-- Indexes for table `plugin_photo_tagging`
--
ALTER TABLE `plugin_photo_tagging`
  ADD PRIMARY KEY (`dataid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_photo`
--
ALTER TABLE `plugin_photo`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plugin_photo_tagging`
--
ALTER TABLE `plugin_photo_tagging`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


