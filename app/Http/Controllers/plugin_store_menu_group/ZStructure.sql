/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_store_menu_group` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `store_refid` varchar(22) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_store_menu_group` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_store_menu_group` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

