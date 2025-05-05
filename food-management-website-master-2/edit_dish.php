<?php
require 'util/db_connect.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $dish_id = filter_input(INPUT_POST, 'dish_id');
    $dish_name = filter_input(INPUT_POST, 'dish_name');
    $unit_price = filter_input(INPUT_POST, 'unit_price');
    $image_url = filter_input(INPUT_POST, 'image_url');
    $restaurant_id = filter_input(INPUT_POST, 'restaurant_id');
    $description = filter_input(INPUT_POST, 'description');
    $cuisine_type = filter_input(INPUT_POST, 'cuisine_type');
    $vegetarian = isset($_POST['vegetarian']) ? 1 : 0; // Cuz we are using checkboxes for this field

    if ($dish_id && $dish_name && $unit_price !== false && $image_url && $restaurant_id) {
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
            "sdsissis",
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
                            <div class="mb-4">
                                <label class="form-label">Dish Name</label>
                                <input type="text" class="form-control" name="dish_name" value="<?= $dish_name ?>" required>
                            </div>


                            <div class="mb-4">
                                <label class="form-label">Unit Price</label>
                                <input type="number" class="form-control" name="unit_price" step="0.01" min="0" value="<?= $unit_price ?>" required>
                            </div>


                            <div class="mb-4">
                                <label class="form-label">Image URL</label>
                                <input type="url" class="form-control" name="image_url" value="<?= $image_url ?>" required>
                            </div>

                            <div class="mb-4">
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

                            <div class="mb-4">
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

                            <div class="mb-4 d-flex align-items-center">
                                <label class="form-label me-3 mb-0">Vegetarian?</label>
                                <input type="checkbox" class="form-check-input" name="vegetarian" <?= $vegetarian ? 'checked' : '' ?> style="height: 24px; width: 24px;">
                            </div>

                            <div class="mb-4">
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