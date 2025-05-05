<?php
require_once 'util/db_connect.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        // SQL query to fetch user data including the role
        $stmt = $conn->prepare("SELECT user_id, username, password_hash, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password_hash'])) {
                // Store user details in session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] == 'admin') {
                    header("Location: admin.php"); // Redirect to admin dashboard
                } else {
                    header("Location: restaurants.php"); // Redirect to user dashboard
                }
                exit;
            } else {
                $error = 'Invalid password.';
            }
        } else {
            $error = 'No user found with that username.';
        }
    } else {
        $error = 'Please fill in both fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php include 'header.php'; ?>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 col-xl-4 col-lg-6 col-md-8 col-12">
        <h2 class="mb-4">Login</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" class="flex-grow-1 btn btn-green btn-lg rounded-pill">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>