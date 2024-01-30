<?php

require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass a new product name in the first argument!\n");
}

$newProductName = $argv[1];

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo "Product with ID " . $product->getId() . " was created!\n";
