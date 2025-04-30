<?php
require 'db_connect.php';

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
    <?php include 'util/header.php'; ?>
</head>

<body>
    <?php include "util/navbar.php"; ?>


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
            ]);
        }
    }
    echo '];';
    echo '</script>';

    $result->data_seek(0);
    if ($result->num_rows > 0) {
        echo '<div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10">';
        while ($dish = $result->fetch_assoc()) {
            $id = htmlspecialchars($dish['dish_id']);
            $name = htmlspecialchars($dish['dish_name']);
            $price = htmlspecialchars($dish['unit_price']);
            $description = htmlspecialchars($dish['dish_description']);
            $image_url = htmlspecialchars($dish['image_url']);
    ?>

            <div class="col-12 col-md-6 col-xxl-4 gap-5 my-5 px-5">

                <div class="shadow-lg card grub-card">
                    <img src="<?= $image_url ?>" class="grub-card-img" alt="<?= $name ?>">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <h3 class="card-title mb-3" style="height: max(60px, 2vw)"><?= $name ?></h3>
                        <p class="card-text" style="height: clamp(60px, 10vw, 80px)"><?= $description ?></p>
                        <h5 class="card-text mb-3">$<?= $price ?></h5>
                        <button class="btn btn-green btn-lg add-to-cart rounded-pill shadow px-3 mx-3 d-block bg-green add-to-cart-btn"
                            data-product-id="<?= $id ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
    <?php
        }
        echo '</div>';
    } else {
        echo '<div class="col-10 mx-auto my-5 py-5 text-white text-center rounded-pill bg-green shadow-lg"><h1>No dishes found!</h1></div>';
    }
    $conn->close();
    ?>

    <?php include 'util/footer.php'; ?>