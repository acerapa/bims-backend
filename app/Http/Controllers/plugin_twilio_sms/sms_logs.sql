
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `sms_logs` (
  `dataid` int(10) NOT NULL,
  `sender_number` varchar(22) DEFAULT NULL,
  `sender_name` varchar(60) DEFAULT NULL,
  `recepient_number` varchar(22) DEFAULT NULL,
  `recepient_name` varchar(60) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`dataid`);

ALTER TABLE `sms_logs`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;
