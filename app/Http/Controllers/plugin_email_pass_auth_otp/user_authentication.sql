
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user_authentication` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` int(3) NOT NULL DEFAULT 0 COMMENT '0: Unverified \r\n1: Verified',
  `user_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_credential` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_credential` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_login` datetime DEFAULT NULL,
  `date_logout` datetime DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `user_authentication`
  ADD PRIMARY KEY (`dataid`),
  ADD UNIQUE KEY `reference_id` (`reference_id`);

ALTER TABLE `user_authentication`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

