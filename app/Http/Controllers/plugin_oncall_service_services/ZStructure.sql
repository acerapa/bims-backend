/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        

*/
CREATE TABLE `plugin_oncall_service_services` (
  `dataid` int(10) NOT NULL,
  `code` varchar(6) NOT NULL,
  `service` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_oncall_service_services` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `code` (`code`);
ALTER TABLE `plugin_oncall_service_services` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
