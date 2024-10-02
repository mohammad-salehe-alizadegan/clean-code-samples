<?php

class Order {
    private $items = [];

    public function addItem(string $name, int $price): void {
        $item = new Item($name, $price);
        $this->items[] = $item;
    }

    public function removeItem(string $itemName): bool {
        foreach ($this->items as $key => $item) {
            if ($item->getName() === $itemName) {
                unset($this->items[$key]);
                return true; // Item removed successfully
            }
        }
        return false; // Item not found
    }

    public function getItems(): array
    {
        return $this->items;
    }
}

class Printer {
    public function printReceipt(array $orderItems): string {
        $receipt = "Receipt:\n";
        foreach ($orderItems as $item) {
            $receipt .= $item->getName() . ": $" . $item->getPrice() . "\n";
        }
        $receipt .= "Total Amount: $" . (new OrderCalculator())->calculateTotal($orderItems) . "\n";
        return $receipt;
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

    public function setPrice(int $price): void {
        if ($price < 0) {
            throw new InvalidArgumentException("Price cannot be negative.");
        }
        $this->price = $price;
    }
}

// Usage
$order = new Order();
$order->addItem("Book", 10);
$order->addItem("Pen", 2);
$order->removeItem("Pen");
$printer = new Printer();
$printer->printReceipt($order->getItems());
?>