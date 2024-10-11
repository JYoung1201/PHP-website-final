<?php
ob_start(); // Start output buffering
require 'global/db.php'; // Connect to the database
include 'global/header.php';
include 'global/menu.php';

// Check if the comment ID is provided in the URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Delete the comment from the database
    $stmt = $pdo->prepare("DELETE FROM comments WHERE ID = ?");
    if ($stmt->execute([$id])) {
        header("Location: variablesnew.php"); // Redirect to the comments page after successful deletion
        exit; // Ensure no further code is executed
    } else {
        echo "Failed to delete comment.";
    }
} else {
    echo "Invalid comment ID.";
}

ob_end_flush(); // Send the output buffer
?>

<?php include 'global/footer.php'; ?>
