<?php
include '../session_check.php';
check_session();
?>

<?php
// Include variables.php to access the variables
include 'variables.php';
?>
<!DOCTYPE html>
<html lang="en">
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
    <h1><?php echo $employee1_name; ?></h1>
    <img src="profile images\john_doe.jpg" alt="<?php echo $employee1_name; ?>" class="centered">
    <p><strong>Job Title:</strong> <?php echo $employee1_job_title; ?></p>
    <p><strong>Department:</strong> <?php echo $employee1_department; ?></p>
    <p><strong>Degree:</strong> <?php echo $employee1_degree; ?></p>
    <p><strong>Hobby:</strong> <?php echo $employee1_hobby; ?></p>
    <p><strong>Goals:</strong> <?php echo $employee1_goals; ?></p>
    <p><strong>Interests:</strong> <?php echo $employee1_interests; ?></p>
    <?php include '../global/footer.php'; ?>


</body>
</html>
