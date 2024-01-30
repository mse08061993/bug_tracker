<?php
// list_products.php

require_once 'bootstrap.php';

$productRepository = $entityManager->getRepository(Product::class);
$products = $productRepository->findAll();
foreach ($products as $product) {
    echo $product->getName() . "\n";
}
