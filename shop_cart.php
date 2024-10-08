<?php
session_start();
require 'global/db.php'; // Make sure your database connection is included

class ShoppingCart {
    private $items = []; // Array to hold cart items

    public function addItem($id, $quantity, $price) {
        // Check if the item is already in the cart
        if (isset($this->items[$id])) {
            // If so, update the quantity
            $this->items[$id]['quantity'] += $quantity;
        } else {
            // Otherwise, add the new item
            $this->items[$id] = ['id' => $id, 'quantity' => $quantity, 'price' => $price]; // Store id as well
        }
    }

    public function updateItem($id, $quantity) {
        // Update the item quantity if it exists in the cart
        if (isset($this->items[$id])) {
            if ($quantity > 0) {
                $this->items[$id]['quantity'] = $quantity;
            } else {
                $this->removeItem($id); // Remove the item if quantity is 0
            }
        }
    }

    public function removeItem($id) {
        // Remove the item from the cart
        unset($this->items[$id]);
    }

    public function getItems() {
        // Return the items in the cart
        return $this->items;
    }

    public function getTotal() {
        // Calculate the total price of all items in the cart
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}

// Initialize shopping cart if it doesn't exist
if (!isset($_SESSION['cart']) || !($_SESSION['cart'] instanceof ShoppingCart)) {
    $_SESSION['cart'] = new ShoppingCart();
}

$cart = $_SESSION['cart']; // Access the shopping cart

// Handle cart actions: add, update, remove
if (isset($_GET['action'])) {
    $productID = isset($_GET['id']) ? intval($_GET['id']) : 0; // Ensure valid product ID
    $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1; // Default to 1

    if ($productID > 0) {
        // Fetch the price from the database
        $stmt = $pdo->prepare("SELECT UnitPrice FROM Products WHERE ProductID = ?");
        $stmt->execute([$productID]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch associative array

        if ($product) {
            $price = $product['UnitPrice']; // Get product price

            switch ($_GET['action']) {
                case 'add':
                    $cart->addItem($productID, $quantity, $price); // Add item to cart
                    break;
                case 'update':
                    $cart->updateItem($productID, $quantity); // Update quantity
                    break;
                case 'remove':
                    $cart->removeItem($productID); // Remove item from cart
                    break;
            }
        } else {
            echo "Product not found!"; // Debugging line
        }
    }

    // Redirect to avoid reprocessing the form
    header("Location: shop_cart.php"); // Redirect back to the same page
    exit();
}

// Display cart contents
$cartItems = $cart->getItems(); // Get items from the cart
$total = $cart->getTotal(); // Calculate total price
$taxRate = 0.08; // Example tax rate of 8%

include 'global/header.php';
include 'global/menu.php';

// Query to fetch product details along with stock
$stmt = $pdo->query("
    SELECT 
        p.ProductID, 
        p.ProductName, 
        p.ProductDescription, 
        p.UnitPrice, 
        i.QuantityInStock,
        p.ImageURL 
    FROM 
        Products p 
    JOIN 
        Inventory i ON p.ProductID = i.ProductID
");

// Display the products
echo "<h1>Product Catalog</h1>";
echo "<div class='product-catalog' style='display: flex; flex-wrap: wrap;'>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='product-item' style='margin: 15px; border: 1px solid #ccc; padding: 10px; width: 150px; text-align: center;'>";

    // Check if ImageURL exists before displaying
    if (isset($row['ImageURL']) && !empty($row['ImageURL'])) {
        echo "<img src='" . htmlspecialchars($row['ImageURL']) . "' alt='" . htmlspecialchars($row['ProductName']) . "' style='width: 100%; height: auto; border: 2px solid #555;'>";
    } else {
        echo "<img src='catalog/default_image.jpg' alt='Default Image' style='width: 100%; height: auto; border: 2px solid #555;'>";
    }

    echo "<h2 style='font-size: 16px;'>" . htmlspecialchars($row['ProductName']) . "</h2>";
    echo "<p style='font-size: 14px;'>" . htmlspecialchars($row['ProductDescription']) . "</p>";
    echo "<p style='font-size: 14px;'>Price: $" . number_format($row['UnitPrice'], 2) . "</p>";
    echo "<p style='font-size: 14px;'>Stock: " . intval($row['QuantityInStock']) . " available</p>";
    echo "<a href='shop_cart.php?action=add&id=" . intval($row['ProductID']) . "' style='text-decoration: none; background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px;'>Add to Cart</a>";
    echo "</div>";
}

echo "</div>"; // Closing product catalog div

// Display cart contents
echo "<h1>Your Shopping Cart</h1>";

if (empty($cartItems)) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<table>";
    echo "<thead>";
    echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th><th>Action</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    
    foreach ($cartItems as $item) {
        // Accessing the item using the product ID
        $productID = $item['id']; // Get the product ID stored in the cart item
        
        // Get product details from the database
        $stmt = $pdo->prepare("SELECT ProductName FROM Products WHERE ProductID = ?");
        $stmt->execute([$productID]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) { // Ensure the product was found
            $itemTotal = $item['price'] * $item['quantity']; // Calculate total for the item
            
            echo "<tr>";
            echo "<td>" . htmlspecialchars($product['ProductName']) . "</td>";
            echo "<td>
                    <form action='shop_cart.php?action=update&id={$productID}' method='get'>
                        <input type='number' name='quantity' value='{$item['quantity']}' min='1'>
                        <input type='submit' value='Update'>
                    </form>
                  </td>";
            echo "<td>$" . number_format($item['price'], 2) . "</td>";
            echo "<td>$" . number_format($itemTotal, 2) . "</td>";
            echo "<td><a href='shop_cart.php?action=remove&id={$productID}'>Remove</a></td>";
            echo "</tr>";
        } else {
            echo "<tr><td colspan='5'>Product not found for ID: {$productID}</td></tr>"; // Error message for missing product
        }
    }

    echo "</tbody>";
    echo "</table>";

    // Display total price information
    echo "<p>Subtotal: $" . number_format($total, 2) . "</p>";
    echo "<p>Tax (8%): $" . number_format($total * $taxRate, 2) . "</p>";
    echo "<p>Total: $" . number_format($total * (1 + $taxRate), 2) . "</p>";
    
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
}

include 'global/footer.php';
?>
