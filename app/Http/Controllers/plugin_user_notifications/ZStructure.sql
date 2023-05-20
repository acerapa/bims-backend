/*******************************************************************************************
        DATABASE TABLE STRUCTURE
********************************************************************************************
        plugin_user_notifications.icon_code
          - type of notifications
          - [info, error, warning]

        plugin_user_notifications.push_notif_required
          - If 1 push notification is required

        plugin_user_notifications.push_notif_sent
          - Send once, if not seen after 5 minute, resend the push notification.
          - Sent counst default is 0 and add 1 each sent
        
*/

CREATE TABLE `plugin_user_notifications` (
  `dataid` int(10) NOT NULL,
  `user_refid` varchar(22) DEFAULT NULL,
  `icon_code` varchar(15) DEFAULT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `redirect` text DEFAULT NULL,
  `element` text DEFAULT NULL,
  `push_notif_required` int(3) NOT NULL DEFAULT 0,
  `push_notif_sent` int(3) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `seen_at` datetime DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `plugin_user_notifications` ADD PRIMARY KEY (`dataid`);
ALTER TABLE `plugin_user_notifications` MODIFY `dataid` int(10) NOT NULL AUTO_INCREMENT;



