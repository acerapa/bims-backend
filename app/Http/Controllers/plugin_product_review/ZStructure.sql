/*******************************************************************************************
        DATABASE TABLE STRUCTURE
*******************************************************************************************
        plugin_product_review.photos
          - List of photos posted by reviewer
          - [
              {
                photo_refid: '',
                filepath: '
              },
              {
                photo_refid: '',
                filepath: '
              }
            ]

*/

CREATE TABLE `plugin_product_review` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `product_refid` varchar(22) DEFAULT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `score` int(3) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `photos` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_product_review` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_product_review` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

