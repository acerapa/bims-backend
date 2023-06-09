/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_banner` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `group` varchar(60) DEFAULT NULL,
  `photo` text NOT NULL DEFAULT '[IMG_REF,PATH]',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_banner` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_banner` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

