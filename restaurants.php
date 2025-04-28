<?php
require_once 'db_connect.php';
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


    <div class="d-flex justify-content-center flex-wrap mt-5 col-12 px-3 mx-auto">
        <?php
        $sql = "SELECT * FROM restaurants";
        $result = $conn -> query($sql);
        if ($result -> num_rows > 0) {
            while ($restaurant = $result -> fetch_assoc()) {
                $id = htmlspecialchars($restaurant['restaurant_id']);
                $restaurant_name = htmlspecialchars($restaurant['restaurant_name']);
                $address = htmlspecialchars($restaurant['address']);
                $open_time = htmlspecialchars($restaurant['open_time']);
                $close_time = htmlspecialchars($restaurant['close_time']);
                $image_url = htmlspecialchars($restaurant['image_url']);
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

                $rating = htmlspecialchars($restaurant['rating']);

        ?>

                <div class="col-12 col-md-3 gap-5 mb-5 px-2">
                    <a href="restaurant.php?id=<?= $id ?>" style="text-decoration: none">

                        <div class="shadow-lg card restaurant-card">

                            <img src="<?= $image_url ?>" class="restaurant-img" alt="<?= $restaurant_name ?>">
                            <div class="card-body d-flex flex-column flex-grow-1">
                                <h3 class="card-title mb-3"><?= $restaurant_name ?></h3>
                                <p class="lh-sm"><?= $address ?></p>
                                <div class="d-flex justify-content-between" style="font-size: 80%">
                                    <p>
                                        <b><?= date('h:i A', strtotime($open_time)) ?></b>
                                        to
                                        <b><?= date('h:i A', strtotime($close_time)) ?></b>
                                    </p>
                                    <p>⭐ <b><?= $rating ?></b></p>
                                </div>
                                <p class="card-text"><?= $description ?></p>
                                <p class="card-text"><?= $price ?></p>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        } else {
            echo '<div class="col-12"><p>No restaurants found</p></div>';
        }
        $conn->close();
        ?>
    </div>

    </div>
    <?php include 'util/footer.php'; ?>