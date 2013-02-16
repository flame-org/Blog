-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `bl_post`;
CREATE TABLE `bl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bl_post` (`id`, `title`, `content`, `date`, `views`, `public`) VALUES
(1,	'Flame:Blog',	'Fast and simple blog for everyone (especially for programmers :-))\r\n\r\n**Based on [Flame](https://github.com/flame-org/Framework), Nette frameworks and Doctrine 2**\r\n\r\n## Features\r\n* Posts management (create, edit, delete, count of views), Markdown syntax\r\n* Comments powered by Disqus\r\n* Post sharing on Twitter, Facebook, Google+\r\n* Global settings and options\r\n* User management\r\n\r\n## Instalation\r\n1. Download or clone this repo\r\n\r\n	`git clone git://github.com/flame-org/Blog.git`\r\n\r\n2. Install dependencies (change directory to blog)\r\n\r\n	`cd Blog && composer update`\r\n\r\n3. Create database schema\r\n\r\n	`php app/doctrine-cli.php orm:schema-tool:update --force`\r\n\r\n4. Import default database data\r\n\r\n	`php app/doctrine-cli.php dbal:import data/db.sql`\r\n\r\n5. Make dirs log and temp writable\r\n\r\n	`chmod -R 777 log/ && chmod -R 777 temp/`\r\n\r\n6. Run blog\r\n\r\n	`e.g.: blog.lc`\r\n\r\n### Instalation is complete\r\n\r\n**Created defautl user for login**\r\n\r\n Email: user@demo.com\r\n Password: password12',	'2013-02-16 21:29:05',	0,	1);

DROP TABLE IF EXISTS `bl_setting`;
CREATE TABLE `bl_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bl_setting` (`id`, `type`, `name`, `value`) VALUES
(1,	1,	'projectName',	'Flame:Blog'),
(2,	1,	'projectDesc',	'Blog for everyone'),
(3,	1,	'seoKeywords',	''),
(4,	1,	'seoDescription',	''),
(5,	1,	'defaultTitle',	'Flame:Blog'),
(6,	3,	'alllowComments',	''),
(7,	3,	'alllowSharing',	''),
(8,	1,	'disqusKey',	'');

DROP TABLE IF EXISTS `bl_user`;
CREATE TABLE `bl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password_salt` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E8E71CDCE7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bl_user` (`id`, `email`, `password`, `password_salt`) VALUES
(1,	'user@demo.com',	'74302bcd3c966c61f31b0a9b7e6c4536bb51c22c763c8969c06cdc91a8fff73ca38c40bf577029fe179a2bb3b259370a62f262936415169cea9d848221011ade',	'8p1hr');

-- 2013-02-16 21:29:33
