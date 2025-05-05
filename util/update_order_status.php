<?php

require_once "db_connect.php";
header("Content-Type: application/json");

// Adding true  ensures we are getting an associative array back instead of an object
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $order_id = (int)($data['order_id']) ?? '';


    $stmt = $conn->prepare("UPDATE orders SET status = 'COMPLETED' WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
        ]);
    } else {
        echo json_encode(['error' => 'Could not update order']);
    }
}
