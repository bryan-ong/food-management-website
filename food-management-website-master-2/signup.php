<?php
require_once 'util/db_connect.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Step 1: Check if all fields are filled
    if ($username && $email && $password && $confirm_password) {

        // Step 2: Check if username or email already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error = 'Username or email already exists.';
        } else {
            // Step 3: Check if passwords match
            if ($password !== $confirm_password) {
                $error = 'Passwords do not match.';
            } else {
                // Step 4: Hash the password and insert the new user into the database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare SQL to insert the new user
                $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role, created_at) VALUES (?, ?, ?, 'user', NOW())");
                $stmt->bind_param("sss", $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    $success = 'Registration successful! You can now <a href="login.php">login</a>.';
                } else {
                    $error = 'Error registering user. Please try again.';
                }
            }
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <?php include 'header.php'; ?>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 col-xl-4 col-lg-6 col-md-8 col-12">
        <h2 class="mb-4">Sign Up</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" class="flex-grow-1 btn btn-green btn-lg rounded-pill">Sign Up</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>