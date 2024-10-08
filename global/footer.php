<footer class="footer">

    <p>&copy; <?php echo date("Y"); ?> Breakthru Beverages</p>
    <p>Last Modified: <?php echo date("Y-m-d H:i:s", filemtime(__FILE__)); ?></p>

    <p>
        <a href="https://validator.w3.org/check/referer"><img src="https://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML" height="31" width="88"></a>
        <a href="https://jigsaw.w3.org/css-validator/check/referer"><img src="https://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS" height="31" width="88"></a>
        <a href="https://www.facebook.com" target="_blank"><img src="path/to/facebook-icon.png" alt="Facebook" height="31" width="88"></a>
        <a href="https://www.twitter.com" target="_blank"><img src="path/to/twitter-icon.png" alt="Twitter" height="31" width="88"></a>
        <a href="https://www.instagram.com" target="_blank"><img src="path/to/instagram-icon.png" alt="Instagram" height="31" width="88"></a>
    </p>

    <?php
    if (isset($_SESSION['user'])) {
        echo '<p><a href="#" onclick="confirmLogout()">Logout</a></p>';
    }
    ?>

    <form action="reset_session.php" method="post" style="display:inline;">
        <input type="submit" value="Reset Session" onclick="return confirm('Are you sure you want to reset the session?');">
    </form>

    <script>
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = '../logout.php';
        }
    }
    </script>
</footer>
