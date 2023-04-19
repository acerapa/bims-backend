/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_inquiry_web_form` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(60) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `done` int(3) NOT NULL DEFAULT 0,
  `done_by` varchar(22) DEFAULT NULL,
  `done_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `plugin_inquiry_web_form_tagging` (
  `dataid` int(10) NOT NULL,
  `inquiry_refid` varchar(22) DEFAULT NULL,
  `tag_refid` varchar(22) DEFAULT NULL,
  `recipient` int(3) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `seen_at` datetime DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_inquiry_web_form` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_inquiry_web_form_tagging` ADD PRIMARY KEY (`dataid`);

ALTER TABLE `plugin_inquiry_web_form` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
ALTER TABLE `plugin_inquiry_web_form_tagging` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

