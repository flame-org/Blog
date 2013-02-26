-- Adminer 3.6.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `Post` (`id`, `title`, `content`, `date`, `views`, `public`) VALUES
(1,	'Flame:Blog',	'Fast and simple blog for everyone (especially for programmers :-))\r\n\r\n**Based on [Flame](https://github.com/flame-org/Framework), Nette frameworks and Doctrine 2**\r\n\r\nIf you want to see Flame:Blog in live, please visit [http://blog.jsifalda.name/](http://blog.jsifalda.name/) or [http://tales.jsifalda.name/](http://tales.jsifalda.name/)\r\n\r\n## Features\r\n* Posts management (create, edit, delete, count of views)\r\n* Markdown syntax for posts\r\n* Posts paginator\r\n* Comments powered by Disqus\r\n* Post sharing on Twitter, Facebook, Google+\r\n* Global settings and options\r\n* User management\r\n* RSS feed control\r\n* Wordpress posts importer\r\n\r\n## Instalation\r\n1. Download or clone this repo\r\n\r\n	`git clone git://github.com/flame-org/Blog.git`\r\n\r\n2. Install dependencies (change directory to blog)\r\n\r\n	`cd Blog && composer install --dev`\r\n\r\n3. Setup database config\r\n * Create app/AppBundle/config/config.dev.neon\r\n * Copy content with your configurations, e.g:\r\n\r\n ```\r\n 	parameters:\r\n    	database:\r\n    		host: localhost\r\n    		dbname: bl\r\n    		user: root\r\n    		password: root\r\n ```\r\n\r\n4. Create database schema\r\n\r\n	`php app/doctrine-cli.php orm:schema-tool:update --force`\r\n\r\n5. Import default database data\r\n\r\n	`php app/doctrine-cli.php dbal:import data/default.sql`\r\n\r\n6. Make dirs log and temp writable\r\n\r\n	`chmod -R 777 log/ && chmod -R 777 temp/`\r\n\r\n7. Run blog\r\n\r\n	`e.g.: blog.lc`\r\n\r\n### Instalation is complete\r\n\r\n**Created defautl user for login**\r\n\r\n Email: user@demo.com\r\n Password: password12\r\n\r\n\r\n#### Available settings\r\n\r\n	projectName, projectDesc, seoKeywords, seoDescription, alllowComments, alllowSharing, disqusKey, itemsPerPage',	'2013-02-26 21:30:27',	0,	1);

INSERT INTO `Setting` (`id`, `type`, `name`, `value`) VALUES
(1,	1,	'projectName',	'Flame:Blog'),
(2,	1,	'projectDesc',	'Blog for everyone'),
(3,	1,	'seoKeywords',	''),
(4,	1,	'seoDescription',	''),
(5,	3,	'alllowComments',	''),
(6,	3,	'alllowSharing',	''),
(7,	1,	'disqusKey',	''),
(8,	1,	'itemsPerPage',	''),
(9,	1,	'maxRssItems',	'');

INSERT INTO `User` (`id`, `email`, `password`, `passwordSalt`) VALUES
(1,	'user@demo.com',	'74302bcd3c966c61f31b0a9b7e6c4536bb51c22c763c8969c06cdc91a8fff73ca38c40bf577029fe179a2bb3b259370a62f262936415169cea9d848221011ade',	'8p1hr');

-- 2013-02-26 21:31:28