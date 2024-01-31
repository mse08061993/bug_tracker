<?php
// close_bug.php <id>
require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass ID of a required bug in the first argument!\n");
}

$id = (int)$argv[1];
$bug = $entityManager->find(Bug::class, $id);
if (is_null($bug)) {
    die("Bug with ID $id doesn't exist!\n");
}
$bug->setType('CLOSE');

$entityManager->flush();
