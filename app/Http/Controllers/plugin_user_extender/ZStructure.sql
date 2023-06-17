/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_user_extender.name
            - user_firebase_token: Firebase token per user
        
*/

CREATE TABLE `plugin_user_extender` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `name` varchar(22) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_user_extender` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_extender` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

