/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_photo` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagged` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_photo_tagging` (
  `dataid` int(10) NOT NULL,
  `photo_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagged` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_photo` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_photo_tagging` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_photo` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `plugin_photo_tagging` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

