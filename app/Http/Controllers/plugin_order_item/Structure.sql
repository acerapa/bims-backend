/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_order_item.status
          0: Newly added to the cart
          1: Placed items
          2: Cancelled by customer
          3: Seen by store
          4: Accepted by store
          5: Refused by store
*/

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2023 at 06:50 AM
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
-- Table structure for table `plugin_order_item`
--

CREATE TABLE `plugin_order_item` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `order_placed_refid` varchar(22) DEFAULT NULL,
  `product_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `store_refid` varchar(22) DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `variant_refid` varchar(22) DEFAULT NULL,
  `add_ons_array` text DEFAULT NULL,
  `add_ons_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_order_item`
--
ALTER TABLE `plugin_order_item`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `reference_id` (`reference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_order_item`
--
ALTER TABLE `plugin_order_item`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
