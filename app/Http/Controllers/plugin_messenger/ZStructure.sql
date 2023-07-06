/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_message_member.position
                - CUSTOMER: Customer
                - BRCH_ADMN: Branch customer
*/

CREATE TABLE `plugin_message_member` (
  `dataid` int(10) NOT NULL,
  `convo_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `position` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_message_member` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_message_member` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
