/*******************************************************************************************
        DATABASE TABLE STRUCTURE
*******************************************************************************************
        plugin_product_pricing.price
          - Single price products

        plugin_product_pricing.price_variants
          - Array of variant Price
          [
            label: 'Sizes and flavor',
            option: [
              {
                label: '6oz',
                price: 108.99,
                photo: ['IMG_REFID','PATH'],
                default: 1
              },
              {
                label: '8oz',
                price: 134.99,
                photo: ['IMG_REFID','PATH'],
                default: 0
              }
            ]
          ]
          
        plugin_product_pricing.addons
          - Array of addons
          ['ADO-123-456','ADO-123-456','ADO-123-456']

        plugin_product_pricing.price_type
          - SP: Single price
          - VP: Variant Price

*/


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2023 at 08:27 AM
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
-- Table structure for table `plugin_product_pricing`
--

CREATE TABLE `plugin_product_pricing` (
  `dataid` int(10) NOT NULL,
  `product_refid` varchar(22) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `price_variants` text DEFAULT NULL,
  `price_type` varchar(3) DEFAULT NULL,
  `addons` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plugin_product_pricing`
--

INSERT INTO `plugin_product_pricing` (`dataid`, `product_refid`, `price`, `price_variants`, `price_type`, `addons`, `created_at`, `created_by`) VALUES
(1, 'PRD-05102023024701-NKA', '0.00', NULL, NULL, NULL, '2023-05-10 14:47:43', 'USR-033121093459-TCS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_product_pricing`
--
ALTER TABLE `plugin_product_pricing`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `product_refid` (`product_refid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_product_pricing`
--
ALTER TABLE `plugin_product_pricing`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
