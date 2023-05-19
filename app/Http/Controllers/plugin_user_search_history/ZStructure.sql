/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_user_personalize.click_count_me
          - Number of click made by creator
        
        plugin_user_personalize.click_count_others
          - Number of click made by other users in the system
*/

CREATE TABLE `plugin_user_search_history` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `click_count_me` int(10) NOT NULL DEFAULT 1,
  `click_count_others` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_user_search_history` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_search_history` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

