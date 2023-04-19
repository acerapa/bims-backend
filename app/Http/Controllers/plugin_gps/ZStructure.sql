
/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        obj_type:
                USR: Users
                VHC: Vehicle in any type
                MBL: Mobile device
                PCP: Personal computer 

        obj_refid:
                - The tagged reference id of the tracked user
*/

CREATE TABLE `plugin_gps` (
  `dataid` int(10) NOT NULL,
  `obj_type` varchar(5) CHARACTER SET utf8mb4 NOT NULL,
  `obj_refid` varchar(22) CHARACTER SET utf8mb4 DEFAULT NULL,
  `latitude` varchar(30) CHARACTER SET utf8mb4 NOT NULL DEFAULT current_timestamp(),
  `longitude` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `accuracy` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `speed` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `plugin_gps` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_gps` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;

