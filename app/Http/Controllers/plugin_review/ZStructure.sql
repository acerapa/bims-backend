/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_review` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int(3) NOT NULL DEFAULT 0,
  `hightlight` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '[\r\n{photo_refid,filepath}\r\n]',
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_review_tagging` (
  `dataid` int(10) NOT NULL,
  `review_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_type` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_review` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `reference_id` (`reference_id`);
ALTER TABLE `plugin_review_tagging` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_review` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_review_tagging` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

