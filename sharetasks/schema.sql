CREATE DATABASE `php_sharetasks` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;


CREATE TABLE `attach_files` (
  `attach_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `file_name` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`attach_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `register_user` varchar(512) COLLATE utf8_bin NOT NULL,
  `register_date` date NOT NULL,
  `assignee` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `target_system` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `title` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `content` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `plan_start_date` date DEFAULT NULL,
  `actual_start_date` date DEFAULT NULL,
  `plan_end_date` date DEFAULT NULL,
  `actual_end_date` date DEFAULT NULL,
  `comment` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `create_user` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_user` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4169 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(512) COLLATE utf8_bin NOT NULL,
  `email` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

