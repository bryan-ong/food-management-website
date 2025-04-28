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
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'util/header.php'; ?>
</head>

<body>
    <?php include "util/navbar.php"; ?>


    <div class="restaurant-image-banner">
        <img src="<?= htmlspecialchars($restaurant['image_url']) ?>" class="restaurant-banner" alt="<?= htmlspecialchars($restaurant['restaurant_name']) ?>">
    </div>

    <div class="px-5 fw-bold" style="padding-top: 20vh; color: white">
        <h1 style="font-size: max(7.5vw, 56px); z-index: 10;"><?= $restaurant_name ?></h1>
    </div>

    <?php
    $sql = "SELECT * FROM dishes WHERE restaurant_id = $restaurant_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10">';
        while ($dish = $result->fetch_assoc()) {
            $id          = htmlspecialchars($dish['dish_id']);
            $name        = htmlspecialchars($dish['dish_name']);
            $price       = htmlspecialchars($dish['unit_price']);
            $description = htmlspecialchars($dish['dish_description']);
            $image_url   = htmlspecialchars($dish['image_url']);
    ?>

            <div class="col-12 col-md-6 col-xl-4 gap-5 my-5 px-5">
                <a href="restaurant.php?id=<?= $id ?>" style="text-decoration: none">

                    <div class="shadow-lg card restaurant-card">
                        <img src="<?= $image_url ?>" class="restaurant-img" alt="<?= $name ?>">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h3 class="card-title mb-3"><?= $name ?></h3>
                            <p class="card-text" style="height: 60px"><?= $description ?></p>
                            <h5 class="card-text mb-3">$<?= $price ?></h5>
                            <button class="btn btn-green btn-lg rounded-pill shadow px-3 mx-3 d-block bg-green"> Add to Cart </button>
                        </div>
                    </div>
                </a>
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