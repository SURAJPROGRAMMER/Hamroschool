<?php
$host = "localhost";      // or 127.0.0.1
$dbname = "user_system";  // Change to your actual DB name
$username = "root";       // Replace with your DB username
$password = "";           // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
