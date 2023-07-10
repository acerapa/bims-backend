/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_notification.group
         - ONCALL_SERV_CANCELLED: On-call service was cancelled by customer
         - GRP_CHT_CREATED: Group Chat created
         - VHCL_RENT_CANCELLED: Vehicle rent booking was cancelled
*/

CREATE TABLE `plugin_notification` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `group` varchar(60) NOT NULL,
  `payload` text DEFAULT NULL,
  `date_sent` datetime NOT NULL DEFAULT current_timestamp(),
  `date_seen` datetime DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `plugin_notification` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_notification` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;