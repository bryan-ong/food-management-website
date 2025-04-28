<?php
include 'db_connect.php';

$success_message = '';
$error_message = '';
$dish = [];
$all_dishes = [];

$sql = "SELECT dish_id, dish_name FROM dishes ORDER BY dish_name";
$result = $conn->query($sql);
if ($result) {
    $all_dishes = $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dish_id']) && !isset($_POST['submit'])) {
        $dish_id = (int)$_POST['dish_id'];
        $stmt = $conn->prepare("SELECT * FROM dishes WHERE dish_id = ?");
        $stmt->bind_param("i", $dish_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $restaurant = $result->fetch_assoc();
        $stmt->close();
    } elseif (isset($_POST['submit'])) {
        $dish_id          = (int)($_POST['dish_id'] ?? '0');
        $dish_name        = $_POST['dish_name'] ?? '';
        $unit_price       = (float)($_POST['unit_price']) ?? '';
        $restaurant_id    = (int)($_POST['restaurant_id']) ?? '';
        $dish_description = $_POST['dish_description'] ?? '';
        $image_url        = $_POST['image_url'] ?? '';

        $sql = "UPDATE dishes SET 
                dish_name = ?, 
                unit_price = ?, 
                restaurant_id = ?, 
                dish_description = ?
                image_url = ?, 
                WHERE dish_id = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "sdissi",
                $dish_name,
                $unit_price,
                $restaurant_id,
                $dish_description,
                $image_url,
                $dish_id
            );


            if ($stmt->execute()) {
                $success_message = "Dish updated successfully!";

                $dish = compact(
                    'dish_name',
                    'unit_price',
                    'restaurant_id',
                    'dish_description',
                    'image_url',
                    'dish_id',
                );

            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    };
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

<!-- Method to submit form -->
<script>
    function submitForm() {
        document.getElementById('form').submit();
    }
</script>

<body>

    <?php include 'util/navbar.php'; ?>

    <div class="mx-auto text-center flex-grow py-3 bg-green shadow-lg">
        <h1 class="mx-5 my-5 text-white">Edit Dish<h1>
    </div>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <a href="admin.php" class="text-decoration-none" style="color: var(--grab-green)">
                    <h2 class="mb-5">
                        < Back to Dashboard</h2>
                </a>

                <form id="form" method="POST" class="mb-5">

                    
                    <div class="mb-3">
                        <label class="form-label">Select Restaurant</label>
                        <select class="form-select" name="restaurant_id" onchange="submitForm()">

                            <option value="">-- Select a Restaurant --</option>
                            <?php foreach ($all_restaurants as $r): ?>
                                <option value="<?= $r['restaurant_id'] ?>"
                                <?= isset($restaurant['restaurant_id']) && $restaurant['restaurant_id'] == $r['restaurant_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($r['restaurant_name']) ?>
                            </option>
                            <?php endforeach; ?>
                            
                        </select>
                    </div>
                </form>
                
                <?php if (!empty($restaurant)): ?>

                    <form method = "POST" class="mb-5">
                        <label class="form-label">Select Dish</label>

                        <option value="">-- Select a Dish --</option>
                            <?php foreach ($all_restaurants as $r): ?>
                                <option value="<?= $r['restaurant_id'] ?>"
                                <?= isset($restaurant['restaurant_id']) && $restaurant['restaurant_id'] == $r['restaurant_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($r['restaurant_name']) ?>
                            </option>
                            <?php endforeach; ?>

                    </form>


                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Restaurant Name</label>
                            <input type="text" class="form-control" name="restaurant_name" value="<?= $restaurant['restaurant_name'] ?>" required>
                        </div>

                        <input type="hidden" name="restaurant_id" value="<?= isset($restaurant['restaurant_id']) ? $restaurant['restaurant_id'] : '' ?>">

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?= $restaurant['address'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Opening Hours</label>
                            <div class="d-flex justify-content-between align-items-center gap-5 fs-5">
                                <input type="time" class="form-control" name="open_time" value="<?= $restaurant['open_time'] ?>" required>
                                to
                                <input type="time" class="form-control" name="close_time" value="<?= $restaurant['close_time'] ?>" required>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="<?= $restaurant['phone_number'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <input type="number" class="form-control" name="rating" step="0.05" min="0" max="5" value="<?= $restaurant['rating'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image URL</label>
                            <input type="url" class="form-control" name="image_url" value="<?= $restaurant['image_url'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price Range</label>
                            <select class="form-select" name="price_range" required>
                                <option value="LOW" <?= $restaurant['price_range'] == 'LOW' ? 'selected' : '' ?>>$</option>
                                <option value="MEDIUM" <?= $restaurant['price_range'] == 'MEDIUM' ? 'selected' : '' ?>>$$</option>
                                <option value="HIGH" <?= $restaurant['price_range'] == 'HIGH' ? 'selected' : '' ?>>$$$</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Restaurant Description (optional)</label>
                            <input type="text" class="form-control" value="<?= ($restaurant['description']) ?>" name="description" placeholder="No Description Available">
                        </div>

                        <button type="submit" name="submit" class="btn btn-lg btn-green rounded-pill mt-3">Update Restaurant</button>
                    </form>
                <?php endif; ?>
            </div>
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