<?php
// We have to use a separate file as PHP code cannot be put in a JS file. Also I want to reduce the amount of data stored by the browser's local storage. Hence I am only storing the IDs and Quantities in the shopping cart, instead of the name and image url, etc.. This means we have to fetch the data one more time from the database, referring to the product's ID.


// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "grub";

// $conn = new mysqli($servername, $username, $password, $dbname);

require_once "db_connect.php";
header('Content-Type: application/json');
// Gotta make a new mysqli as connect_db has some debugging code that I don't want to remove, and it is messing with the AJAX as the JS requires raw jsons
// I removed the debugging code but it's best not to touch this
// No longer needed new mysqli instance
if (!isset($_GET['id'])) {
    exit;
}

$productId = intval($_GET['id']);

// Using aliases here will make it more clean
$stmt = $conn->prepare("SELECT
    d.dish_id,
    d.dish_name,
    d.unit_price,
    d.image_url,
    d.cuisine_type,
    d.times_ordered,
    d.date_added,
    d.vegetarian,
    d.dish_description,
    r.restaurant_name
FROM
    dishes d
JOIN
    restaurants r ON d.restaurant_id = r.restaurant_id
WHERE
    d.dish_id = ?
");


$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
}
