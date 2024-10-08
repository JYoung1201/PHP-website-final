<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Admin dashboard content
?>
<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <p>This is the admin dashboard.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
<?php include 'global/footer.php'; ?>