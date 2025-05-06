<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'util/db_connect.php';      // connect to db

// if not logged in, send to login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


if (isset($_POST['reset-pfp-btn'])) {
    $resetPfpStmt = $conn->prepare("UPDATE users SET pfp_url = 'assets/pfp.png' WHERE user_id = ?");
    $resetPfpStmt->bind_param("i", $_SESSION['user_id']);
    $resetPfpStmt->execute();
    $resetPfpStmt->close();

    header("Location: profile.php");
    exit;
}
if (isset($_POST['reset-number-btn'])) {
    $resetNumberStmt = $conn->prepare("UPDATE users SET phone_number = NULL WHERE user_id = ?");
    $resetNumberStmt->bind_param("i", $_SESSION['user_id']);
    $resetNumberStmt->execute();
    $resetNumberStmt->close();

    header("Location: profile.php");
    exit;
}
if (isset($_POST['reset-address-btn'])) {
    $resetAddressStmt = $conn->prepare("UPDATE users SET address = NULL WHERE user_id = ?");
    $resetAddressStmt->bind_param("i", $_SESSION['user_id']);
    $resetAddressStmt->execute();
    $resetAddressStmt->close();

    header("Location: profile.php");
    exit;
}


$error = '';
$success = '';

// handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The error / success methods were getting overriden 
    $updated = false;


    // grab inputs and trim
    $new_username   = trim($_POST['username'] ?? '');
    $new_email      = trim($_POST['email'] ?? '');
    $pfp_url        = trim($_POST['pfp_url'] ?? '');
    $phone_number   = trim($_POST['phone_number'] ?? '');
    $current_pass   = $_POST['current_password'] ?? '';
    $new_pass       = $_POST['new_password'] ?? '';
    $confirm_pass   = $_POST['confirm_password'] ?? '';
    $address        = $_POST['address'] ?? '';

    // update username & email
    if ($new_username && $new_email) {
        // Only change if there's change if not don't do anything
        if ($new_username !== $user['username'] || $new_email !== $user['email']) {
            $usernameEmailStmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
            $usernameEmailStmt->bind_param("ssi", $new_username, $new_email, $_SESSION['user_id']);
            if ($usernameEmailStmt->execute()) {
                $_SESSION['username'] = $new_username;
                $_SESSION['email'] = $new_email;
                $user['username'] = $new_username;
                $user['email'] = $new_email;

                $success = ' Profile updated.';
                $updated = true;
            } else {
                $error = ' Could not update profile';
            }
            $usernameEmailStmt->close();
        }
    }
    // handle password change
    // fetch current hash
    if ($current_pass && $new_pass) {
        if ($current_pass !== $user['password_hash']) {
            $passStmt = $conn->prepare("SELECT password_hash FROM users WHERE user_id = ?");
            $passStmt->bind_param("i", $_SESSION['user_id']);
            $passStmt->execute();
            $row = $passStmt->get_result()->fetch_assoc();
            $passStmt->close();

            if (password_verify($current_pass, $row['password_hash'])) {
                if ($new_pass === $confirm_pass) {
                    $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
                    $hashedPassStmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
                    $hashedPassStmt->bind_param("si", $new_hash, $_SESSION['user_id']);
                    if ($hashedPassStmt->execute()) {
                        $_SESSION['password_hash'] = $new_hash;
                        $user['password_hash'] = $new_hash;

                        $success .= ' Password changed. ';
                        $updated = true;
                    } else {
                        $error .= ' Could not update password. ';
                    }
                    $hashedPassStmt->close();
                } else {
                    $error .= ' New passwords do not match. ';
                }
            } else {
                $error .= ' Current password is incorrect. ';
            }
        }
    }


    if ($pfp_url) {
        if ($pfp_url !== $user['pfp_url']) {
            $pfpURLStmt = $conn->prepare("UPDATE users SET pfp_url = ? WHERE user_id = ?");
            $pfpURLStmt->bind_param("si", $pfp_url, $_SESSION['user_id']);
            if ($pfpURLStmt->execute()) {
                $_SESSION['pfp_url'] = $pfp_url;
                $user['pfp_url'] = $pfp_url;
                $success .= ' Profile picture updated. ';
                $updated = true;
            } else {
                $error .= ' Could not update profile picture. ';
            }
            $pfpURLStmt->close();
        }
    }

    if ($phone_number) {
        if ($phone_number !== $user['phone_number']) {
            $phoneNumberStmt = $conn->prepare("UPDATE users SET phone_number = ? WHERE user_id = ?");
            $phoneNumberStmt->bind_param("si", $phone_number, $_SESSION['user_id']);
            if ($phoneNumberStmt->execute()) {
                $_SESSION['phone_number'] = $phone_number;
                $user['phone_number'] = $phone_number;

                $success .= ' Phone number updated. ';
                $updated = true;
            } else {
                $error .= ' Could not update phone number. ';
            }
            $phoneNumberStmt->close();
        }
    }

    if ($address) {
        if ($address !== $user['address']) {
            $phoneNumberStmt = $conn->prepare("UPDATE users SET address = ? WHERE user_id = ?");
            $phoneNumberStmt->bind_param("si", $address, $_SESSION['user_id']);
            if ($phoneNumberStmt->execute()) {
                $_SESSION['address'] = $address;
                $user['address'] = $address;

                $success .= ' Delivery address updated. ';
                $updated = true;
            } else {
                $error .= ' Could not update address. ';
            }
            $phoneNumberStmt->close();
        }
    }

    if (!$updated && !$error) {
        $error = 'No changes submitted.';
    }
}

// Moved fetching user details to a helper method (user.php) as it needs to be used in other files too

?>
<title>Profile</title>

<?php include 'header.php'; ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="flex-grow-1">
        <?php include 'navbar.php'; ?>

        <main class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <h1>Hello, <?= htmlspecialchars($user['username']) ?>!</h1>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>

                    <form method="POST" class="mt-3">


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

                                <?php if ($user['role'] == 'USER'): ?>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <label class="form-label">Phone Number (XXX-XXXX-XXX)</label>
                                            <button class="btn cart-remove-btn rounded-circle mb-1 p-0" type="submit" name="reset-number-btn" style="width: 48px; height: 48px">
                                                <svg width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff3232">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ff3232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </button>

                                        </div>
                                        <input type="tel" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}" name="phone_number" class="form-control"
                                            value="<?= htmlspecialchars($user['phone_number']) ?>" minlength="7" maxlength="15">
                                        <!--Based on international phone number laws  -->

                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <label class="form-label">Delivery Address</label>

                                            <button class="btn cart-remove-btn rounded-circle mb-1 p-0" type="submit" name="reset-address-btn" style="width: 48px; height: 48px">
                                                <svg width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff3232">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ff3232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <input type="text" name="address" class="form-control"
                                            value="<?= htmlspecialchars($user['address']) ?>">
                                    </div>

                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <p>
                                                <span class="text-muted">Orders Made: </span><?= $user['orders_made'] ?>
                                            </p>

                                            <p>
                                                <span class="text-muted">Giving a discount of: </span>

                                                <?= $user['discount_percentage'] ?>%

                                            </p>
                                        </div>

                                    </div>

                                <?php endif; ?>

                                <div>
                                    <label class="form-label text-muted">Account Created:</label>
                                    <?= date('M j, Y', strtotime($user['created_at'])) ?>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Profile Picture</h5>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="pfp_url" class="form-label">Image URL</label>

                                        <button class="btn cart-remove-btn rounded-circle mb-1 p-0" type="submit" name="reset-pfp-btn" style="width: 48px; height: 48px">
                                            <svg width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff3232">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ff3232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>

                                    </div>
                                    <input type="text" class="form-control" id="pfp_url" name="pfp_url"
                                        value="<?= !empty($user['pfp_url']) ? htmlspecialchars($user['pfp_url']) : '' ?>">
                                </div>

                                <?php if (!empty($user['pfp_url'])): ?>
                                    <div class="d-flex justify-content-center">
                                        <img src="<?= htmlspecialchars($user['pfp_url']) ?>"
                                            style="height: 120px; width: 120px; object-fit: cover;"
                                            class="rounded-circle">
                                    </div>
                                <?php endif; ?>
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