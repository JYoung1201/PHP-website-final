<?php

class ShoppingCart {
    private $items = []; // Array to store cart items

    // Add an item to the cart
    public function addItem($productID, $quantity, $price) {
        if (isset($this->items[$productID])) {
            // If item exists, increase the quantity
            $this->items[$productID]['quantity'] += $quantity;
        } else {
            // If item does not exist, add it to the cart
            $this->items[$productID] = [
                'id' => $productID, // Store ProductID for referencing
                'quantity' => $quantity,
                'price' => $price,
            ];
        }
    }

    // Update an item's quantity in the cart
    public function updateItem($productID, $quantity) {
        if (isset($this->items[$productID]) && $quantity > 0) {
            $this->items[$productID]['quantity'] = $quantity; // Update quantity if valid
        } elseif ($quantity <= 0) {
            $this->removeItem($productID); // Remove item if quantity is 0 or less
        }
    }

    // Remove an item from the cart
    public function removeItem($productID) {
        unset($this->items[$productID]); // Remove item from cart
    }

    // Get all items in the cart
    public function getItems() {
        return $this->items; // Return items array
    }

    // Get the total price of the items in the cart
    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity']; // Calculate total
        }
        return $total; // Return total price
    }
}

?>
