<?php
require 'classes/Product.php';
require 'classes/Cart.php';

$cart = new Cart();

$product1 = new Product('Product 1', 100, 2);
$product2 = new Product('Product 2', 200, 1);

$cart->addProduct($product1);
$cart->addProduct($product2);

echo $cart;
