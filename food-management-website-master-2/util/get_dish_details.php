<?php
// We have to use a separate file as PHP code cannot be put in a JS file. Also I want to reduce the amount of data stored by the browser's local storage. Hence I am only storing the IDs and Quantities in the shopping cart, instead of the name and image url, etc.. This means we have to fetch the data one more time from the database, referring to the product's ID.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grub";

$conn = new mysqli($servername, $username, $password, $dbname);
// Gotta make a new mysqli as connect_db has some debugging code that I don't want to remove, and it is messing with the AJAX as the JS requires raw jsons
// I removed the debugging code but it's best not to touch this
if (!isset($_GET['id'])) {
    exit;
}

$productId = intval($_GET['id']);
$stmt = $conn->prepare("SELECT dish_id as id, dish_name as name, unit_price as price, image_url, cuisine_type, times_ordered, date_added, vegetarian, dish_description as description FROM dishes WHERE dish_id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
}

$conn->close();