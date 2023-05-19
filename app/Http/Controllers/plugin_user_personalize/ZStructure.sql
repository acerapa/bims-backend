/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_user_personalize.theme_mode
          - Values: [ light, dark]
*/

CREATE TABLE `plugin_user_personalize` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `theme_mode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_user_personalize` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_personalize` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;


