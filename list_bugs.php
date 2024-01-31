<?php
//list_bugs.php <number of bugs>

require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass number of bugs in the first argument!\n");
}

$nubmerOfBugs = (int) $argv[1];
$bugs = $entityManager->getRepository(Bug::class)->getRecentBugs($nubmerOfBugs);
foreach ($bugs as $bug) {
    echo $bug->getDescription() . ' - ' . $bug->getCreated()->format('d.m.Y') . "\n";
    echo "\tReported by " . $bug->getReporter()->getName() . "\n";
    echo "\tAssigned to " . $bug->getEngineer()->getName() . "\n";
    foreach ($bug->getProducts() as $product) {
        echo "\tPlatform: " . $product->getName() . "\n";
    }
    echo "\n";
}
