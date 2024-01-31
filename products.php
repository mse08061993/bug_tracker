<?php
//products.php

require_once 'bootstrap.php';

$productBugs = $entityManager->getRepository(Bug::class)->getOpenBugsByProduct();

foreach ($productBugs as $productBug) {
    echo "Product " . $productBug['name'] . " has " . $productBug['openBugs'] . " open bugs.\n";
}
