<?php
include 'util/db_connect.php';

if (!isset($_SESSION['user_id']) || !(in_array($user['role'] ?? '', ['ADMIN', 'SELLER']))) {
    header('Location: index.php');
    exit;
}

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $dish_name          = $_POST['dish_name'] ?? '';
    $unit_price         = (float)($_POST['unit_price'] ?? 0);
    $dish_description   = $_POST['dish_description'] ?? '';
    $restaurant_id      = (int)($_POST['restaurant_id'] ?? 0);
    $image_url          = $_POST['image_url'] ?? '';
    $cuisine_type       = $_POST['cuisine_type'] ?? '';
    $vegetarian         = isset($_POST['vegetarian']) ? 1 : 0;
    // Prepare and execute SQL statement
    $sql = "INSERT INTO dishes (dish_name, unit_price, dish_description, restaurant_id, image_url, cuisine_type, vegetarian) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sdsissi", $dish_name, $unit_price, $dish_description, $restaurant_id, $image_url, $cuisine_type, $vegetarian);

        if ($stmt->execute()) {
            $success_message = "Dish added successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

?>

<title>Add Dish</title>
<?php include 'header.php'; ?>
</head>


<body>

    <?php include 'navbar.php'; ?>


    <div class="d-flex py-5 mb-5 justify-content-center align-items-center bg-green shadow-xlg">
        <div class="text-white text-center fs-1 w-100 fw-semibold">
            Add a Dish
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
                    <a href="dashboard.php" class="text-decoration-none mb-5 btn btn-green rounded-pill">
                        <h3 class="my-auto align-items-center">Back to Dashboard</h3>
                    </a>
                </div>

                <form method="POST">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="dish_name" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="unit_price" step="0.01" min="0" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" name="dish_description" required></textarea>
                            </div>

                            <?php if ($user['role'] == "ADMIN"): ?>

                                <div class="mb-4">
                                    <label class="form-label">Restaurant</label>
                                    <select class="form-select" name="restaurant_id" required>
                                        <option value="">Select a Restaurant</option>
                                        <?php
                                        $sql = "SELECT * FROM restaurants";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($restaurant = $result->fetch_assoc()) {
                                                echo "<option value='" . htmlspecialchars($restaurant['restaurant_id']) . "'>"
                                                    . htmlspecialchars($restaurant['restaurant_name']) . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            <?php elseif ($user['role'] === "SELLER"): ?>
                                <div class="mb-4">
                                    <label class="form-label">Restaurant</label>
                                    <select class="form-select" name="restaurant_id" required readonly>
                                        <?php
                                        $stmt = $conn->prepare("SELECT restaurant_id, restaurant_name FROM restaurants WHERE restaurant_id = ?");
                                        $stmt->bind_param("i", $user['restaurant_id']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . htmlspecialchars($row['restaurant_id']) . "' selected>"
                                                . htmlspecialchars($row['restaurant_name']) . "</option>";
                                        }
                                        $stmt->close();
                                        ?>
                                    </select>
                                </div>
                            <?php endif ?>

                            <div class="mb-4">
                                <label class="form-label">Cuisine</label>
                                <select class="form-select" name="cuisine_type" required>
                                    <option value="">Select a Cuisine</option>
                                    <?php
                                    $result = $conn->query("SHOW COLUMNS FROM `dishes` LIKE 'cuisine_type'");
                                    $row = $result->fetch_assoc();
                                    $type = $row['Type'];
                                    $type = substr($type, 5, -1); // This will remove the enum( as well as )

                                    $enumValues = str_getcsv($type, ',', "'");

                                    foreach ($enumValues as $cuisineType):
                                    ?>
                                        <option value="<?= $cuisineType ?>">
                                            <?= $cuisineType ?>
                                        </option>

                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4 d-flex align-items-center">
                                <label class="form-label me-3 mb-0">Vegetarian?</label>
                                <input type="checkbox" class="form-check-input" name="vegetarian" style="height: 24px; width: 24px;">
                            </div>


                            <div class="mb-4">
                                <label class="form-label">Image URL</label>
                                <input type="url" class="form-control" name="image_url" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-green rounded-pill btn-lg">Add Dish</button>
                            </div>
                </form>
            </div>
        </div>

    </main>

    <?php
    include 'footer.php';

    ?>