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
*/


CREATE TABLE `plugin_vehicle_rent_vehicles` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `group` varchar(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photos` text DEFAULT NULL,
  `owner_refid` varchar(22) DEFAULT NULL,
  `available` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_vehicle_rent_vehicles` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_vehicle_rent_vehicles` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

