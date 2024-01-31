<?php
//list_bugs_array.php

require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass number of bugs in the first argument!\n");
}

$nubmerOfBugs = (int) $argv[1];
$bugs = $entityManager->getRepository(Bug::class)->getRecentBugsArray($nubmerOfBugs);
foreach ($bugs as $bug) {
    echo $bug['description'] . ' - ' . $bug['created']->format('d.m.Y') . "\n";
    echo "\tReported by " . $bug['reporter']['name'] . "\n";
    echo "\tAssigned to " . $bug['engineer']['name'] . "\n";
    foreach ($bug['products'] as $product) {
        echo "\tPlatform: " . $product['name'] . "\n";
    }
    echo "\n";
}
