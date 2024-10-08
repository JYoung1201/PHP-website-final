<?php
session_start();

// Initialize variables to store form data and error messages
$name = $email = $feedback = "";
$nameErr = $emailErr = $feedbackErr = "";
$successMsg = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

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

    // Validate feedback
    if (empty($_POST["feedback"])) {
        $feedbackErr = "Feedback is required.";
    } else {
        $feedback = htmlspecialchars(trim($_POST["feedback"]));
    }

    // If there are no errors, process the feedback (e.g., save to the database)
    if (empty($nameErr) && empty($emailErr) && empty($feedbackErr)) {
        // Here you could insert the feedback into a database
        // Example: $stmt = $pdo->prepare("INSERT INTO Feedback (name, email, feedback) VALUES (?, ?, ?)");
        // $stmt->execute([$name, $email, $feedback]);

        // Clear form fields
        $name = $email = $feedback = "";
        $successMsg = "Thank you for your feedback!";
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
    <title>Customer Feedback</title>
</head>
<body>
    <h1>Customer Feedback</h1>
    <?php if ($successMsg): ?>
        <p style="color: green;"><?php echo $successMsg; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <span style="color: red;"><?php echo $nameErr; ?></span><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span style="color: red;"><?php echo $emailErr; ?></span><br><br>

        <label for="feedback">Feedback:</label><br>
        <textarea name="feedback"><?php echo htmlspecialchars($feedback); ?></textarea>
        <span style="color: red;"><?php echo $feedbackErr; ?></span><br><br>

        <input type="submit" value="Submit Feedback">
    </form>
</body>
</html>
<?php include 'global/footer.php'; ?>