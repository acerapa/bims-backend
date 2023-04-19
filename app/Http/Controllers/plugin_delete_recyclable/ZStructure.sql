/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_recycle_bin` (
  `dataid` int(10) NOT NULL,
  `table_src` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `where_src` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_object` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_date` datetime DEFAULT current_timestamp(),
  `deleted_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restored_date` int(11) DEFAULT NULL,
  `restored_by` datetime DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '1:New 2:Restored 3:Permanent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_recycle_bin` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_recycle_bin` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;



