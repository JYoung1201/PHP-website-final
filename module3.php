//This code updated the organizational chart



<?php
include 'session_check.php';
check_session();
?>
<?php include 'global/header.php'; ?>
<?php include 'global/menu.php'; ?>
<body>
    <h2>Update Organizational Chart</h2>
    <form action="profiles/update_process.php" method="POST">
        <label for="person">Select Person:</label>
        <select name="person" id="person">
            <option value="John Doe">John Doe</option>
            <option value="Jane Smith">Jane Smith</option>
            <option value="Michael Johnson">Michael Johnson</option>
        </select>
        <br><br>
        <label for="job">Job Title:</label>
        <input type="text" id="job" name="job">
        <br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department">
        <br><br>
        <label for="degree">Degree:</label>
        <input type="text" id="degree" name="degree">
        <br><br>
        <label for="hobby">Hobby:</label>
        <input type="text" id="hobby" name="hobby">
        <br><br>
        <label for="goals">Goals:</label>
        <input type="text" id="goals" name="goals">
        <br><br>
        <label for="interests">Interests:</label>
        <input type="text" id="interests" name="interests">
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
<?php include 'global/footer.php'; ?>
</html>
