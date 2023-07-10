/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_vehicle_rent_booking.driver
          SD: Self Drive
          ID: Include Driver

        plugin_vehicle_rent_booking.status
          1: New
          2: Cancelled by customer
          3: Accepted
          4: Done

*/

CREATE TABLE `plugin_vehicle_rent_booking` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `branch_refid` varchar(22) DEFAULT NULL,
  `vehicle_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `rent_from` date DEFAULT NULL,
  `rent_to` date DEFAULT NULL,
  `price_base` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price_charged` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_fee_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `days` int(3) NOT NULL DEFAULT 0,
  `driver` varchar(3) DEFAULT NULL,
  `driver_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `message` text DEFAULT NULL,
  `convo_refid` varchar(22) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_vehicle_rent_booking` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_vehicle_rent_booking` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
