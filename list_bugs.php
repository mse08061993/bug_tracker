<?php
//list_bugs.php

require_once 'bootstrap.php';

$dql = "
    SELECT b, e, r
    FROM Bug b
        JOIN b.engineer e
        JOIN b.reporter r
    ORDER BY b.created DESC
";

$query = $entityManager->createQuery($dql);
$query->setMaxResults(10);
$bugs = $query->getResult();

foreach ($bugs as $bug) {
    echo $bug->getDescription() . ' - ' . $bug->getCreated()->format('d.m.Y') . "\n";
    echo "\tReported by " . $bug->getReporter()->getName() . "\n";
    echo "\tAssigned to " . $bug->getEngineer()->getName() . "\n";
    foreach ($bug->getProducts() as $product) {
        echo "\tPlatform: " . $product->getName() . "\n";
    }
    echo "\n";
}
