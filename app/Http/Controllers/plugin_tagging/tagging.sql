
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tagging` (
  `dataid` int(10) NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `tagging`
  ADD PRIMARY KEY (`dataid`);


ALTER TABLE `tagging`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;
