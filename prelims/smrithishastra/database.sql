CREATE TABLE IF NOT EXISTS `questions` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 `text` mediumtext NOT NULL,
 `answer` int(11) unsigned NOT NULL DEFAULT '0',
`mark` int(11) unsigned NOT NULL DEFAULT '0',
`n_mark` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `options` (
  `option_id` tinyint(4) NOT NULL DEFAULT '0',
  `question_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `option_text` text NOT NULL,
   KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `answers` (
  `option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `question_id` tinyint(4) NOT NULL DEFAULT '0',
  `contestant_id` mediumint(8) unsigned NOT NULL DEFAULT '0',  
  KEY `option_id` (`option_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `contestants` (
  `id` bigint(8) NOT NULL auto_increment,
  `member_1` varchar(220) NOT NULL default '',
  `member_2` varchar(220) NOT NULL default '',
  `team_name` varchar(200) NOT NULL default '',
 `password` varchar(200) NOT NULL default '',
 `marks` int(81) unsigned NOT NULL DEFAULT '0',
 `contact` varchar(200) NOT NULL default '',
 `finish` int(81) unsigned NOT NULL DEFAULT '0',
`time` varchar(220) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

