<?php
include '../session_check.php';
check_session();
?>

<?php
// Validate form inputs
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $person = $_POST["person"];
    $job = $_POST["job"];
    $department = $_POST["department"];
    $degree = $_POST["degree"];
    $hobby = $_POST["hobby"];
    $goals = $_POST["goals"];
    $interests = $_POST["interests"];
    
    // Include variables.php to access the variables
    include 'variables.php';

    // Update the respective employee's information
    if ($person == "John Doe") {
        $employee1_job_title = $job;
        $employee1_department = $department;
        $employee1_degree = $degree;
        $employee1_hobby = $hobby;
        $employee1_goals = $goals;
        $employee1_interests = $interests;
        $redirect_page = "john_doe.php";
    } elseif ($person == "Jane Smith") {
        $employee2_job_title = $job;
        $employee2_department = $department;
        $employee2_degree = $degree;
        $employee2_hobby = $hobby;
        $employee2_goals = $goals;
        $employee2_interests = $interests;
        $redirect_page = "jane_smith.php";
    } elseif ($person == "Michael Johnson") {
        $employee3_job_title = $job;
        $employee3_department = $department;
        $employee3_degree = $degree;
        $employee3_hobby = $hobby;
        $employee3_goals = $goals;
        $employee3_interests = $interests;
        $redirect_page = "michael_johnson.php";
    }

    // Save the updated variables back to variables.php
    file_put_contents('variables.php', '<?php' . PHP_EOL . '// Employee 1' . PHP_EOL . '$employee1_name = "' . $employee1_name . '";' . PHP_EOL . '$employee1_job_title = "' . $employee1_job_title . '";' . PHP_EOL . '$employee1_department = "' . $employee1_department . '";' . PHP_EOL . '$employee1_degree = "' . $employee1_degree . '";' . PHP_EOL . '$employee1_hobby = "' . $employee1_hobby . '";' . PHP_EOL . '$employee1_goals = "' . $employee1_goals . '";' . PHP_EOL . '$employee1_interests = "' . $employee1_interests . '";' . PHP_EOL . PHP_EOL . '// Employee 2' . PHP_EOL . '$employee2_name = "' . $employee2_name . '";' . PHP_EOL . '$employee2_job_title = "' . $employee2_job_title . '";' . PHP_EOL . '$employee2_department = "' . $employee2_department . '";' . PHP_EOL . '$employee2_degree = "' . $employee2_degree . '";' . PHP_EOL . '$employee2_hobby = "' . $employee2_hobby . '";' . PHP_EOL . '$employee2_goals = "' . $employee2_goals . '";' . PHP_EOL . '$employee2_interests = "' . $employee2_interests . '";' . PHP_EOL . PHP_EOL . '// Employee 3' . PHP_EOL . '$employee3_name = "' . $employee3_name . '";' . PHP_EOL . '$employee3_job_title = "' . $employee3_job_title . '";' . PHP_EOL . '$employee3_department = "' . $employee3_department . '";' . PHP_EOL . '$employee3_degree = "' . $employee3_degree . '";' . PHP_EOL . '$employee3_hobby = "' . $employee3_hobby . '";' . PHP_EOL . '$employee3_goals = "' . $employee3_goals . '";' . PHP_EOL . '$employee3_interests = "' . $employee3_interests . '";' . PHP_EOL . '?>');

    // Redirect to the individual's page with updated information
    header("Location: $redirect_page");
    exit;
}
?>
