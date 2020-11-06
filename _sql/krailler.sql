#
# Encoding: Unicode (UTF-8)
#


CREATE TABLE `peel_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_page_id` int(11) DEFAULT '0',
  `content_element_id` int(11) DEFAULT '0',
  `content_created` datetime DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `peel_elements` (
  `elemetns_id` int(11) NOT NULL AUTO_INCREMENT,
  `elements_name` varchar(254) DEFAULT NULL,
  `elements_slug` varchar(254) DEFAULT NULL,
  `elements_page_id` int(11) DEFAULT '0',
  `elements_created` datetime DEFAULT NULL,
  PRIMARY KEY (`elemetns_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `peel_pages` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `pages_title` varchar(254) DEFAULT NULL,
  `pages_slug` varchar(254) DEFAULT NULL,
  `pages_multiple` int(1) DEFAULT '0',
  `pages_order` int(11) DEFAULT '0',
  `pages_deleted` int(1) DEFAULT '0',
  `pages_created` datetime DEFAULT NULL,
  PRIMARY KEY (`pages_id`),
  UNIQUE KEY `pages_title` (`pages_title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


CREATE TABLE `peel_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_email` varchar(128) DEFAULT NULL,
  `users_password` text,
  `users_role` varchar(32) DEFAULT NULL,
  `users_deletable` int(1) DEFAULT '0',
  `users_description` text,
  `users_created` datetime DEFAULT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `users_email` (`users_email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS = 0;






INSERT INTO `peel_pages` (`pages_id`, `pages_title`, `pages_slug`, `pages_multiple`, `pages_order`, `pages_deleted`, `pages_created`) VALUES (1, 'Projects', 'projects', 1, 1, 0, '2014-02-26 00:00:00'), (2, 'About', 'about', 1, 2, 0, '2014-02-26 00:00:00'), (3, 'Contact', 'contact', 1, 3, 0, '2014-02-26 00:00:00');


INSERT INTO `peel_users` (`users_id`, `users_email`, `users_password`, `users_role`, `users_deletable`, `users_description`, `users_created`) VALUES (1, 'dl@tedra.net', '1da308814fe7c18d765cefeb292d31cc', 'admin', 0, NULL, '2014-02-10 00:00:00'), (3, 'lloyd@domh.net', NULL, 'admin', 0, NULL, '2014-02-26 00:00:00');




SET FOREIGN_KEY_CHECKS = 1;


