<?php
include '../session_check.php';
check_session();
?>

<?php
// Include variables.php to access the variables
include 'variables.php';
?>
<?php include '../global/header.php'; ?>
<style>
    .centered {
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 20%; /* Adjust the max-width as needed */
        height: auto; /* Maintain aspect ratio */
    }
</style>
<body>
    <h1><?php echo $employee3_name; ?></h1>
    <img src="profile images\michael_johnson.jpg" alt="<?php echo $employee3_name; ?>" class="centered">
    <p><strong>Job Title:</strong> <?php echo $employee3_job_title; ?></p>
    <p><strong>Department:</strong> <?php echo $employee3_department; ?></p>
    <p><strong>Degree:</strong> <?php echo $employee3_degree; ?></p>
    <p><strong>Hobby:</strong> <?php echo $employee3_hobby; ?></p>
    <p><strong>Goals:</strong> <?php echo $employee3_goals; ?></p>
    <p><strong>Interests:</strong> <?php echo $employee3_interests; ?></p>
    <?php include '../global/footer.php'; ?>


</body>
</html>
