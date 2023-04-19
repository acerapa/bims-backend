/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_blog` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `subject` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `cover` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_by` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_blog_category` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_by` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_blog_tagging` (
  `dataid` int(10) NOT NULL,
  `blog_refid` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tag_refid` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tag_type` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_blog` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_blog_category` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_blog_tagging` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_blog` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
ALTER TABLE `plugin_blog_category` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `plugin_blog_tagging` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

