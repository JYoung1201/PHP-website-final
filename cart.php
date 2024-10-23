<?php
session_start();

// Ensure ShoppingCart class is included before accessing session data
require 'global/db.php'; // Database connection
require 'ShoppingCart.php'; // Include ShoppingCart class definition

// Initialize shopping cart if it doesn't exist or if it's not an instance of ShoppingCart
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
        $product = $stmt->fetch();

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
            // Debug: Product not found
            error_log("Product not found: ID = $productID");
        }
    }

    // Redirect to avoid reprocessing the form
    header("Location: cart.php");
    exit();
}

require_once 'global/auth.php'; // Ensures the user is logged in


include 'global/header.php';
include 'global/menu.php';

// Display cart contents
$cartItems = $cart->getItems(); // Get items from the cart
$total = 0;
$taxRate = 0.08; // Example tax rate of 8%
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Your Shopping Cart</h1>

<?php if (empty($cartItems)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <?php
                // Get product details from the database
                $stmt = $pdo->prepare("SELECT ProductName FROM Products WHERE ProductID = ?");
                $stmt->execute([$item['id']]);
                $product = $stmt->fetch();
                if (!$product) {
                    // Debug: Product not found in cart display
                    error_log("Product not found in cart display: ID = {$item['id']}");
                    continue; // Skip this item if not found
                }
                $itemTotal = $item['price'] * $item['quantity']; // Calculate total for the item
                $total += $itemTotal; // Add to the total cart value
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['ProductName']) ?></td>
                    <td>
                        <form action="cart.php?action=update&id=<?= $item['id'] ?>" method="get">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="submit" value="Update">
                        </form>
                    </td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($itemTotal, 2) ?></td>
                    <td>
                        <a href="cart.php?action=remove&id=<?= $item['id'] ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Subtotal: $<?= number_format($total, 2) ?></p>
    <p>Tax (8%): $<?= number_format($total * $taxRate, 2) ?></p>
    <p>Total: $<?= number_format($total * (1 + $taxRate), 2) ?></p>

    <a href="checkout.php">Proceed to Checkout</a>
<?php endif; ?>

</body>
</html>

<?php include 'global/footer.php'; ?>
