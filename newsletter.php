<?php
session_start();
require_once 'global/db.php'; // Include your database connection if needed

include 'global/header.php'; // Include the global header
include 'global/menu.php'; // Include the global menu

// Sample posts for the newsletter (this could be fetched from a database)
$newsletter_posts = [
    [
        "title" => "New Product Launch: Exclusive Wine Selection",
        "date" => "October 10, 2024",
        "content" => "We are thrilled to announce the launch of our new exclusive wine selection. Handpicked from top vineyards around the globe, these wines are sure to impress. Visit our catalogue to explore the new arrivals and take advantage of introductory offers available only this month!"
    ],
    [
        "title" => "Sustainability in the Beverage Industry",
        "date" => "September 20, 2024",
        "content" => "At Breakthru Beverages, we believe in sustainable practices to reduce our carbon footprint. Our new initiative focuses on sourcing eco-friendly packaging and partnering with environmentally conscious producers. Join us in making a positive impact with every sip!"
    ],
    [
        "title" => "Behind the Scenes: Meet Our Expert Sommeliers",
        "date" => "August 30, 2024",
        "content" => "Our sommeliers are the backbone of our product curation. This month, we sat down with our team to learn more about their selection process and what makes our collection stand out. Get to know the experts who bring you the best wines and spirits!"
    ]
];

// Check if the user is logged in and has the role 'admin' or 'publisher'
$can_edit = isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'publisher');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breakthru Beverages Newsletter</title>
</head>
<body>
    <div class="content">
        <h1>Breakthru Beverages Newsletter</h1>

        <!-- Loop through the newsletter posts -->
        <?php foreach ($newsletter_posts as $post): ?>
            <div class="newsletter-post">
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><em><?php echo htmlspecialchars($post['date']); ?></em></p>
                <p><?php echo htmlspecialchars($post['content']); ?></p>
            </div>
            <hr> <!-- Divider between posts -->
        <?php endforeach; ?>

        <h3>Stay Tuned for More Updates!</h3>
        <p>Subscribe to our newsletter to receive the latest updates, product launches, and offers directly to your inbox.</p>

        <?php if ($can_edit): ?>
            <h2>Add/Edit Newsletter Post</h2>
            <form action="process_newsletter.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br>

                <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="5" required></textarea><br>

                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <p>You do not have permission to add or edit newsletter posts.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include 'global/footer.php'; // Include the global footer ?>
