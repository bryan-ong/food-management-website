<?php
include 'db_connect.php';

$success_message = '';
$error_message = '';
$restaurant = [];
$all_restaurants = [];

$sql = "SELECT restaurant_id, restaurant_name, image_url FROM restaurants ORDER BY restaurant_name";
$result = $conn->query($sql);
if ($result) {
    $all_restaurants = $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['select_restaurant'])) {
        $id = (int)$_POST['select_restaurant'];
        $stmt = $conn->prepare("SELECT * FROM restaurants WHERE restaurant_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $restaurant = $result->fetch_assoc();
        $stmt->close();
    } elseif (isset($_POST['submit'])) {
        $id = (int)$_POST['restaurant_id'];
        $restaurant_name = $_POST['restaurant_name'] ?? '';
        $restaurant_name = $_POST['restaurant_name'] ?? '';
        $address = $_POST['address'] ?? '';
        $phone_number = $_POST['phone_number'] ?? '';
        $image_url = $_POST['image_url'] ?? '';
        $open_time = $_POST['open_time'] ?? '';
        $close_time = $_POST['close_time'] ?? '';
        $rating = (float)($_POST['rating'] ?? 0);
        $price_range = $_POST['price_range'] ?? '';
        $description = $_POST['description'] ?? '';

        $sql = "UPDATE restaurants SET 
                restaurant_name = ?, 
                address = ?, 
                phone_number = ?, 
                image_url = ?, 
                open_time = ?, 
                close_time = ?, 
                rating = ?, 
                price_range = ?, 
                description = ?
                WHERE restaurant_id = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                "ssssssdssi",
                $restaurant_name,
                $address,
                $phone_number,
                $image_url,
                $open_time,
                $close_time,
                $rating,
                $price_range,
                $description,
                $id
            );

            if ($stmt->execute()) {
                $success_message = "Restaurant updated successfully!";
                $restaurant = compact(
                    'restaurant_name',
                    'address',
                    'phone_number',
                    'image_url',
                    'open_time',
                    'close_time',
                    'rating',
                    'price_range',
                    'description'
                );
                $restaurant['restaurant_id'] = $id;
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Restaurant</title>
    <?php include 'util/header.php'; ?>
</head>

<script>
    function submitForm() {
        document.getElementById('restaurantSelectForm').submit();
    }
</script>

<body>

    <?php include 'util/navbar.php'; ?>

    <div class="mx-auto text-center flex-grow py-3 bg-green shadow-lg">
        <h1 class="mx-5 my-5 text-white">Edit Restaurant<h1>
    </div>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="admin.php" class="text-decoration-none" style="color: var(--grab-green)">
                    <h2 class="mb-5">
                        < Back to Dashboard</h2>
                </a>

                <div class="mb-5">
                    <h3 class="mb-4">Select a Restaurant to Edit</h3>
                    <div class="row">
                        <?php foreach ($all_restaurants as $r): ?>
                            <div class="col-6 col-md-3">
                                <form method="POST" class="h-100">
                                    <input type="hidden" name="select_restaurant" value="<?= $r['restaurant_id'] ?>">
                                    <div class="card restaurant-card h-100 <?= isset($restaurant['restaurant_id']) && $restaurant['restaurant_id'] == $r['restaurant_id'] ? 'selected-restaurant' : '' ?>">
                                        <?php if (!empty($r['image_url'])): ?>
                                            <img src="<?= htmlspecialchars($r['image_url']) ?>" class="card-img-top h-100" style="object-fit: cover;">
                                        <?php endif; ?>
                                        <div class="mx-auto my-2">
                                            <h5 class="card-title"><?= htmlspecialchars($r['restaurant_name']) ?></h5>
                                            <button type="submit" class="btn btn-sm btn-green rounded-pill text-center">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($restaurant)): ?>
                    <div class="mt-5 pt-4 border-top">
                        <h3 class="mb-4">Editing: <?= htmlspecialchars($restaurant['restaurant_name']) ?></h3>
                        <form method="POST">
                            <input type="hidden" name="restaurant_id" value="<?= htmlspecialchars($restaurant['restaurant_id']) ?>">
                            <div class="mb-3">
                                <label class="form-label">Restaurant Name</label>
                                <input type="text" class="form-control" name="restaurant_name" value="<?= htmlspecialchars($restaurant['restaurant_name']) ?>" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($restaurant['address']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Opening Hours</label>
                                <div class="d-flex justify-content-between align-items-center gap-5 fs-5">
                                    <input type="time" class="form-control" name="open_time" value="<?= htmlspecialchars($restaurant['open_time']) ?>" required>
                                    to
                                    <input type="time" class="form-control" name="close_time" value="<?= htmlspecialchars($restaurant['close_time']) ?>" required>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" value="<?= htmlspecialchars($restaurant['phone_number']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <input type="number" class="form-control" name="rating" step="0.05" min="0" max="5" value="<?= htmlspecialchars($restaurant['rating']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image URL</label>
                                <input type="url" class="form-control" name="image_url" value="<?= htmlspecialchars($restaurant['image_url']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price Range</label>
                                <select class="form-select" name="price_range" required>
                                    <option value="LOW" <?= htmlspecialchars($restaurant['price_range']) == 'LOW' ? 'selected' : '' ?>>$</option>
                                    <option value="MEDIUM" <?= htmlspecialchars($restaurant['price_range']) == 'MEDIUM' ? 'selected' : '' ?>>$$</option>
                                    <option value="HIGH" <?= htmlspecialchars($restaurant['price_range']) == 'HIGH' ? 'selected' : '' ?>>$$$</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Restaurant Description (optional)</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($restaurant['description']) ?>" name="description" placeholder="No Description Available">
                            </div>
                            <button type="submit" name="submit" class="btn btn-lg btn-green rounded-pill mt-3">Update Restaurant</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success col-6 mt-3 mx-auto"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger col-6 mt-3 mx-auto"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>
        </div>

        <?php

        include 'util/footer.php';

        ?>