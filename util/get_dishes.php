<?php

require_once "db_connect.php";

$criteria       = $_GET['criteria'] ?? 'alphabetical';
$direction      = $_GET['direction'] ?? 'ASC';
$cuisines       = isset($_GET['selectedCuisines']) ? $_GET['selectedCuisines'] : [];
$vegetarian     = $_GET['vegetarian'] ?? false;
$search         = $_GET['search'] ?? null;
$include_food   = filter_var($_GET['include_food'] ?? true, FILTER_VALIDATE_BOOLEAN);
$include_drinks = filter_var($_GET['include_drinks'] ?? true, FILTER_VALIDATE_BOOLEAN);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT dishes.*, restaurants.restaurant_name FROM dishes LEFT JOIN restaurants ON dishes.restaurant_id = restaurants.restaurant_id";
// Should use aliases but its minor detail

$conditions = [];

if ($include_food && $include_drinks) {
    $conditions[] = "(type = 'FOOD' OR type = 'DRINK')";
} elseif ($include_food) {
    $conditions[] = "type = 'FOOD'";
} elseif ($include_drinks) {
    $conditions[] = "type = 'DRINK'";
} else {
    $conditions[] = "1 = 0"; // Cool trick to ensure the query returns nothing
}

if (!empty($cuisines)) {
    $cuisines_component = implode("','", $cuisines);
    $conditions[] = "cuisine_type IN ('$cuisines_component')";
}

if ($vegetarian == 'true') {
    $conditions[] = "vegetarian = true";
}

if (!empty($search)) {
    $safe_search = $conn->real_escape_string($search);
    $conditions[] = "(dish_name LIKE '%$safe_search%' OR dish_description LIKE '%$safe_search%' OR restaurant_name LIKE '%$safe_search%')";
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
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
            'image_url' => $dish['image_url'],
            'cuisine_type' => $dish['cuisine_type'],
            'date_added' => $dish['date_added'],
            'times_ordered' => $dish['times_ordered'],
            'vegetarian' => $dish['vegetarian'],
            'restaurant_name' => $dish['restaurant_name'],
            'type' => $dish['type']
        ];
    }
}

echo json_encode($dishes);