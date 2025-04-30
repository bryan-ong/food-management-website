<?php
include 'db_connect.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $dish_name          = $_POST['dish_name'] ?? '';
    $unit_price         = (float)($_POST['unit_price'] ?? 0);
    $dish_description   = $_POST['dish_description'] ?? '';
    $restaurant_id      = (int)($_POST['restaurant_id'] ?? 0);
    $image_url          = $_POST['image_url'] ?? '';

    if (empty($dish_name) || empty($restaurant_id)) {
        $error_message = "Please fill all required fields";
    } else {
        // Prepare and execute SQL statement
        $sql = "INSERT INTO dishes (dish_name, unit_price, dish_description, restaurant_id, image_url) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sdsis", $dish_name, $unit_price, $dish_description, $restaurant_id, $image_url);

            if ($stmt->execute()) {
                $success_message = "Dish added successfully!";
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}
?>


    <title>Add Dish</title>
    <?php include 'util/header.php'; ?>
</head>


<body>

    <?php include 'util/navbar.php'; ?>


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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <a href="admin.php" class="text-decoration-none mb-5 btn btn-green rounded-pill">
                    <h3 class="my-auto align-items-center">Back to Dashboard</h3>
                </a>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="dish_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="unit_price" step="0.01" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="dish_description" required>
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
                                    echo "<option value='" . htmlspecialchars($restaurant['restaurant_id']) . "'>"
                                        . htmlspecialchars($restaurant['restaurant_name']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" class="form-control" name="image_url" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-lg btn-green rounded-pill mt-3">Add Dish</button>
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