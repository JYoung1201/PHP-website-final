<?php
session_start(); // Start the session
session_destroy(); // Destroy all session data
header("Location: shop_cart.php"); // Redirect back to the shop cart page
exit();
?>
