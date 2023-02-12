
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `user` (
  `dataid` int(10) NOT NULL,
  `reference_id` varchar(22) DEFAULT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(22) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`dataid`, `reference_id`, `firstname`, `lastname`, `mobile`, `email`, `password`, `photo`, `created_at`, `created_by`, `status`) VALUES
(1, 'USR-12302022065909-VWP', 'Jason', 'Lipreso', '639353152023', 'jasonlipreso@gmail.com', 'rylle161710', NULL, '2022-12-30 18:57:29', 'USR-12302022065909-VWP', '1'),
(2, 'USR-12302022065918-5T8', 'Tresha', 'Casonggay', '639353152022', 'treshacasonggay@gmail.com', 'admin123', NULL, '2022-12-30 18:57:29', 'USR-12302022065909-VWP', '1');

ALTER TABLE `user`
  ADD PRIMARY KEY (`dataid`);

ALTER TABLE `user`
  MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

