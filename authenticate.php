<?php
session_start();

$username = htmlspecialchars($_POST['username'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

// Define user credentials with hashed passwords
$credentials = [
    'customer' => password_hash('customer', PASSWORD_DEFAULT) // Hashed password for 'customer'
];

if (isset($credentials[$username]) && password_verify($password, $credentials[$username])) {
    $_SESSION['user'] = $username;

    // Redirect to the stored URL or default to the organizational chart page if not set
    $redirectUrl = $_SESSION['redirect_to'] ?? 'variablesnew.php';
    unset($_SESSION['redirect_to']); // Clear the stored URL to prevent reuse
    header('Location: ' . $redirectUrl);
    exit;
} else {
    echo "<script>alert('Invalid username or password!'); window.location='login.php';</script>";
}
?>