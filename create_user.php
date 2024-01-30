<?php
// create_user.php <name>

require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass a new user name in the first argument!\n");
}

$newUserName = $argv[1];

$user = new User();
$user->setName($newUserName);

$entityManager->persist($user);
$entityManager->flush();

echo "User with ID " . $user->getId() . " was created!\n";
