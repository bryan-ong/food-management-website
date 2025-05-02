<?php
function getUserDetails($conn) {
    static $user = null;

    if ($user === null && isset($_SESSION['user_id'])) {
        $stmt = $conn -> prepare("SELECT username, email, pfp_url, created_at FROM users WHERE user_id = ?");
        $stmt -> bind_param("i", $_SESSION['user_id']);
        $stmt -> execute();

        $user = $stmt -> get_result() -> fetch_assoc();
        $stmt -> close();
        
    }

    return $user ?? ['username' => '', 'email' => '', 'pfp_url' => 'assets/pfp.png', 'created_at' => ''];
}