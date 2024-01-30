<?php
// update_product.php <id> <new_product_name>
require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass ID of a required product in the first argument!\n");
}

if (empty($argv[2])) {
    die("Pass a new product in the second argument!\n");
}

$id = (int)$argv[1];
$repository = $entityManager->getRepository(Product::class);
$product = $repository->find($id);
if (is_null($product)) {
    die("Trere is no a product with ID $id!\n");
}

$newProductName = $argv[2];
$product->setName($newProductName);

$entityManager->flush();
