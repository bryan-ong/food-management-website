<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to the database: $dbname";
?>
