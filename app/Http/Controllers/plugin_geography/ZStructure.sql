/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        
*/

CREATE TABLE `plugin_geo_brgy` (
  `id` int(11) NOT NULL,
  `brgyCode` varchar(255) DEFAULT NULL,
  `brgyDesc` text DEFAULT NULL,
  `regCode` varchar(255) DEFAULT NULL,
  `provCode` varchar(255) DEFAULT NULL,
  `citymunCode` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT 1 COMMENT '1:Visible 2:Hidden'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `plugin_geo_brgy` ADD PRIMARY KEY (`id`);
ALTER TABLE `plugin_geo_brgy` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `plugin_geo_citymun` (
  `id` int(255) NOT NULL,
  `psgcCode` varchar(255) DEFAULT NULL,
  `citymunDesc` text DEFAULT NULL,
  `regDesc` varchar(255) DEFAULT NULL,
  `provCode` varchar(255) DEFAULT NULL,
  `citymunCode` varchar(255) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '1:Visible 2:Hidden'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `plugin_geo_citymun` ADD PRIMARY KEY (`id`);
ALTER TABLE `plugin_geo_citymun` MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `plugin_geo_province` (
  `id` int(11) NOT NULL,
  `psgcCode` varchar(255) DEFAULT NULL,
  `provDesc` text DEFAULT NULL,
  `regCode` varchar(255) DEFAULT NULL,
  `provCode` varchar(255) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '1:Visible 2:Hidden'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `plugin_geo_province` ADD PRIMARY KEY (`id`);
ALTER TABLE `plugin_geo_province` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `plugin_geo_region` (
  `id` int(11) NOT NULL,
  `psgcCode` varchar(255) DEFAULT NULL,
  `regDesc` text DEFAULT NULL,
  `regCode` varchar(255) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1 COMMENT '1:Visible 2:Hidden'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `plugin_geo_region` ADD PRIMARY KEY (`id`);
ALTER TABLE `plugin_geo_region` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
