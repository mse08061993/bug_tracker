<?php
// show_product.php <id>
require_once 'bootstrap.php';

if (empty($argv[1])) {
    die("Pass ID of a required product in the first argument!\n");
}

$id = (int)$argv[1];
$repository = $entityManager->getRepository(Product::class);
$product = $repository->find($id);
if (is_null($product)) {
    die("Trere is no a product with ID $id!\n");
}

echo $product->getName() . "\n";
