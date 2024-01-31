<?php
// dashboard.php <user-id>
require_once "bootstrap.php";

if (empty($argv[1])) {
    die("Pass ID of a required user in the first argument!\n");
}

$userId = (int) $argv[1];

$dql = "
    SELECT b, e, r
    FROM Bug b
        JOIN b.engineer e
        JOIN b.reporter r
    WHERE b.type = 'OPEN' AND (e.id = ?1 OR r.id = ?1)
    ORDER BY b.created DESC
";

$query = $entityManager->createQuery($dql);
$query->setParameter(1, $userId);
$query->setMaxResults(10);

$userBugs = $query->getResult();

echo "You have created or assigned to " . count($userBugs) . " open bugs:\n\n";

foreach ($userBugs as $bug) {
    echo $bug->getId() . " - " . $bug->getDescription() . "\n";
}
