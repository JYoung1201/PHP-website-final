<?php include '../global/header.php'; ?>
<?php include '../global/menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Web Poll (POST)</title>
</head>
<body>

<h2>Web Poll (POST)</h2>

<form action="poll_results_post.php" method="POST">
  <label for="name">Your Name:</label>
  <input type="text" id="name" name="name">
  <br><br>

  <!-- Product 1 -->
  <fieldset>
    <legend>Product 1</legend>
    <img src="product1_image.webp" alt="Product 1 Image" width="200">
    <p>Description: This is a brown round table with 4 legs. Price: $400</p>
    <label>Would you buy this product at this price?</label><br>
    <input type="radio" name="product1_rating" value="5"> Yes, definitely
    <input type="radio" name="product1_rating" value="4"> Probably yes
    <input type="radio" name="product1_rating" value="3"> Maybe
    <input type="radio" name="product1_rating" value="2"> Probably not
    <input type="radio" name="product1_rating" value="1"> No, definitely not
    <br>
    <label>What do you like most about this product?</label><br>
    <textarea name="product1_like" rows="2" cols="50" placeholder="Enter your response"></textarea>
    <br>
    <label>Is there anything you would change about this product?</label><br>
    <textarea name="product1_change" rows="2" cols="50" placeholder="Enter your response"></textarea>
    <br>
    <label>How likely are you to recommend this product to a friend?</label><br>
    <input type="radio" name="product1_recommend" value="5"> Very likely
    <input type="radio" name="product1_recommend" value="4"> Likely
    <input type="radio" name="product1_recommend" value="3"> Neutral
    <input type="radio" name="product1_recommend" value="2"> Unlikely
    <input type="radio" name="product1_recommend" value="1"> Very unlikely
  </fieldset>
  <br><br>

  <!-- Product 2 -->
  <fieldset>
    <legend>Product 2</legend>
    <img src="product2_image.jpg" alt="Product 2 Image" width="200">
    <p>Description: This is a white dining arm chair from Wayne. Price: $350</p>
    <label>Would you buy this product at this price?</label><br>
    <input type="radio" name="product2_rating" value="5"> Yes, definitely
    <input type="radio" name="product2_rating" value="4"> Probably yes
    <input type="radio" name="product2_rating" value="3"> Maybe
    <input type="radio" name="product2_rating" value="2"> Probably not
    <input type="radio" name="product2_rating" value="1"> No, definitely not
    <br>
    <label>What feature stands out to you the most in this product?</label><br>
    <textarea name="product2_feature" rows="2" cols="50" placeholder="Enter your response"></textarea>
    <br>
    <label>Would you consider buying this product as a gift for someone?</label><br>
    <input type="radio" name="product2_gift" value="yes"> Yes
    <input type="radio" name="product2_gift" value="no"> No
    <br>
    <label>How satisfied are you with the design of this product?</label><br>
    <input type="radio" name="product2_design" value="5"> Very satisfied
    <input type="radio" name="product2_design" value="4"> Satisfied
    <input type="radio" name="product2_design" value="3"> Neutral
    <input type="radio" name="product2_design" value="2"> Unsatisfied
    <input type="radio" name="product2_design" value="1"> Very unsatisfied
  </fieldset>
  <br><br>

  <!-- Product 3 -->
  <fieldset>
    <legend>Product 3</legend>
    <img src="product3_image.webp" alt="Product 3 Image" width="200">
    <p>Description: This is a table lamp and it includes one LED light bulb. Price: $8</p>
    <label>Would you buy this product at this price?</label><br>
    <input type="radio" name="product3_rating" value="5"> Yes, definitely
    <input type="radio" name="product3_rating" value="4"> Probably yes
    <input type="radio" name="product3_rating" value="3"> Maybe
    <input type="radio" name="product3_rating" value="2"> Probably not
    <input type="radio" name="product3_rating" value="1"> No, definitely not
    <br>
    <label>What room in your house would you place this lamp in?</label><br>
    <input type="text" name="product3_room" placeholder="Enter room name">
    <br>
    <label>Do you prefer warm or cool lighting for your living space?</label><br>
    <input type="radio" name="product3_lighting" value="warm"> Warm
    <input type="radio" name="product3_lighting" value="cool"> Cool
    <br>
    <label>How important is energy efficiency to you when choosing lighting products?</label><br>
    <input type="radio" name="product3_efficiency" value="5"> Very important
    <input type="radio" name="product3_efficiency" value="4"> Important
    <input type="radio" name="product3_efficiency" value="3"> Neutral
    <input type="radio" name="product3_efficiency" value="2"> Not very important
    <input type="radio" name="product3_efficiency" value="1"> Not important at all
  </fieldset>
  <br><br>

  <textarea name="comments" rows="4" cols="50" placeholder="Comments"></textarea>
  <br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
<?php include '../global/footer.php'; ?>