<?php
// db.php
//this file connects site to database
// Database connection parameters
$host = 'pixie-db.jyoung1201.lol';
$dbname = 'redacted';
$username = 'redacted';
$password = 'redacted'; 

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
