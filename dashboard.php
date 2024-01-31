<?php
// dashboard.php <user-id> <number-of-bugs>
require_once "bootstrap.php";

if (empty($argv[1])) {
    die("Pass ID of a required user in the first argument!\n");
}

if (empty($argv[2])) {
    die("Pass number of bugs in the second argument!\n");
}

$userId = (int) $argv[1];
$bugsNumber = (int) $argv[2];

$userBugs = $entityManager->getRepository(Bug::class)->getUsersBugs($userId, $bugsNumber);

echo "You have created or assigned to " . count($userBugs) . " open bugs:\n\n";

foreach ($userBugs as $bug) {
    echo $bug->getId() . " - " . $bug->getDescription() . "\n";
}
