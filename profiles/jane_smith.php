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
    <h1><?php echo $employee2_name; ?></h1>
    <img src="profile images\jane_smith.jpg" alt="<?php echo $employee2_name; ?>"class="centered">
    <p><strong>Job Title:</strong> <?php echo $employee2_job_title; ?></p>
    <p><strong>Department:</strong> <?php echo $employee2_department; ?></p>
    <p><strong>Degree:</strong> <?php echo $employee2_degree; ?></p>
    <p><strong>Hobby:</strong> <?php echo $employee2_hobby; ?></p>
    <p><strong>Goals:</strong> <?php echo $employee2_goals; ?></p>
    <p><strong>Interests:</strong> <?php echo $employee2_interests; ?></p>
    <?php include '../global/footer.php'; ?>


</body>
</html>
