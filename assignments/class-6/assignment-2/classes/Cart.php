<?php

class Cart
{
    private $products;

    public function __construct()
    {
        $this->products = [];
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function removeProduct(Product $product)
    {
        $key = array_search($product, $this->products);
        if ($key !== false) {
            unset($this->products[$key]);
        }
    }

    public function getTotal()
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->getPrice() * $product->getQuantity();
        }
        return $totalPrice;
    }

    public function __toString()
    {
        $output = 'Products in cart: <br>';
        foreach ($this->products as $product) {
            $output .= $product . '<br>';
        }
        $output .= 'Total: ' . $this->getTotal();
        return $output;
    }
}
