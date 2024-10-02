<?php

class Order {
    public $items = [];
    public $totalAmount = 0;

    public function addItem($item, $price) {
        $this->items[] = ['item' => $item, 'price' => $price];
        $this->totalAmount += $price;
    }

    public function removeItem($item) {
        foreach ($this->items as $key => $value) {
            if ($value['item'] === $item) {
                $this->totalAmount -= $value['price'];
                unset($this->items[$key]);
                return;
            }
        }
        echo "Item not found\n";
    }

    public function calculateTotal() {
        return $this->totalAmount;
    }

    public function printReceipt() {
        echo "Receipt:\n";
        foreach ($this->items as $value) {
            echo $value['item'] . ": $" . $value['price'] . "\n";
        }
        echo "Total Amount: $" . $this->calculateTotal() . "\n";
    }
}

// Usage
$order = new Order();
$order->addItem("Book", 10);
$order->addItem("Pen", 2);
$order->removeItem("Pen");
$order->printReceipt();

?>