/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_user` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `middlename` varchar(60) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `access` int(3) NOT NULL DEFAULT 2 COMMENT '1:Admin 2:Reg User',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `plugin_user_authentication` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` int(3) NOT NULL DEFAULT 0 COMMENT '0: Unverified \r\n1: Verified',
  `user_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_credential` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_credential` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_login` datetime DEFAULT NULL,
  `date_logout` datetime DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_user_blocked` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '1:Blocked 2:Unblocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_user_personalize` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'light' COMMENT '[dark,light]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plugin_user_social_media` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snapchat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_user` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `reference_id` (`reference_id`);
ALTER TABLE `plugin_user_authentication` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `reference_id` (`reference_id`);
ALTER TABLE `plugin_user_blocked` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_personalize` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_social_media` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `plugin_user_authentication` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_user_blocked` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_user_personalize` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


