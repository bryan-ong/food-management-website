<?php
function getUserDetails($conn)
{
    static $user = null;

    if ($user === null && isset($_SESSION['user_id'])) {
        $stmt = $conn->prepare("SELECT username, email, pfp_url, created_at, phone_number, role, address, password_hash, restaurant_id, orders_made FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $user['discount_percentage'] = getDiscountPercentage($user['orders_made']);
    }


    return $user ?? [
        'username' => '',
        'email' => '',
        'pfp_url' => 'assets/pfp.png',
        'created_at' => '',
        'phone_number' => '',
        'role' => 'USER',
        'address' => '',
        'password_hash' => '',
        'restaurant_id' => '',
        'orders_made' => '0',
        'discount_percentage' => '0',
    ];
}

function getDiscountPercentage($ordersMade)
{
    if ($ordersMade > 0) {
        return number_format(min(log($ordersMade, 1.25), 20), 2, '.', ""); // Sorry for messy code
    } else return 0;
}
