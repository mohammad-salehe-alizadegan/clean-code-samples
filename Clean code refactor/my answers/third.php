<?php

class Order {
    private $items = [];

    public function addItem(Item $item): void {
        $this->items[] = $item;
        
    }

    public function removeItem(Item $item): void {
        foreach ($this->items as $key => $explodedItem) {
            if ($explodedItem->getName() === $item->getName()) {
                $this->totalAmount -= $item->getPrice();
                unset($this->items[$key]);
                return;
            }
        }
        echo "Item not found\n";
    }

    public function getItems(): array
    {
        return $this->items;
    }
}

class Printer {
    public function printReceipt(array $orderItems): string {
        $calculator = new OrderCalculator();
        echo "Receipt:\n";
        $this->printEachItem($orderItems);
        echo "Total Amount: $" . $calculator->calculateTotal($orderItems) . "\n";
    }

    private function printEachItem(array $orderItems): string
    {
        foreach ($orderItems as $key => $item) {
            echo $item->getName() . ": $" . $item->getPrice() . "\n";
        }
    }
}

class OrderCalculator {
    public function calculateTotal(array $items): int {
        $totalAmount = 0;
        foreach ($items as $key => $item) {
            $totalAmount += $item->getPrice();
        }
        return $totalAmount;
    }
}

class Item {
    private $name;
    private $price;

    public function __constructor(string $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}

// Usage
$order = new Order();
$firstItem = new Item("Book", 10);
$secondItem = new Item("Pen", 2);
$order->addItem($firstItem);
$order->addItem($secondItem);
$order->removeItem($secondItem);
$printer = new Printer();
$printer->printReceipt($order->getItems());
?>