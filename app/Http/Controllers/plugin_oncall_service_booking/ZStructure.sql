/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_oncall_service_booking.status
          1: New
          2: Cancelled by customer
          3: Cancelled by admin
          4: Accepted
          5: Worked Done (Automatic at 11:00 PM)
          6: 

*/

CREATE TABLE `plugin_oncall_service_booking` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `convo_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `provider_refid` varchar(22) DEFAULT NULL,
  `branch_refid` varchar(22) DEFAULT NULL,
  `city_code` varchar(22) DEFAULT NULL,
  `service_type` varchar(6) DEFAULT NULL,
  `contact_person` varchar(80) DEFAULT NULL,
  `contact_number` varchar(60) DEFAULT NULL,
  `work_date` date DEFAULT NULL,
  `work_time` time DEFAULT NULL,
  `work_description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `provider_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `foxcity_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `days` int(3) NOT NULL DEFAULT 1,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_oncall_service_booking` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

