<?php
require 'util/db_connect.php';

$restaurant_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$restaurant_id) {
    header("Location: restaurants.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM restaurants WHERE restaurant_id = ?");
$stmt->bind_param("i", $restaurant_id);
$stmt->execute();
$result = $stmt->get_result();
$restaurant = $result->fetch_assoc();

if (!$restaurant) {
    header("Location: restaurants.php");
    exit();
}

$restaurant_name = htmlspecialchars($restaurant['restaurant_name'])
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<title><?= $restaurant_name ?></title>
<?php include 'header.php'; ?>
</head>

<body>
    <?php include "navbar.php"; ?>


    <div class="position-relative">
        <img src="<?= htmlspecialchars($restaurant['image_url']) ?>"
            class="restaurant-banner w-100"
            alt="<?= htmlspecialchars($restaurant['restaurant_name']) ?>"
            style="height: 300px; object-fit: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center px-5">
            <h1 class="text-white fw-bold m-0" style="font-size: max(7.5vw, 56px); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <?= htmlspecialchars($restaurant['restaurant_name']) ?>
            </h1>
        </div>
    </div>




    <div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10"  id="dishes-container">
            <?php
            echo '<script>';
            echo 'const products = [';
            $sql = "SELECT * FROM dishes WHERE restaurant_id = $restaurant_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $first = true;
                while ($dish = $result->fetch_assoc()) {
                    if (!$first) echo ',';
                    $first = false;
                    echo json_encode([
                        'id' => $dish['dish_id'],
                        'name' => $dish['dish_name'],
                        'price' => $dish['unit_price'],
                        'description' => $dish['dish_description'],
                        'image_url' => $dish['image_url'],
                        'cuisine_type' => $dish['cuisine_type'],
                        'vegetarian' => $dish['vegetarian']
                    ]);
                }
                echo '];';
                echo '$(document).ready(function() { renderProducts(products); });';
                echo '</script>';
            } else {
                echo '<div class="col-10 mx-auto my-5 py-5 text-white text-center rounded-pill bg-green shadow-lg"><h1>No dishes found!</h1></div>';
            }
            ?>
    </div>



    <?php include 'footer.php'; ?>