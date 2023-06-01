/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_order_placed.status values:
          1: Newly posted
          2: Cancelled by customer
          3: Seen by store
          4: Accepted by store
          5: Refused by store

        plugin_order_placed.delivery_method values:
          CPU: Customer Pick-up
          FDR: Foxcity Delivery Rider
          DRN: Drone Delivery
               
*/

CREATE TABLE `plugin_order_placed` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `store_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `user_address_refid` varchar(22) DEFAULT NULL,
  `delivery_method` varchar(6) DEFAULT NULL,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `distance_matrix` text DEFAULT NULL,
  `distance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `store_seen` datetime DEFAULT NULL,
  `store_accepted` datetime DEFAULT NULL,
  `store_refused` datetime DEFAULT NULL,
  `store_refused_reason` text DEFAULT NULL,
  `rider_refid` varchar(22) DEFAULT NULL,
  `convo_refid` varchar(22) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_order_placed` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_order_placed` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

