<?php
session_start();

// Check if the user is logged in and if their role is 'admin'
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'customer') {
    // If not, redirect to the login page or display an error message
    header('Location: login.php');
    exit(); // Stop further execution
}


?>

<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Welcome, Customer!</h1>
    <p>This is the customer dashboard.</p>

    <h2>Your Account</h2>
    <ul>
       
        <li><a href="shop_cart.php">Go to Shopping Cart</a></li>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
<?php include 'global/footer.php'; ?>