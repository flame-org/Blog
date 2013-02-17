# Flame:Blog

Fast and simple blog for everyone (especially for programmers :-))

**Based on [Flame](https://github.com/flame-org/Framework), Nette frameworks and Doctrine 2**

## Features
* Posts management (create, edit, delete, count of views)
* Markdown syntax for posts
* Posts paginator
* Comments powered by Disqus
* Post sharing on Twitter, Facebook, Google+
* Global settings and options
* User management
* RSS feed control

## Instalation
1. Download or clone this repo

	`git clone git://github.com/flame-org/Blog.git`

2. Install dependencies (change directory to blog)

	`cd Blog && composer update`

3. Create database schema

	`php app/doctrine-cli.php orm:schema-tool:update --force`

4. Import default database data

	`php app/doctrine-cli.php dbal:import data/db.sql`

5. Make dirs log and temp writable

	`chmod -R 777 log/ && chmod -R 777 temp/`

6. Run blog

	`e.g.: blog.lc`

### Instalation is complete

**Created defautl user for login**

 Email: user@demo.com
 Password: password12


#### Available settings

	projectName, projectDesc, seoKeywords, seoDescription, defaultTitle, alllowComments, alllowSharing, disqusKey, itemsPerPage