<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // Default MySQL username
$password = "";      // Default MySQL password is empty
$dbname = "grub";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If connection is successful, display a confirmation message
echo "Connected successfully to the database: $dbname";
?>
