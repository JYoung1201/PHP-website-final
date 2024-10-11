<?php
require 'global/db.php'; // Connect to the database

// Get the comment ID from the URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Fetch the existing comment details
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE ID = ?");
    $stmt->execute([$id]);
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$comment) {
        echo "Comment not found.";
        exit;
    }
} else {
    echo "Invalid comment ID.";
    exit;
}

// Initialize variables for form fields and error messages
$name = $title = $commentText = "";
$nameErr = $titleErr = $commentErr = $successMsg = "";

// Handle form submission to update the comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and spaces allowed";
        }
    }

    // Validate title
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } else {
        $title = htmlspecialchars(trim($_POST["title"]));
    }

    // Validate comment
    if (empty($_POST["comment"])) {
        $commentErr = "Comment is required";
    } else {
        $commentText = htmlspecialchars(trim($_POST["comment"]));
    }

    // If no errors, update the comment in the database
    if (empty($nameErr) && empty($titleErr) && empty($commentErr)) {
        $stmt = $pdo->prepare("UPDATE comments SET name = ?, title = ?, comments = ? WHERE ID = ?");
        if ($stmt->execute([$name, $title, $commentText, $id])) {
            $successMsg = "Comment updated successfully!";
            header("Location: variablesnew.php"); // Redirect to the comments page after successful update
            exit;
        } else {
            echo "Failed to update comment.";
        }
    }
}
?>

<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>

<!-- HTML form to edit the comment -->
<div class="container">
    <h2>Edit Comment</h2>
    
    <!-- Display success message -->
    <?php if ($successMsg): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMsg; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control <?php echo $nameErr ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($comment['name']); ?>" required>
            <div class="invalid-feedback"><?php echo $nameErr; ?></div>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control <?php echo $titleErr ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($comment['title']); ?>" required>
            <div class="invalid-feedback"><?php echo $titleErr; ?></div>
        </div>

        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" class="form-control <?php echo $commentErr ? 'is-invalid' : ''; ?>" rows="4" required><?php echo htmlspecialchars($comment['comments']); ?></textarea>
            <div class="invalid-feedback"><?php echo $commentErr; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
</div>

<?php include 'global/footer.php'; ?>
