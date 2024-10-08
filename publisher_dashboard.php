<?php
session_start();

// Check if the user is logged in and is a publisher
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'publisher') {
    header('Location: login.php');
    exit();
}

// Publisher dashboard content
?>
<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher Dashboard</title>
</head>
<body>
    <h1>Welcome, Publisher!</h1>
    <p>This is the publisher dashboard.</p>

    <h2>Manage Your Publications</h2>
    <ul>
        <li><a href="add_publication.php">Add New Publication</a></li>
        <li><a href="view_publications.php">View Your Publications</a></li>
        <li><a href="edit_publication.php">Edit Existing Publications</a></li>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
<?php include 'global/footer.php'; ?>