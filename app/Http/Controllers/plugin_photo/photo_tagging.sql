SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";

CREATE TABLE `photo_tagging` (
  `dataid` int(10) NOT NULL,
  `photo_refid` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagged` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `photo_tagging`
  ADD PRIMARY KEY (`dataid`);

ALTER TABLE `photo_tagging`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
