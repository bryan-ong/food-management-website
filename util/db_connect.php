<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (session_status() === PHP_SESSION_NONE) session_start();
include_once "php_utils.php";
$user = getUserDetails($conn);

// print_r($user);