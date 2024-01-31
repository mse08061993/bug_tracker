This is a learning project from this tutorial https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html.
To run the project one should to execute following steps
1) Install PHP 8.0+, MySQL and Composer.
2) Add your database credential to file bootstrap.php
3) Run command "composer install"
4) Run command "php bin/doctrine orm:schema-tool:update --force --dump-sql" to create DB schema.
