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
  `photo` text DEFAULT '["IMG_REFID", "PATH"]',
  `access` int(3) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `plugin_user` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `reference_id` (`reference_id`);
ALTER TABLE `plugin_user` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

