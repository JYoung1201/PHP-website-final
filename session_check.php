//This code checks to see if the user is logged in and redirects them to the login if they are not
<?php
function check_session() {
    session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI']; // Store the current URL
        header('Location: ../login.php');
        exit;
    }
}
?>