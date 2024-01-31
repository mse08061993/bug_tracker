<?php
//list_bugs_array.php

require_once 'bootstrap.php';

$dql = "
    SELECT b, e, r, p
    FROM Bug b
        JOIN b.engineer e
        JOIN b.reporter r
        JOIN b.products p
    ORDER BY b.created DESC
";

$query = $entityManager->createQuery($dql);
$query->setMaxResults(10);
$bugs = $query->getArrayResult();

foreach ($bugs as $bug) {
    echo $bug['description'] . ' - ' . $bug['created']->format('d.m.Y') . "\n";
    echo "\tReported by " . $bug['reporter']['name'] . "\n";
    echo "\tAssigned to " . $bug['engineer']['name'] . "\n";
    foreach ($bug['products'] as $product) {
        echo "\tPlatform: " . $product['name'] . "\n";
    }
    echo "\n";
}
