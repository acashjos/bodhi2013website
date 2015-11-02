SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `deadlock_counter` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `total_users` int(11) DEFAULT NULL,
  `total_levels` int(11) DEFAULT NULL,
  `total_attempts` bigint(20) DEFAULT NULL,
  `total_hits` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  CHARACTER SET utf8 COLLATE utf8_bin AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `deadlock_levels` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `question` text,
  `pic_name` varchar(100) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `direct_clues` text,
  `page_source_clues` text,
  `people_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM   CHARACTER SET utf8 COLLATE utf8_bin AUTO_INCREMENT=26 ;



CREATE TABLE IF NOT EXISTS `deadlock_profile` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `current_level` int(11) DEFAULT NULL,
  `last_level_clearence_time` datetime DEFAULT NULL,
  `attempts` bigint(20) DEFAULT '0',
  `each_level_attempts` varchar(255) DEFAULT NULL,
  `each_level_completion_time` text,
  `oauth_provider` varchar(10), 
  `facebook_key` text,
  `csrs_key` varchar(8) DEFAULT NULL,
  `image_captcha` varchar(4) DEFAULT NULL,
  `cookie_key` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM   CHARACTER SET utf8 COLLATE utf8_bin AUTO_INCREMENT=268 ;