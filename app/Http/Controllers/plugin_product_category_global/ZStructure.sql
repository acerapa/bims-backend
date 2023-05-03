/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2023 at 03:01 PM
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
-- Database: `foxc_foxcity`
--

-- --------------------------------------------------------

--
-- Table structure for table `plugin_product_category_global`
--

CREATE TABLE `plugin_product_category_global` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `icon` text NOT NULL DEFAULT '[IMG_REF,PATH]',
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plugin_product_category_global`
--

INSERT INTO `plugin_product_category_global` (`dataid`, `reference_id`, `name`, `icon`, `status`) VALUES
(1, 'PGC-05032023092712-KRE', 'Men\'s Apparel & Accessories', '[\"IMG_REFID\",\"PATH\"]', 1),
(2, 'PGC-05032023092720-E04', 'Computers, Mobile & Gadgets', '[\"IMG_REFID\",\"PATH\"]', 1),
(4, 'PGC-05032023092727-FVD', 'Babies & Kids', '[\"IMG_REFID\",\"PATH\"]', 1),
(5, 'PGC-05032023092733-IK8', 'Hardware & Tools', '[\"IMG_REFID\",\"PATH\"]', 1),
(6, 'PGC-05032023092740-P02', 'Groceries', '[\"IMG_REFID\",\"PATH\"]', 1),
(7, 'PGC-05032023092745-5ZC', 'Kids Toys & Games', '[\"IMG_REFID\",\"PATH\"]', 1),
(8, 'PGC-05032023092752-EEI', 'Woman\'s Apparel & Accessories', '[\"IMG_REFID\",\"PATH\"]', 1),
(9, 'PGC-05032023092758-QEF', 'Home Appliances', '[\"IMG_REFID\",\"PATH\"]', 1),
(11, 'PGC-05032023092809-6HN', 'Sports & Travel', '[\"IMG_REFID\",\"PATH\"]', 1),
(12, 'PGC-05032023092815-TJZ', 'Shoes & Foot Wears', '[\"IMG_REFID\",\"PATH\"]', 1),
(13, 'PGC-05032023092820-ZYT', 'Motorcycle Parts & Accessories', '[\"IMG_REFID\",\"PATH\"]', 1),
(14, 'PGC-05032023092825-171', 'Pet Care & Supply', '[\"IMG_REFID\",\"PATH\"]', 1),
(15, 'PGC-05032023093728-NAQ', 'Health & Beauty', '[\"IMG_REFID\",\"PATH\"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plugin_product_category_global_subcategories`
--

CREATE TABLE `plugin_product_category_global_subcategories` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `category_refid` varchar(22) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plugin_product_category_global_subcategories`
--

INSERT INTO `plugin_product_category_global_subcategories` (`dataid`, `reference_id`, `category_refid`, `name`, `status`) VALUES
(1, 'PSC-05032023095938-TMZ', 'PGC-05032023092712-KRE', 'Tops', 1),
(2, 'PSC-05032023095945-EM6', 'PGC-05032023092712-KRE', 'Shorts', 1),
(3, 'PSC-05032023095952-J1H', 'PGC-05032023092712-KRE', 'Pants', 1),
(4, 'PSC-05032023095957-57Y', 'PGC-05032023092712-KRE', 'Jeans', 1),
(5, 'PSC-05032023100005-9QI', 'PGC-05032023092712-KRE', 'Underwear', 1),
(6, 'PSC-05032023100012-JCO', 'PGC-05032023092712-KRE', 'Hoodies', 1),
(7, 'PSC-05032023100018-XA0', 'PGC-05032023092712-KRE', 'Sweatshirts', 1),
(8, 'PSC-05032023100024-17A', 'PGC-05032023092712-KRE', 'Jackets', 1),
(9, 'PSC-05032023100029-7YM', 'PGC-05032023092712-KRE', 'Sweaters', 1),
(10, 'PSC-05032023100035-8EW', 'PGC-05032023092712-KRE', 'Sleepwear', 1),
(11, 'PSC-05032023100040-PH5', 'PGC-05032023092712-KRE', 'Sets', 1),
(12, 'PSC-05032023100046-Y94', 'PGC-05032023092712-KRE', 'Formal Attire', 1),
(13, 'PSC-05032023100052-8YM', 'PGC-05032023092712-KRE', 'Traditional Wear', 1),
(14, 'PSC-05032023100058-VVR', 'PGC-05032023092712-KRE', 'Custumes', 1),
(15, 'PSC-05032023100104-9Q3', 'PGC-05032023092712-KRE', 'Others', 1),
(16, 'PSC-05032023102720-96B', 'PGC-05032023092720-E04', 'Cellphone', 1),
(17, 'PSC-05032023102727-51V', 'PGC-05032023092720-E04', 'Headphones', 1),
(18, 'PSC-05032023102734-MQ0', 'PGC-05032023092720-E04', 'Microphone', 1),
(19, 'PSC-05032023102739-X98', 'PGC-05032023092720-E04', 'Mouse', 1),
(20, 'PSC-05032023102745-5OU', 'PGC-05032023092720-E04', 'Keyboard', 1),
(21, 'PSC-05032023102750-VQI', 'PGC-05032023092720-E04', 'MP3 Players', 1),
(22, 'PSC-05032023102756-RRQ', 'PGC-05032023092720-E04', 'Webcam', 1),
(23, 'PSC-05032023102801-BX2', 'PGC-05032023092720-E04', 'Hardsrive', 1),
(24, 'PSC-05032023102806-UOY', 'PGC-05032023092720-E04', 'Camera', 1),
(25, 'PSC-05032023102813-XD9', 'PGC-05032023092720-E04', 'Memory Stick', 1),
(26, 'PSC-05032023102820-NYV', 'PGC-05032023092720-E04', 'Router', 1),
(27, 'PSC-05032023102826-GWD', 'PGC-05032023092720-E04', 'Computer and Accessoris', 1),
(28, 'PSC-05032023102832-234', 'PGC-05032023092720-E04', 'Laptop', 1),
(29, 'PSC-05032023102838-6WC', 'PGC-05032023092720-E04', 'Memory Card', 1),
(30, 'PSC-05032023102844-XR4', 'PGC-05032023092720-E04', 'Printer & Inks', 1),
(31, 'PSC-05032023102850-Y12', 'PGC-05032023092720-E04', 'iPod', 1),
(32, 'PSC-05032023102857-0PD', 'PGC-05032023092720-E04', 'Earbuds', 1),
(33, 'PSC-05032023102904-EJZ', 'PGC-05032023092720-E04', 'Game Console', 1),
(34, 'PSC-05032023103722-P4P', 'PGC-05032023092720-E04', 'Powerbanks', 1),
(35, 'PSC-05032023103730-YII', 'PGC-05032023092720-E04', 'Chargers', 1),
(36, 'PSC-05032023103735-52O', 'PGC-05032023092720-E04', 'Cases and Covers', 1),
(37, 'PSC-05032023103741-IBY', 'PGC-05032023092720-E04', 'USB Drive', 1),
(38, 'PSC-05032023103747-9H7', 'PGC-05032023092720-E04', 'Network Components', 1),
(39, 'PSC-05032023103752-6XV', 'PGC-05032023092720-E04', 'Other', 1),
(40, 'PSC-05032023105032-RR9', 'PGC-05032023092727-FVD', 'Baby Detergents', 1),
(41, 'PSC-05032023105040-PYZ', 'PGC-05032023092727-FVD', 'Unisex Fashion', 1),
(42, 'PSC-05032023105049-I4R', 'PGC-05032023092727-FVD', 'Rain Gears', 1),
(43, 'PSC-05032023105058-V3N', 'PGC-05032023092727-FVD', 'Nursery', 1),
(44, 'PSC-05032023105104-COU', 'PGC-05032023092727-FVD', 'Moms & Maternity', 1),
(45, 'PSC-05032023105110-YRZ', 'PGC-05032023092727-FVD', 'Baby Gear', 1),
(46, 'PSC-05032023105118-JHP', 'PGC-05032023092727-FVD', 'Health Care', 1),
(47, 'PSC-05032023105123-BLM', 'PGC-05032023092727-FVD', 'Skin Care', 1),
(48, 'PSC-05032023105129-10Y', 'PGC-05032023092727-FVD', 'Boys\' Fashion', 1),
(49, 'PSC-05032023105135-QD1', 'PGC-05032023092727-FVD', 'Girls\' Fashion', 1),
(50, 'PSC-05032023105141-I4R', 'PGC-05032023092727-FVD', 'Diapers & Wipes', 1),
(51, 'PSC-05032023105024-A94', 'PGC-05032023092727-FVD', 'Feeding', 1),
(52, 'PSC-05032023105019-W4A', 'PGC-05032023092727-FVD', 'Other', 1),
(53, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_product_category_global`
--
ALTER TABLE `plugin_product_category_global`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `reference_id` (`reference_id`);

--
-- Indexes for table `plugin_product_category_global_subcategories`
--
ALTER TABLE `plugin_product_category_global_subcategories`
  ADD PRIMARY KEY (`dataid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plugin_product_category_global`
--
ALTER TABLE `plugin_product_category_global`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `plugin_product_category_global_subcategories`
--
ALTER TABLE `plugin_product_category_global_subcategories`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
