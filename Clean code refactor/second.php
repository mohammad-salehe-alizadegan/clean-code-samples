<?php

class Product {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function display() {
        echo "Product: " . $this->name . ", Price: $" . $this->price . "\n";
    }

    public function applyDiscount($discount) {
        if ($discount > 0 && $discount < 100) {
            $this->price -= ($this->price * ($discount / 100));
        } else {
            echo "Invalid discount value\n";
        }
    }
}

class Cart {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function total() {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->price;
        }
        return $total;
    }

    public function checkout() {
        echo "Checking out with the following products:\n";
        foreach ($this->products as $product) {
            $product->display();
        }
        echo "Total: $" . $this->total() . "\n";
    }
}

// Usage
$product1 = new Product("Laptop", 1200);
$product2 = new Product("Phone", 800);

$cart = new Cart();
$cart->addProduct($product1);
$cart->addProduct($product2);

$product1->applyDiscount(10);
$cart->checkout();

?>