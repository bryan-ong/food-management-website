<?php
require 'util/db_connect.php';

if (!isset($_SESSION['user_id']) || !(in_array($user['role'] ?? '', ['ADMIN', 'SELLER']))) {
    header('Location: index.php');
    exit;
}

$success_message = '';
$error_message = '';

$dish_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (isset($_POST['remove-dish-btn'])) {
    $removeDishStmt = $conn->prepare("DELETE FROM dishes WHERE `dishes`.`dish_id` = ?");
    $removeDishStmt->bind_param("i", $dish_id);
    $removeDishStmt->execute();
    $removeDishStmt->close();

    header("Location: edit_restaurant.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $dish_id = filter_input(INPUT_POST, 'dish_id');
    $dish_name = filter_input(INPUT_POST, 'dish_name');
    $unit_price = filter_input(INPUT_POST, 'unit_price');
    $image_url = filter_input(INPUT_POST, 'image_url');
    $restaurant_id = filter_input(INPUT_POST, 'restaurant_id');
    $description = filter_input(INPUT_POST, 'description');
    $cuisine_type = filter_input(INPUT_POST, 'cuisine_type');
    $vegetarian = isset($_POST['vegetarian']) ? 1 : 0; // Cuz we are using checkboxes for this field

    if ($user['role'] == 'ADMIN') {
        if ($dish_id && $dish_name && $unit_price !== false && $image_url && $restaurant_id) { // Removed restaurant ID
            $stmt = $conn->prepare("UPDATE dishes SET 
                dish_name = ?, 
                unit_price = ?, 
                image_url = ?, 
                restaurant_id = ?, 
                dish_description = ?,
                cuisine_type = ?,
                vegetarian = ?
                WHERE dish_id = ?");

            $stmt->bind_param(
                "sdsissii",
                $dish_name,
                $unit_price,
                $image_url,
                $restaurant_id,
                $description,
                $cuisine_type,
                $vegetarian,
                $dish_id,
            );

            if ($stmt->execute()) {
                $success_message = "Dish updated successfully!";
            } else {
                $error_message = "Error updating dish: " . $stmt->error;
            }
        }
    } else {


        if ($dish_id && $dish_name && $unit_price !== false && $image_url) { // Removed restaurant ID
            $stmt = $conn->prepare("UPDATE dishes SET 
            dish_name = ?, 
            unit_price = ?, 
            image_url = ?, 
            -- restaurant_id = ?, 
            dish_description = ?,
            cuisine_type = ?,
            vegetarian = ?
            WHERE dish_id = ?");

            $stmt->bind_param(
                "sdsssii",
                $dish_name,
                $unit_price,
                $image_url,
                // $restaurant_id,
                $description,
                $cuisine_type,
                $vegetarian,
                $dish_id,
            );

            if ($stmt->execute()) {
                $success_message = "Dish updated successfully!";
            } else {
                $error_message = "Error updating dish: " . $stmt->error;
            }
        }
    }
}


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

$dish_name        = htmlspecialchars(string: $dish['dish_name']);
$unit_price       = htmlspecialchars($dish['unit_price']);
$restaurant_id    = htmlspecialchars($dish['restaurant_id']);
$dish_description = htmlspecialchars($dish['dish_description']);
$image_url        = htmlspecialchars($dish['image_url']);
$cuisine_type     = htmlspecialchars($dish['cuisine_type']);
$date_added       = htmlspecialchars($dish['date_added']);
$vegetarian       = htmlspecialchars($dish['vegetarian']);
?>

<?php include 'header.php'; ?>
</head>

<body>
    <?php include "navbar.php"; ?>

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

    <?php if ($success_message): ?>
        <div class="alert alert-success col-6 mt-3 mx-auto"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger col-6 mt-3 mx-auto"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>


    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="d-flex justify-content-center">
                    <a href="edit_restaurant.php" class="text-decoration-none mb-5 btn btn-green rounded-pill">
                        <h3 class="my-auto align-items-center">Back to Edit Restaurants</h3>
                    </a>
                </div>

                <form method="POST">
                    <input type="hidden" name="dish_id" value="<?= $dish_id ?>">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label">Dish Name</label>
                                    <button class="btn cart-remove-btn rounded-circle mb-1 p-0" type="submit" name="remove-dish-btn" style="height: 48px">
                                        <span class="text-muted">Remove Dish</span>
                                        <svg width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff3232">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ff3232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>

                                </div>
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

                            <?php if ($user['role'] == "ADMIN"): ?>
                                <div class="mb-3">
                                    <label class="form-label">Restaurant</label>
                                    <select class="form-select" name="restaurant_id" required>
                                        <?php
                                        $sql = "SELECT * FROM restaurants";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0):
                                            while ($restaurant = $result->fetch_assoc()):
                                                $selected = ($restaurant['restaurant_id'] == $restaurant_id) ? 'selected' : '';
                                        ?>
                                                <option value="<?= htmlspecialchars($restaurant['restaurant_id']) ?>" <?= $selected ?>>
                                                    <?= htmlspecialchars($restaurant['restaurant_name']) ?>
                                                </option>
                                        <?php
                                            endwhile;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            <?php endif ?>

                            <div class="mb-3">
                                <label class="form-label">Cuisine</label>
                                <select class="form-select" name="cuisine_type" required>
                                    <option value="">Select a Cuisine</option>
                                    <?php
                                    $result = $conn->query("SHOW COLUMNS FROM `dishes` LIKE 'cuisine_type'");
                                    $row = $result->fetch_assoc();
                                    $type = $row['Type'];
                                    $type = substr($type, 5, -1); // This will remove the 'enum(' as well as ')'

                                    $enumValues = str_getcsv($type, ',', enclosure: "'");

                                    foreach ($enumValues as $cuisineType):
                                        $selected = ($cuisine_type == $cuisineType) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $cuisineType ?>" <?= $selected ?>>
                                            <?= $cuisineType ?>
                                        </option>

                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <label class="form-label me-3 mb-0">Vegetarian?</label>
                                <input type="checkbox" class="form-check-input checkbox-green" name="vegetarian" <?= $vegetarian ? 'checked' : '' ?> style="height: 24px; width: 24px;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dish Description</label>
                                <textarea rows="3" class="form-control" name="description" placeholder="No Description Available"><?= $dish_description ?></textarea>
                            </div>
                            <div class="d-flex">
                                <button type="submit" name="submit" class="btn btn-lg btn-green rounded-pill flex-grow-1 mt-3">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>



        <?php
        include 'footer.php';
        ?>