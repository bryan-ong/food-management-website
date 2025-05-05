<?php

require_once "db_connect.php";

$criteria = $_GET['criteria'] ?? 'alphabetical';
$direction = $_GET['direction'] ?? 'ASC';
$cuisines = isset($_GET['selectedCuisines']) ? $_GET['selectedCuisines'] : [];

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM dishes";

if (!empty($cuisines)) {
    $cuisines_component = implode("','", $cuisines);
    $sql .= " WHERE cuisine_type IN ('$cuisines_component')";
}

$sql .= " ORDER BY $criteria $direction";

$result = $conn->query($sql);

$dishes = [];
if ($result->num_rows > 0) {
    while ($dish = $result->fetch_assoc()) {
        $dishes[] = [
            'id' => $dish['dish_id'],
            'name' => $dish['dish_name'],
            'description' => $dish['dish_description'],
            'price' => $dish['unit_price'],
            'image_url' => $dish['image_url']
        ];
    }
}

echo json_encode($dishes);