<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $dish_id = filter_input(INPUT_POST, 'dish_id');
    $dish_name = filter_input(INPUT_POST, 'dish_name');
    $unit_price = filter_input(INPUT_POST, 'unit_price');
    $image_url = filter_input(INPUT_POST, 'image_url');
    $restaurant_id = filter_input(INPUT_POST, 'restaurant_id');
    $description = filter_input(INPUT_POST, 'description');

    if ($dish_id && $dish_name && $unit_price !== false && $image_url && $restaurant_id) {
        $stmt = $conn->prepare("UPDATE dishes SET 
            dish_name = ?, 
            unit_price = ?, 
            image_url = ?, 
            restaurant_id = ?, 
            dish_description = ?
            WHERE dish_id = ?");

        $stmt->bind_param(
            "sdsisi",
            $dish_name,
            $unit_price,
            $image_url,
            $restaurant_id,
            $description,
            $dish_id
        );

        if (!$stmt->execute()) {

            $error = "Error updating dish: " . $conn->error;
        } else {
            $error = "Invalid input data";
        }
    }
}

$dish_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$dish_id) {
    header("Location: dish.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM dishes WHERE dish_id = ?");
$stmt->bind_param("i", $dish_id);
$stmt->execute();
$result = $stmt->get_result();
$dish = $result->fetch_assoc();

if (!$dish) {
    header("Location: dish.php");
    exit();
}

$dish_name        = htmlspecialchars($dish['dish_name']);
$unit_price       = htmlspecialchars($dish['unit_price']);
$restaurant_id    = htmlspecialchars($dish['restaurant_id']);
$dish_description = htmlspecialchars($dish['dish_description']);
$image_url        = htmlspecialchars($dish['image_url']);
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'util/header.php'; ?>
</head>

<body>
    <?php include "util/navbar.php"; ?>


    <div class="position-relative">
        <img src="<?= $image_url ?>"
            class="restaurant-banner w-100"
            alt="<?= $dish_name ?>"
            style="height: 300px; object-fit: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center px-5">
            <h1 class="text-white fw-bold m-0" style="font-size: max(7.5vw, 56px); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <?= $dish_name ?>
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6"></div>

            <form method="POST">
                <input type="hidden" name="dish_id" value="<?= $dish_id ?>">

                <div class="mb-3">
                    <label class="form-label">Dish Name</label>
                    <input type="text" class="form-control" name="dish_name" value="<?= $dish_name ?>" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Unit Price</label>
                    <input type="number" class="form-control" name="unit_price" step="0.01" min="0" value="<?= $unit_price ?>" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input type="url" class="form-control" name="image_url" value="<?= $image_url ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Restaurant</label>
                    <select class="form-select" name="restaurant_id" required>
                        <option value="">Select a Restaurant</option>
                        <?php
                            $sql = "SELECT * FROM restaurants";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($restaurant = $result->fetch_assoc()) {
                                    $selected = ($restaurant['restaurant_id'] == $dish['restaurant_id']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($restaurant['restaurant_id']) . "' $selected>"
                                        . htmlspecialchars($restaurant['restaurant_name']) . "</option>";
                                }
                            }
                            ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dish Description</label>
                    <input type="text" class="form-control" value="<?= $dish_description ?>" name="description" placeholder="No Description Available">
                </div>
                <button type="submit" name="submit" class="btn btn-lg btn-green rounded-pill mt-3">Update Restaurant</button>
            </form>

        </div>
    </div>



    <?php
    $conn->close();

    include 'util/footer.php';
    ?>