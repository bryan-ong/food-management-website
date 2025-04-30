<?php
include 'db_connect.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $restaurant_name = $_POST['restaurant_name'] ?? '';
    $address         = $_POST['address'] ?? '';
    $phone_number    = $_POST['phone_number'] ?? '';
    $image_url       = $_POST['image_url'] ?? '';
    $open_time       = $_POST['open_time'] ?? '';
    $close_time      = $_POST['close_time'] ?? '';
    $rating          = (float)($_POST['rating'] ?? 0);
    $price_range     = $_POST['price_range'] ?? '';
    $description     = $_POST['description'] ?? '';

    $sql = "INSERT INTO restaurants (restaurant_name, address, phone_number, image_url, open_time, close_time, rating, price_range, description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssdss", $restaurant_name, $address, $phone_number, $image_url, $open_time, $close_time, $rating, $price_range, $description);

        if ($stmt->execute()) {
            $success_message = "Restaurant added successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

    <title>Add Restaurant</title>
    <?php include 'util/header.php'; ?>
</head>


<body>

    <?php include 'util/navbar.php'; ?>

    <div class="d-flex py-5 mb-5 justify-content-center align-items-center bg-green shadow-xlg">
            <div class="text-white text-center fs-1 w-100 fw-semibold">
                Add a Restaurant
            </div>
        </div>


    <?php if ($success_message): ?>
        <div class="alert alert-success col-6 mt-3 mx-auto"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger col-6 mt-3 mx-auto"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <a href="admin.php" class="text-decoration-none mb-5 btn btn-green rounded-pill">
                    <h3 class="my-auto align-items-center">Back to Dashboard</h3>
                </a>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Restaurant Name</label>
                        <input type="text" class="form-control" name="restaurant_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Opening Hours</label>
                        <div class="d-flex justify-content-between align-items-center gap-5 fs-5">
                            <input type="time" class="form-control" name="open_time" required>
                            to
                            <input type="time" class="form-control" name="close_time" required>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <input type="number" class="form-control" name="rating" step="0.05" min="0" max="5" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" class="form-control" name="image_url" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price Range</label>
                        <select class="form-select" name="price_range" required>
                            <option value="LOW">$</option>
                            <option value="MEDIUM">$$</option>
                            <option value="HIGH">$$$</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Restaurant Description (optional)</label>
                        <input type="text" class="form-control" name="description">
                    </div>

                    <button type="submit" name="submit" class="btn btn-lg btn-green rounded-pill mt-3">Add Restaurant</button>
                </form>
            </div>
        </div>

    </div>

    <?php

    include 'util/footer.php';

    if (isset($conn)) {
        $conn->close();
    }

    ?>