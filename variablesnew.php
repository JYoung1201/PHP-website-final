<?php
include 'session_check.php';
check_session();
?>
<?php
require 'global/db.php'; // Connect to the database

// Initialize variables for form fields and error messages
$name = $title = $comment = "";
$nameErr = $titleErr = $commentErr = $successMsg = "";

// Handle form submission
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
        $comment = htmlspecialchars(trim($_POST["comment"]));
    }

    // If no errors, insert the data into the comments table
    if (empty($nameErr) && empty($titleErr) && empty($commentErr)) {
        $stmt = $pdo->prepare("INSERT INTO comments (name, title, comments) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $title, $comment])) {
            $successMsg = "Your comment has been successfully added!";
            // Reset the form fields
            $name = $title = $comment = "";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error: " . $errorInfo[2]; //
        }
    }
}
?>

<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>



<main class="content">

    <h3>Organizational Chart</h3>
    <ul>
        <li>
            <img src="profiles/profile images/john_doe.jpg" alt="John Doe" width="100">
            <a href="profiles/john_doe.php">John Doe</a>
        </li>
        <li>
            <img src="profiles/profile images/jane_smith.jpg" alt="Jane Smith" width="100">
            <a href="profiles/jane_smith.php">Jane Smith</a>
        </li>
        <li>
            <img src="profiles/profile images/michael_johnson.jpg" alt="Michael Johnson" width="100">
            <a href="profiles/michael_johnson.php">Michael Johnson</a>
        </li>
    </ul>
    <form action="module3.php">
        <button type="submit" class="btn">Update Organizational Chart</button>
    </form>

    <div class="container">
    <h2 class="mt-5">Leave a Comment</h2>

    <!-- Display success message -->
    <?php if ($successMsg): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMsg; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $name; ?>" required>
            <div class="invalid-feedback"><?php echo $nameErr; ?></div>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : ''; ?>" id="title" name="title" value="<?php echo $title; ?>" required>
            <div class="invalid-feedback"><?php echo $titleErr; ?></div>
        </div>

        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control <?php echo $commentErr ? 'is-invalid' : ''; ?>" id="comment" name="comment" rows="4" required><?php echo $comment; ?></textarea>
            <div class="invalid-feedback"><?php echo $commentErr; ?></div>
        </div>

        <button type="submit" class="btn">Submit</button>
    </form>
</div>


    <?php
    // Query to fetch all comments from the database, sorted by most recent
    $stmt = $pdo->query("SELECT * FROM comments ORDER BY commentdate DESC");
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Comments</h2>

    <?php if (!empty($comments)): ?>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <strong>Name:</strong> <?php echo htmlspecialchars($comment['name']); ?><br>
                    <strong>Title:</strong> <?php echo htmlspecialchars($comment['title']); ?><br>
                    <strong>Date:</strong> <?php echo htmlspecialchars($comment['commentdate']); ?><br>
                    <strong>Comment:</strong> <?php echo nl2br(htmlspecialchars($comment['comments'])); ?><br>
                    <a href="edit_comment.php?id=<?php echo $comment['ID']; ?>">Edit</a> | 
                    <a href="delete_comment.php?id=<?php echo $comment['ID']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No comments available.</p>
    <?php endif; ?>

</main>

<?php include 'global/footer.php'; ?>

</body>
</html>
