<?php
$servername = "localhost";  // XAMPP default
$username   = "root";       // XAMPP default user
$password   = "";           // XAMPP default password (empty)
$database   = "hamroschool"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
