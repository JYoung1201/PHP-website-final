<?php
session_start();

// Check if the user is trying to access a page without being logged in
if (!isset($_SESSION['user']) && isset($_SERVER['HTTP_REFERER'])) {
    // Store the original page (where the user came from)
    $_SESSION['redirect_to'] = $_SERVER['HTTP_REFERER'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Predefined usernames and passwords
    $credentials = [
        'admin' => 'admin',
        'publisher' => 'publisher',
        'customer' => 'customer',
    ];

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password match
    if (array_key_exists($username, $credentials) && $credentials[$username] === $password) {
        $_SESSION['user'] = $username; // Set the user session
        $_SESSION['role'] = $username; // Store the role in session

        // Redirect to the original page, if any
        if (isset($_SESSION['redirect_to'])) {
            header('Location: ' . $_SESSION['redirect_to']);
            unset($_SESSION['redirect_to']); // Clear the redirect session variable
        } else {
            // If no original page, redirect based on role
            if ($username === 'admin') {
                header('Location: admin_dashboard.php');
            } elseif ($username === 'publisher') {
                header('Location: publisher_dashboard.php');
            } elseif ($username === 'customer') {
                header('Location: customer_dashboard.php');
            }
        }
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php include 'global/footer.php'; ?>
