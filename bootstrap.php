<?php

use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/vendor/autoload.php';

$configuration = ORMSetup::createAttributeMetadataConfiguration(paths: [__DIR__ . '/src'], isDevMode: true);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'user' => 'sergey',
    'password' => 'ks2905',
    'dbname' => 'bug_tracker',
]);

$entityManager = new EntityManager($connection, $configuration);
