/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_user_social_media` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `tiktok` text DEFAULT NULL,
  `line` text DEFAULT NULL,
  `snapchat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_user_social_media` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_social_media` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


