DROP TABLE IF EXISTS `applied_jobs`;
CREATE TABLE `applied_jobs` (
  `user_id` bigint(20) unsigned NOT NULL,
  `job_id` bigint(20) unsigned NOT NULL,
  `date_applied` datetime NOT NULL,
  KEY `aj_uid_idx` (`user_id`),
  KEY `aj_jid_idx` (`job_id`),
  CONSTRAINT `aj_uid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aj_jid` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `owner` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `company_admins`;
CREATE TABLE `company_admins` (
  `user_id` bigint(11) unsigned NOT NULL,
  `company_id` bigint(11) unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  KEY `ca_uid_idx` (`user_id`),
  KEY `ca_cid_idx` (`company_id`),
  CONSTRAINT `ca_cid` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ca_uid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `education_nodes`;
CREATE TABLE `education_nodes` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `school_name` varchar(45) NOT NULL,
  `major` varchar(45) NOT NULL,
  `minor` varchar(45) DEFAULT NULL,
  `degree_type` varchar(45) NOT NULL,
  `gpa` float DEFAULT NULL,
  `date_started` date NOT NULL,
  `date_graduated` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SCHOOL` (`school_name`,`major`,`gpa`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `hr_users`;
CREATE TABLE `hr_users` (
  `user_id` bigint(11) unsigned NOT NULL,
  `company_id` bigint(11) unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  KEY `u_id_idx` (`user_id`),
  KEY `cm_id_idx` (`company_id`),
  CONSTRAINT `cid` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `uid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(11) unsigned NOT NULL,
  `position` varchar(45) NOT NULL,
  `date_created` date NOT NULL,
  `date_expires` date NOT NULL,
  `job_description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `DATE-PERIOD` (`date_created`,`date_expires`),
  KEY `TITLE-COMP` (`company_id`,`position`),
  CONSTRAINT `c_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(11) unsigned NOT NULL,
  `receiver_id` bigint(11) unsigned NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` text NOT NULL,
  `date_sent` date NOT NULL,
  `read` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `relationship`;
CREATE TABLE `relationship` (
  `status` tinyint(4) DEFAULT NULL,
  `user_one_id` int(11) DEFAULT NULL,
  `user_two_id` int(11) DEFAULT NULL,
  `action_user_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_one_id_UNIQUE` (`user_one_id`),
  UNIQUE KEY `user_two_id_UNIQUE` (`user_two_id`),
  KEY `action_user_idx` (`action_user_id`),
  CONSTRAINT `action_user` FOREIGN KEY (`action_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `user_1_id` FOREIGN KEY (`user_one_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `user_2_id` FOREIGN KEY (`user_two_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `user_education_nodes`;
CREATE TABLE `user_education_nodes` (
  `user_id` bigint(11) unsigned NOT NULL,
  `education_node_id` bigint(11) unsigned NOT NULL,
  KEY `uen_uid_idx` (`user_id`),
  KEY `uen_enid_idx` (`education_node_id`),
  CONSTRAINT `uen_enid` FOREIGN KEY (`education_node_id`) REFERENCES `education_nodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `uen_uid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `user_skills`;
CREATE TABLE `user_skills` (
  `user_id` bigint(11) unsigned NOT NULL,
  `skills_id` bigint(11) unsigned NOT NULL,
  KEY `u_id_idx` (`user_id`),
  KEY `s_id_idx` (`skills_id`),
  CONSTRAINT `s_id` FOREIGN KEY (`skills_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `u_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `user_work_nodes`;
CREATE TABLE `user_work_nodes` (
  `user_id` bigint(11) unsigned NOT NULL,
  `work_node_id` bigint(11) unsigned NOT NULL,
  KEY `uwn_uid_idx` (`user_id`),
  KEY `uwn_wnid_idx` (`work_node_id`),
  CONSTRAINT `uwn_uid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `uwn_wnid` FOREIGN KEY (`work_node_id`) REFERENCES `work_nodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `github_username` varchar(45) DEFAULT NULL,
  `auth_token` varchar(45) DEFAULT NULL,
  `description` text,
  `birthday` date NOT NULL,
  `gender` char(1) NOT NULL,
  `street_address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `auth_token_UNIQUE` (`auth_token`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `work_nodes`;
CREATE TABLE `work_nodes` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) NOT NULL,
  `company_id` bigint(11) unsigned DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `description` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `COMPANY` (`company_name`,`position`),
  CONSTRAINT `wn_uid` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;