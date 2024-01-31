<?php
//products.php
ignore_user_abort(true);
require_once 'bootstrap.php';

$dql = "
    SELECT p.id, p.name, COUNT(b.id) as openBugs
    FROM Bug b
        JOIN b.products p
    WHERE b.type = 'OPEN'
    GROUP BY p.id
";

$query = $entityManager->createQuery($dql);
$productBugs = $query->getScalarResult();

foreach ($productBugs as $productBug) {
    echo "Product " . $productBug['name'] . " has " . $productBug['openBugs'] . " open bugs.\n";
}
