
/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_oncall_service_providers.service

*/

CREATE TABLE `plugin_oncall_service_providers` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) NOT NULL,
  `branch_refid` varchar(22) DEFAULT NULL,
  `city_code` varchar(22) DEFAULT NULL,
  `fname` varchar(60) DEFAULT NULL,
  `lname` varchar(60) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `service` varchar(6) DEFAULT NULL,
  `service_description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `available` int(1) NOT NULL DEFAULT 0,
  `review_score` decimal(10,1) NOT NULL DEFAULT 0.0,
  `recommended` int(1) NOT NULL DEFAULT 0,
  `profile_photo` text DEFAULT NULL,
  `cover_photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_oncall_service_providers` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_oncall_service_providers` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
