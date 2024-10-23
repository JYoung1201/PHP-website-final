<?php
session_start();
require_once 'global/db.php'; // Reference the db.php for the database connection

// Check if the user is trying to access a page without being logged in, and it's not the login page itself
if (!isset($_SESSION['user']) && isset($_SERVER['HTTP_REFERER']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    // Store the original page (where the user came from), ensuring it's not a login page
    $_SESSION['redirect_to'] = $_SERVER['HTTP_REFERER'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to check the credentials from the 'login' table
    $stmt = $pdo->prepare("SELECT * FROM login WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user is found and passwords match
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username']; // Set the user session
        $_SESSION['role'] = $user['role'];     // Store the role in session

        // Redirect to the original page, if any
        if (isset($_SESSION['redirect_to']) && !empty($_SESSION['redirect_to'])) {
            header('Location: ' . $_SESSION['redirect_to']);
            unset($_SESSION['redirect_to']); // Clear the redirect session variable
        } else {
            // If no original page, redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header('Location: admin_dashboard.php');
                    break;
                case 'publisher':
                    header('Location: publisher_dashboard.php');
                    break;
                case 'customer':
                    header('Location: customer_dashboard.php');
                    break;
                default:
                    header('Location: login.php'); // Fallback
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
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required autocomplete="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required autocomplete="current-password">
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php include 'global/footer.php'; ?>
