/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************  
        plugin_store.order_cost_service_fee  
          - Service of over total order cost in percent
        
        plugin_store.store_type
          - Values:
            FOOD: Food
            GROC: Grocery
            PHAR: Pharmacy
            GDEL: Gadgets and Electronics
            HMAP: Home Appliance
            HWCN: Hardware and Construction Supply

*/



CREATE TABLE `plugin_store` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `store_type` varchar(5) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo_refid_logo` text DEFAULT '[REFID, PATH]',
  `photo_refid_cover` text DEFAULT '[REFID, PATH]',
  `address` text DEFAULT NULL,
  `province_code` varchar(10) DEFAULT NULL,
  `city_code` varchar(10) DEFAULT NULL,
  `brgy_code` varchar(10) DEFAULT NULL,
  `geo_lat` varchar(30) DEFAULT NULL,
  `geo_lng` varchar(30) DEFAULT NULL,
  `order_cost_service_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `review_score` decimal(10,2) NOT NULL DEFAULT 0.00,
  `followers` decimal(10,0) NOT NULL DEFAULT 0,
  `open` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_store` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `reference_id` (`reference_id`);
ALTER TABLE `plugin_store` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


