<?php
$host = "localhost";
$username = "root"; // Default for XAMPP
$password = "";     // Default password is empty in XAMPP
$database = "hostel_management"; // Your new database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
