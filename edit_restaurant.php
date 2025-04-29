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

    <div class="d-flex py-5 mb-5 justify-content-center align-items-center bg-green shadow-xlg">
        <div class="text-white text-center fs-1 w-100 fw-semibold">
            Edit Restaurant and Dishes
        </div>
    </div>



    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="admin.php" class="text-decoration-none mb-5 btn btn-green rounded-pill">
                    <h3 class="my-auto align-items-center">Back to Dashboard</h3>
                </a>

                <div class="mb-0 pb-0">
                    <h3 class="mb-5">Select a Restaurant to Edit</h3>
                    <div class="row row-cols-2 row-cols-md-4 g-4">


                        <?php foreach ($all_restaurants as $r): ?>
                            <div class="col">
                                <form method="POST">
                                    <input type="hidden" name="select_restaurant" value="<?= $r['restaurant_id'] ?>">
                                    <div class="card grub-card h-75" <?= isset($restaurant['restaurant_id']) && $restaurant['restaurant_id'] == $r['restaurant_id'] ? 'selected-restaurant' : '' ?>">
                                        <?php if (!empty($r['image_url'])): ?>
                                            <div style="height: 80%;" class="card-image-container">
                                                <img src="<?= htmlspecialchars($r['image_url']) ?>"
                                                    class="card-img-top h-100 w-100 grub-card-img"
                                                    style="object-fit: cover; transition: transform 0.3s ease;">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body d-flex flex-column justify-content-between p-3">
                                            <h5 class="card-title text-center mb-3"><?= htmlspecialchars($r['restaurant_name']) ?></h5>
                                            <button type="submit" class="btn btn-green rounded-pill w-100">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php if (!empty($restaurant)): ?>


                    <div class="accordion" id="restaurantAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-green" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneRestaurant" aria-expanded="true" aria-controls="collapseOneRestaurant">
                                    <h2 class="text-white my-auto">Restaurant Details</h2>
                                </button>
                            </h2>
                            <div id="collapseOneRestaurant" class="accordion-collapse collapse show" data-bs-parent="#restaurantAccordion">
                                <div class="p-5">
                                    <?php if ($success_message): ?>
                                        <div class="alert alert-success col-12 mt-3 mx-auto"><?= htmlspecialchars($success_message) ?></div>
                                    <?php endif; ?>

                                    <?php if ($error_message): ?>
                                        <div class="alert alert-danger col-12 mt-3 mx-auto"><?= htmlspecialchars($error_message) ?></div>
                                    <?php endif; ?>

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







                            </div>



                            <div class="accordion" id="dishAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-green" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneDish" aria-expanded="true" aria-controls="collapseOneDish">
                                            <h2 class="text-white my-auto">Edit Restaurant's Dishes</h2>
                                        </button>
                                    </h2>
                                    <div id="collapseOneDish" class="accordion-collapse collapse show d-flex flex-wrap" data-bs-parent="#dishAccordion">

                                        <?php
                                        $sql = "SELECT * FROM dishes WHERE restaurant_id = $id";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($dish = $result->fetch_assoc()) {
                                                $id          = htmlspecialchars($dish['dish_id']);
                                                $name        = htmlspecialchars($dish['dish_name']);
                                                $price       = htmlspecialchars($dish['unit_price']);
                                                $description = htmlspecialchars($dish['dish_description']);
                                                $image_url   = htmlspecialchars($dish['image_url']);
                                        ?>

                                                <div class="col-4 my-5 px-5">
                                                    <a href="edit_dish.php?id=<?= $id ?>" style="text-decoration: none">

                                                        <div class="shadow-lg card grub-card">
                                                            <img src="<?= $image_url ?>" class="grub-card-img" style="height: 300px;" alt="<?= $name ?>">
                                                            <div class="card-body d-flex flex-column flex-grow-1">
                                                                <h5 class="card-title mb-0 text-center"><?= $name ?></h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo '<div class="col-10 mx-auto my-5 py-5 text-white text-center rounded-pill bg-green shadow-lg"><h1>No dishes found!</h1></div>';
                                        }
                                        $conn->close();
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php endif; ?>

            </div>



            <?php

            include 'util/footer.php';

            ?>