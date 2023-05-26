/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_order_item.status
          0: Newly added to the cart
          1: Placed items
          2: Cancelled by customer
          3: Seen by store
          4: Accepted by store
          5: Refused by store
        
        plugin_order_item.add_ons_array
          [
            {
              name: '',
              price: '',
              photo: []
            },
            {
              name: '',
              price: '',
              photo: []
            }
          ]
*/

CREATE TABLE `plugin_order_item` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `order_placed_refid` varchar(22) DEFAULT NULL,
  `product_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `store_refid` varchar(22) DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `variant_info` text DEFAULT NULL,
  `add_ons_array` text DEFAULT NULL,
  `add_ons_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_order_item` ADD PRIMARY KEY (`dataid`), ADD UNIQUE KEY `reference_id` (`reference_id`);
ALTER TABLE `plugin_order_item` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

