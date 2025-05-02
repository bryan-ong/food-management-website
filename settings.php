<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'util/db_connect.php';      // connect to db

// if not logged in, send to login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

// handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // grab inputs
    $new_username   = trim($_POST['username'] ?? '');
    $new_email      = trim($_POST['email'] ?? '');
    $pfp_url = trim($_POST['pfp_url'] ?? '');
    $current_pass   = $_POST['current_password'] ?? '';
    $new_pass       = $_POST['new_password'] ?? '';
    $confirm_pass   = $_POST['confirm_password'] ?? '';

    // update username & email
    if ($new_username && $new_email) {
        $stmt = $conn->prepare("
            UPDATE users
            SET username = ?, email = ?
            WHERE user_id = ?
        ");
        $stmt->bind_param("ssi", $new_username, $new_email, $_SESSION['user_id']);
        if ($stmt->execute()) {
            $success = 'Profile updated';
            $_SESSION['username'] = $new_username; // update session name
        } else {
            $error = 'Could not update profile';
        }
        $stmt->close();
    }

    // handle password change
    if ($current_pass && $new_pass) {
        // fetch current hash
        $stmt2 = $conn->prepare("
            SELECT password_hash
            FROM users
            WHERE user_id = ?
        ");
        $stmt2->bind_param("i", $_SESSION['user_id']);
        $stmt2->execute();
        $row = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();

        if (password_verify($current_pass, $row['password_hash'])) {
            if ($new_pass === $confirm_pass) {
                $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                $stmt3 = $conn->prepare("
                    UPDATE users
                    SET password_hash = ?
                    WHERE user_id = ?
                ");
                $stmt3->bind_param("si", $new_hash, $_SESSION['user_id']);
                if ($stmt3->execute()) {
                    $success .= ' and password changed';
                } else {
                    $error = 'Could not update password';
                }
                $stmt3->close();
            } else {
                $error = 'New passwords do not match';
            }
        } else {
            $error = 'Current password is wrong';
        }
    }

    if ($pfp_url) {
        $stmt5 = $conn->prepare("
        UPDATE users
        SET pfp_url = ?
        WHERE user_id = ?
    ");
        $stmt5->bind_param("si", $pfp_url, $_SESSION['user_id']);

        if ($stmt5->execute()) {
            $success = 'Profile picture updated';
            $_SESSION['pfp_url'] = $pfp_url;
        } else {
            $error = 'Could not update profile picture: ' . $stmt5->error;
        }
        $stmt5->close();
    }

    
}

// Moved fetching user details to a helper method (user.php) as it needs to be used in other files too

?>

<?php include 'header.php'; ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="flex-grow-1">
        <?php include 'navbar.php'; ?>

        <main class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <h2 class="mb-4">Settings</h2>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Profile Picture</h5>
                                <div class="mb-3">
                                    <label for="pfp_url" class="form-label">Image URL</label>
                                    <input type="url" class="form-control" id="pfp_url" name="pfp_url"
                                        value="<?= !empty($user['pfp_url']) ? htmlspecialchars($user['pfp_url']) : '' ?>">
                                </div>
                                <?php if (!empty($user['pfp_url'])): ?>
                                    <div class="d-flex justify-content-center">
                                        <img src="<?= htmlspecialchars($user['pfp_url']) ?>"
                                            style="height: 120px;"
                                            class="rounded-circle">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Account Information</h5>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control"
                                    value="<?= htmlspecialchars($user['username']) ?>" required>
                                    </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($user['email']) ?>" required>
                                    </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password">
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                </div>
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-green rounded-pill btn-lg">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>