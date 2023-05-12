/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************  
        plugin_store.order_cost_service_fee  
          - Service of over total order cost in percent
*/

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2023 at 08:43 AM
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
-- Table structure for table `plugin_store`
--

CREATE TABLE `plugin_store` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `photo_refid_logo` text DEFAULT '[REFID, PATH]',
  `photo_refid_cover` text DEFAULT '[REFID, PATH]',
  `address` text DEFAULT NULL,
  `province_code` varchar(10) DEFAULT NULL,
  `city_code` varchar(10) DEFAULT NULL,
  `brgy_code` varchar(10) DEFAULT NULL,
  `geo_lat` varchar(30) DEFAULT NULL,
  `geo_lng` varchar(30) DEFAULT NULL,
  `order_cost_service_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `review_score` decimal(10,2) NOT NULL DEFAULT 0.00,
  `followers` decimal(10,0) NOT NULL DEFAULT 0,
  `open` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_store`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `reference_id` (`reference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_store`
--
ALTER TABLE `plugin_store`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
