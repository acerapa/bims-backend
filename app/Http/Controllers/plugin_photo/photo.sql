
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";

CREATE TABLE `photo` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tagged` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `photo`
  ADD PRIMARY KEY (`dataid`);

ALTER TABLE `photo`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

