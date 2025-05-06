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

$id = htmlspecialchars($restaurant['restaurant_id']);
$restaurant_name = htmlspecialchars($restaurant["restaurant_name"]);
$address = htmlspecialchars($restaurant['address']);
$open_time = htmlspecialchars($restaurant['open_time']);
$close_time = htmlspecialchars($restaurant['close_time']);
$image_url = htmlspecialchars($restaurant['image_url']);
$rating = htmlspecialchars($restaurant['rating']);
$price_range = htmlspecialchars($restaurant['price_range']);
$description = !empty($restaurant['description']) ? htmlspecialchars($restaurant['description']) : 'No description available';

switch (htmlspecialchars($restaurant['price_range'])) {
    case "LOW":
        $price = '$';
        break;
    case "MEDIUM":
        $price = '$$';
        break;
    case "HIGH":
        $price = '$$$';
        break;
    default:
        $price = 'Price not specified';
        break;
}
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<title><?= $restaurant_name ?></title>
<?php include 'header.php'; ?>
</head>

<body>
    <?php include "navbar.php"; ?>


    <div class="position-relative">
        <img src="<?= $image_url ?>"
            class="restaurant-banner w-100"
            alt="<?= $restaurant_name ?>"
            style="height: 300px; object-fit: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center px-5">
            <h1 class="text-white fw-bold m-0" style="font-size: max(7.5vw, 56px); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <?= $restaurant_name ?>
            </h1>
        </div>
    </div>

    <div class="d-flex col-12 col-md-6 col-lg-4 mx-auto my-5 rounded shadow-lg bg-green">
        <div class="rounded shadow-lg col-11 my-3 p-5 text-center bg-dark mx-auto">

            <div class="card-body d-flex flex-column flex-grow-1">
                <h3 class="card-title mb-3"><?= $restaurant_name ?></h3>
                <p class="lh-sm" style="height: 80px"><?= $address ?></p>
                <div class="d-flex justify-content-between text-muted" style="font-size: 80%">
                    <p>
                        <b><?= date('h:i A', strtotime($open_time)) ?></b>
                        -
                        <b><?= date('h:i A', strtotime($close_time)) ?></b>
                    </p>
                    <p>⭐ <b><?= $rating ?></b></p>
                </div>
                <p class="card-text" style="height: 60px; font-style: italic;">"<?= $description ?>"</p>
                <p class="card-text">Price Range: <b><?= $price ?></b></p>

                <a class="ms-auto card-text text-decoration-none fw-semibold" href="reviews.php?id=<?= $restaurant_id ?>">Reviews →</a>
            </div>
        </div>
    </div>


    <div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10" id="dishes-container">
        <?php
        echo '<script>';
        echo 'const products = [';
        $stmt = $conn->prepare("SELECT * FROM dishes WHERE restaurant_id = ?");
        $stmt->bind_param("i", $restaurant_id);
        $stmt->execute();

        $result = $stmt->get_result();

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
            echo '$(document).ready(function() { renderProducts(products, false, true); });';
            echo '</script>';
        } else {
            echo '<div class="col-10 mx-auto my-5 py-5 text-white text-center rounded-pill bg-dark shadow-lg"><h1>No dishes found!</h1></div>';
        }
        ?>
    </div>



    <?php include 'footer.php'; ?>