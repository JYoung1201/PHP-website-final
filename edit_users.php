<?php
session_start();
require 'global/db.php'; // Include your database connection

// Check if the user is logged in and has admin role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login if not admin
    exit();
}

// Handle user addition
if (isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];

    // Insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO login (username, password, role) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $role])) {
        echo "<p>User $username added successfully.</p>";
    } else {
        echo "<p>Error adding user. Please try again.</p>";
    }
}

// Handle user deletion
if (isset($_GET['delete'])) {
    $userId = intval($_GET['delete']);

    // Delete user from the database
    $stmt = $pdo->prepare("DELETE FROM login WHERE id = ?");
    if ($stmt->execute([$userId])) {
        echo "<p>User deleted successfully.</p>";
    } else {
        echo "<p>Error deleting user. Please try again.</p>";
    }
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM login");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'global/header.php';
include 'global/menu.php';
?>

<h1>Edit Users</h1>

<h2>Add User</h2>
<form method="post" action="edit_users.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>
    <label for="role">Role:</label>
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="publisher">Publisher</option>
        <option value="customer">Customer</option>
    </select>
    <br>
    <input type="submit" name="add_user" value="Add User">
</form>

<h2>Existing Users</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a> |
                    <a href="edit_users.php?delete=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'global/footer.php'; ?>
