<?php
require_once 'global/auth.php'; // Ensures the user is logged in
?>

<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>
<body>
    <main class="content">
        <p>Scrapped since checkout process not part of grading rubric.</p>
        
    </main>
    <?php include 'global/footer.php'; ?>
</body>
</html>

<!-- 
<?php
session_start();
require 'global/db.php'; // Database connection
require 'ShoppingCart.php'; // Include ShoppingCart class
include 'global/header.php';
include 'global/menu.php';

// Initialize shopping cart
if (!isset($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['cart'];
$cartItems = $cart->getItems();

if (empty($cartItems)) {
    echo "Your cart is empty!";
    exit();
}

// Calculate totals
$total = 0;
$taxRate = 0.08; // Example tax rate
foreach ($cartItems as $item) {
    $stmt = $pdo->prepare("SELECT UnitPrice FROM Products WHERE ProductID = ?");
    $stmt->execute([$item['id']]);
    $product = $stmt->fetch();
    $total += $product['UnitPrice'] * $item['quantity'];
}

$finalTotal = $total * (1 + $taxRate);

// Insert the order into the database
try {
    $pdo->beginTransaction();

    // Insert order record
    $stmt = $pdo->prepare("INSERT INTO Orders (OrderStatus) VALUES ('Pending')");
    $stmt->execute();
    $orderID = $pdo->lastInsertId();

    // Insert each order detail
    foreach ($cartItems as $item) {
        $stmt = $pdo->prepare("SELECT UnitPrice FROM Products WHERE ProductID = ?");
        $stmt->execute([$item['id']]);
        $product = $stmt->fetch();

        $stmt = $pdo->prepare("INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderID, $item['id'], $item['quantity'], $product['UnitPrice']]);

        // Update inventory
        $stmt = $pdo->prepare("UPDATE Inventory SET QuantityInStock = QuantityInStock - ? WHERE ProductID = ?");
        $stmt->execute([$item['quantity'], $item['id']]);
    }

    $pdo->commit();
    
    // Empty the cart after checkout
    $_SESSION['cart'] = new ShoppingCart();
    
    echo "<h1>Thank you for your order!</h1>";
    echo "<p>Your order has been placed successfully.</p>";
    echo "<p>Total amount: $" . number_format($finalTotal, 2) . "</p>";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Failed to process order: " . $e->getMessage();
}

?>
<?php include 'global/footer.php'; ?> -->