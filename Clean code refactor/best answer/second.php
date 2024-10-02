<?php

class Product {
    private string $name;
    private int $price;

    public function __construct(string $name, int $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function display() {
        echo "Product: " . $this->getName() . ", Price: $" . $this->getPrice() . "\n";
    }

    public function applyDiscount(int $discount): int
    {
        if ($discount > 0 && $discount < 100) {
            $discountCalculator = new DiscountCalculator();
            $discountedPrice = $discountCalculator->applyDiscount($discount, $this->getPrice());
            $this->setPrice($discountedPrice);
        } else {
            throw new Exception("The discount value should be between 0 and 100");
        }
    }
}

class DiscountCalculator {
    public function discount(int $discount,int $price): int
    {
        if ($discount > 0 && $discount < 100) {
            $price -= ($price * ($discount / 100));
            return $price;
        } else {
            throw new Exception("Invalid discount value");
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
            $total += $product->getPrice();
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
$firstProduct = new Product("Laptop", 1200);
$secondProduct = new Product("Phone", 800);

$cart = new Cart();
$cart->addProduct($firstProduct);
$cart->addProduct($secondProduct);

$firstProduct->applyDiscount(10);
$cart->checkout();

?>