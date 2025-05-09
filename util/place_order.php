<?php

require_once "db_connect.php";
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adding true  ensures we are getting an associative array back instead of an object
    $data = json_decode(file_get_contents("php://input"), true);


    $user_id = $_SESSION['user_id'] ?? '';
    $grand_total = $data['grand_total'] ?? '';
    $cart = $data['cart'] ?? '';
    $destination = $data['destination'] ?? '';
    $delivery_type = $data['delivery_type'] ?? '';

    if ($delivery_type == "DINE-IN") {

        $restaurant_ids = [];

        foreach ($cart as $item) {
            $dish_id = $item['id'];

            $stmt = $conn->prepare("SELECT restaurant_id FROM dishes WHERE dish_id = ?");
            $stmt->bind_param("i", $dish_id);
            $stmt->execute();
            $stmt->bind_result($restaurant_id);
            $stmt->fetch();

            $restaurant_ids[] = $restaurant_id;
            $stmt->close();
        }


        if (count(array_unique($restaurant_ids)) > 1) {
            echo json_encode(['error' => 'Cart items must be from the same restaurant. Try again.']);
            return;
        }
    }


    if (!empty($user_id) && !empty($grand_total) && !empty($cart) && !empty($destination) && !empty($delivery_type)) {
        if ($delivery_type == 'TAKEAWAY') {
            $stmt = $conn->prepare("INSERT INTO orders (user_id, grand_total, address, delivery_type) VALUES (?, ?, ?, ?)");
        } else {
            $stmt = $conn->prepare("INSERT INTO orders (user_id, grand_total, table_number, delivery_type) VALUES (?, ?, ?, ?)");
        }
        $stmt->bind_param("idss", $user_id, $grand_total, $destination, $delivery_type);

        if ($stmt->execute()) {
            $order_id = $conn->insert_id;

            $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, dish_id, quantity) VALUES (?, ?, ?)");

            foreach ($cart as $item) {
                $dish_id = $item['id'];
                $quantity = $item['quantity'];

                $itemStmt->bind_param("iii", $order_id, $dish_id, $quantity);
                $itemStmt->execute();
            }

            echo json_encode([
                'success' => true,
                'message' => 'All items are from the same restaurant.',
                'id' => $order_id
            ]);
        } else {
            echo json_encode(['error' => 'Order placement failed']);
        }
    } else {
        echo json_encode(['error' => 'Missing required fields']);
    }
}
