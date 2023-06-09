/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_product_cuisine` (
  `dataid` int(10) UNSIGNED NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_path` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_product_cuisine` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_cuisine` MODIFY `dataid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


