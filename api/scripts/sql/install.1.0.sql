CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(80) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`slug`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `excerpt` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` int(11) NOT NULL,
  `category2` int(11) DEFAULT NULL,
  `license` int(11) DEFAULT NULL,
  `license2` int(11) DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8 NOT NULL,
  `repository` varchar(255) CHARACTER SET utf8 NOT NULL,
  `twitter` varchar(80) CHARACTER SET utf8 NOT NULL,
  `stats` varchar(80) CHARACTER SET utf8 NOT NULL,
  `sample` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `excerpt` (`excerpt`),
  KEY `category` (`category`,`category2`),
  KEY `license` (`license`,`license2`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
