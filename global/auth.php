<?php
session_start();

if (!isset($_SESSION['user'])) {
    // User is not logged in, redirect them to the login page
    header('Location: login.php');
    exit();
}
?>
