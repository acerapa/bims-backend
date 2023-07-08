/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_vehicle_rent_vehicles.group
          - EBIKE: EBike
          - MTRCL: Motorcycle
          - MLTCB: Multicab
          - PRVAN: Van
          - MNVAN: Mini-Van

        plugin_vehicle_rent_vehicles.photos
          [
            {
              photo_refid: '',
              photo_link: ''
            }
          ]
        plugin_vehicle_rent_vehicles.fuel_type
          - Unleaded 
          - Diesel 
          - Kerosene 
          - Gas

        plugin_vehicle_rent_vehicles.seats

        plugin_vehicle_rent_vehicles.gear_lever
          MNL: Manual
          AUT: Automatic
*/


CREATE TABLE `plugin_vehicle_rent_vehicles` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `branch_refid` varchar(22) DEFAULT NULL,
  `group` varchar(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `fuel_type` varchar(15) NOT NULL DEFAULT '0',
  `seats` int(3) NOT NULL DEFAULT 0,
  `gear_lever` int(3) DEFAULT NULL,
  `photos` text DEFAULT NULL,
  `price_base` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `driver_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `insured` int(3) DEFAULT 0,
  `city_code` varchar(22) DEFAULT NULL,
  `owner_refid` varchar(22) DEFAULT NULL,
  `available` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_vehicle_rent_vehicles` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_vehicle_rent_vehicles` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
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
