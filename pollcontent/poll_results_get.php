<?php
// Include necessary header and menu files if needed
include '../global/header.php';


// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve and process the form data
    $name = $_GET['name'];

    // Retrieve data for Product 1
    $product1_rating = $_GET['product1_rating'];
    $product1_like = $_GET['product1_like'];
    $product1_change = $_GET['product1_change'];
    $product1_recommend = $_GET['product1_recommend'];

    // Retrieve data for Product 2
    $product2_rating = $_GET['product2_rating'];
    $product2_feature = $_GET['product2_feature'];
    $product2_gift = $_GET['product2_gift'];
    $product2_design = $_GET['product2_design'];

    // Retrieve data for Product 3
    $product3_rating = $_GET['product3_rating'];
    $product3_room = $_GET['product3_room'];
    $product3_lighting = $_GET['product3_lighting'];
    $product3_efficiency = $_GET['product3_efficiency'];

    $comments = $_GET['comments'];

    // Display the results
    echo "<h2>GET Poll Results</h2>";
    echo "<p>Name: $name</p>";
    echo "<h3>Product 1</h3>";
    echo "<p>Rating: $product1_rating</p>";
    echo "<p>What do you like most: $product1_like</p>";
    echo "<p>Changes suggested: $product1_change</p>";
    echo "<p>Recommend to a friend: $product1_recommend</p>";
    echo "<h3>Product 2</h3>";
    echo "<p>Rating: $product2_rating</p>";
    echo "<p>Feature liked: $product2_feature</p>";
    echo "<p>Consider as a gift: $product2_gift</p>";
    echo "<p>Satisfaction with design: $product2_design</p>";
    echo "<h3>Product 3</h3>";
    echo "<p>Rating: $product3_rating</p>";
    echo "<p>Room preference: $product3_room</p>";
    echo "<p>Lighting preference: $product3_lighting</p>";
    echo "<p>Importance of energy efficiency: $product3_efficiency</p>";
    echo "<p>Comments: $comments</p>";

    // You can continue displaying and processing the rest of the form data as needed
} else {
    echo "No data submitted.";
}

// Include any additional footer or closing tags if necessary
?>

<?php include '../global/footer.php'; ?>