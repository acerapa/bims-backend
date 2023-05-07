/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************    
*/

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2023 at 04:41 AM
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
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `review_score` decimal(10,2) NOT NULL DEFAULT 0.00,
  `followers` decimal(10,0) NOT NULL DEFAULT 0,
  `open` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plugin_store`
--

INSERT INTO `plugin_store` (`dataid`, `reference_id`, `name`, `description`, `photo_refid_logo`, `photo_refid_cover`, `address`, `province_code`, `city_code`, `brgy_code`, `geo_lat`, `geo_lng`, `created_at`, `created_by`, `review_score`, `followers`, `open`) VALUES
(1, 'STR-05042023044205-QEN', 'Computer Hub', 'We sell basic parts of a desktop computer include case, monitor, keyboard, mouse, and power cord. Each part plays an important role whenever you use and we assure the best quality may offers as possible.', '[\"IMG_REFID\",\"https://img.freepik.com/premium-vector/creative-computer-logo-template_23-2149213536.jpg\"]', '[\"IMG_REFID\",\"https://www.alert-software.com/hubfs/custom_desktop_wallpaper.png\"]', 'Toledo City, Cebu', '0', '0', '0', '10.358466909520317', '123.69111644644013', '2023-05-04 08:41:17', 'USR-033121093459-TCS', '4.70', '103', 1),
(2, 'STR-05042023044221-OAI', 'Grace Minimart', 'Your trusted grocery store', '[\"IMG_REFID\",\"https://www.logomyway.com/logos_new/28616/hartville_393652106087.jpg\"]', '[\"IMG_REFID\",\"https://cdn2.vectorstock.com/i/1000x1000/68/76/minimarket-building-with-town-background-vector-31176876.jpg\"]', 'Carcar City, Cebu', '0', '0', '0', '10.122191280050886', '123.62219716621209', '2023-05-04 08:41:17', 'USR-033121093459-TCS', '5.00', '7', 1),
(3, 'STR-05042023044228-G36', 'James K School Supply', 'Need school supply, order online at James', '[\"IMG_REFID\",\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsTijciz1obMHu8eN3xydvI8gSMHf5FOtTGmQpp-a3t6BarvjJWSN3Y4CM5m3ObpKt__4&usqp=CAU\"]', '[\"IMG_REFID\",\"https://cdn4.vectorstock.com/i/1000x1000/97/58/supermarket-background-grocery-store-products-vector-25899758.jpg\"]', 'Badian Cebu', '0', '0', '0', '9.845351299008104', '123.42013159977301', '2023-05-04 08:41:32', 'USR-033121093459-TCS', '3.70', '90', 1),
(4, 'STR-05042023044235-4UB', 'Lance Hardware De Cebu', 'Nangita bamo ug gahi, lig-on ug kasaligan? Sa Lance Hardware kana mga bro!', '[\"IMG_REFID\",\"https://us.123rf.com/450wm/butenkov/butenkov2011/butenkov201100006/180573042-vector-logo-of-a-store-building-materials-company.jpg?ver=6\"]', '[\"IMG_REFID\",\"https://www.merchantcapital.co.za/hubfs/Hardware%20Store-01.jpg\"]', 'City of Naga,Cebu', '0', '0', '0', '10.247939689179487', '123.72905645728144', '2023-05-04 08:41:32', 'USR-033121093459-TCS', '4.80', '0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plugin_store`
--
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
