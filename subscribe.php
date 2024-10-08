<?php
session_start();

// Initialize variables to store form data and error messages
$email = $phone = "";
$emailErr = $phoneErr = "";
$successMsg = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        }
    }

    // Validate phone number
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required.";
    } else {
        $phone = htmlspecialchars(trim($_POST["phone"]));
        // Check if phone number contains only digits and has 10 or 11 characters
        if (!preg_match("/^\d{10,11}$/", $phone)) {
            $phoneErr = "Phone number must be 10 or 11 digits.";
        }
    }

    // If there are no errors, process the subscription (e.g., save to the database)
    if (empty($emailErr) && empty($phoneErr)) {
        // Here you could insert the subscription into a database
        // Example: $stmt = $pdo->prepare("INSERT INTO Subscribers (email, phone) VALUES (?, ?)");
        // $stmt->execute([$email, $phone]);

        // Clear the form fields
        $email = $phone = "";
        $successMsg = "Thank you for subscribing!";
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
    <title>Subscribe for Updates</title>
</head>
<body>
    <h1>Subscribe to Breakthru Beverage Updates</h1>
    <?php if ($successMsg): ?>
        <p style="color: green;"><?php echo $successMsg; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span style="color: red;"><?php echo $emailErr; ?></span><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="10 or 11 digits">
        <span style="color: red;"><?php echo $phoneErr; ?></span><br><br>

        <input type="submit" value="Subscribe">
    </form>
</body>
</html>

<?php include 'global/footer.php'; ?>