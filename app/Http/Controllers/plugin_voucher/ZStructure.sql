
/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_voucher.creator_type
         - Values for foxcity: [STR for store, FXC for Foxcity]

        plugin_voucher.min_order_cost
         - The minimum order cost if zero (0), it means no minimum order required

        plugin_voucher.voucher_type
         - Values for foxcity: [FREE_DEL, LESS_PERCENT, LESS_AMOUNT]

        plugin_voucher.voucher_label
         - Visible name of the voucher
        
        plugin_voucher.status
          1: New voucher posted
          2: Claimed voucher
          3: Used voucher
          4: Unused expired voucher
        
*/

CREATE TABLE `plugin_voucher` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `copy_num` int(10) NOT NULL DEFAULT 0,
  `copy_group_refid` varchar(22) DEFAULT NULL,
  `creator_type` varchar(22) DEFAULT NULL,
  `creator_refid` varchar(22) DEFAULT NULL,
  `min_order_cost` decimal(10,2) DEFAULT NULL,
  `voucher_type` varchar(22) DEFAULT NULL,
  `voucher_label` varchar(100) DEFAULT NULL,
  `voucher_value` decimal(10,2) DEFAULT 0.00,
  `valid_from` datetime DEFAULT NULL,
  `valid_until` datetime DEFAULT NULL,
  `claim_user_refid` varchar(22) DEFAULT NULL,
  `claim_date` datetime DEFAULT NULL,
  `claim_used_date` datetime DEFAULT NULL,
  `created_by` varchar(22) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_voucher` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_voucher` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;