/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************

        plugin_product_inventory.inv_type
          SI: Stock In
          SO: Stock Out
          
          
*/


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2023 at 11:44 AM
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
-- Table structure for table `plugin_product_inventory`
--

CREATE TABLE `plugin_product_inventory` (
  `dataid` int(10) NOT NULL,
  `product_refid` varchar(22) DEFAULT NULL,
  `inv_type` varchar(10) DEFAULT NULL,
  `quantity_inp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity_old` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity_new` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_product_inventory`
--
ALTER TABLE `plugin_product_inventory`
  ADD PRIMARY KEY (`dataid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_product_inventory`
--
ALTER TABLE `plugin_product_inventory`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
