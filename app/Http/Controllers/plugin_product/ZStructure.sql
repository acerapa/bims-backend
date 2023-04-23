/*******************************************************************************************
        DATABASE TABLE STRUCTURE
*******************************************************************************************/


/*
plugin_product.category_global_refid
        - Category available around the system
        - GCT: Data Identifier
*/

CREATE TABLE `plugin_product` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_global_refid` varchar(22) DEFAULT NULL,
  `category_menu_refid` varchar(22) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_product_category_global` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_product_category_store` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `store_refid` varchar(22) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_product_discount` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `discount_percent` decimal(10,2) DEFAULT 0.00,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `status` int(3) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_product_inventory` (
  `dataid` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_product_order_item` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `order_refid` varchar(22) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_product_order_placed` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `store_refid` varchar(22) DEFAULT NULL,
  `payment_id` varchar(22) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_product` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_category_global` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_category_store` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_discount` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_inventory` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_order_item` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_order_placed` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_product_category_global` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_product_category_store` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_product_inventory` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_product_order_item` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plugin_product_order_placed` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

