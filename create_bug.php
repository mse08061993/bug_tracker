<?php
// create_bug.php <reporter-id> <engineer-id> <product-ids>

require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass a reporter ID in the first argument!\n");
}

if (empty($argv[2])) {
    die("Pass a engineer ID in the first argument!\n");
}

if (empty($argv[3])) {
    die("Pass product IDs in the first argument!\n");
}

$reporterId = (int) $argv[1];
$engineerId = (int) $argv[2];
$productIds = explode(',' ,$argv[3]);

$bug = new Bug();
$bug->setDescription('Something does not work');
$bug->setType('OPEN');
$bug->setCreated(new DateTime('now'));

$userRepository = $entityManager->getRepository(User::class);
$reporter = $userRepository->find($reporterId);
$engineer = $userRepository->find($engineerId);
$bug->setReporter($reporter);
$bug->setEngineer($engineer);

$productRepository = $entityManager->getRepository(Product::class);
foreach ($productIds as $id) {
    $product = $productRepository->find((int)$id);
    $bug->assignToProduct($product);
}

$entityManager->persist($bug);
$entityManager->flush();

echo "Bug with ID " . $bug->getId() . " was created!\n";
