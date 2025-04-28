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

    <?php include 'util/navbar.php'; ?>

    <div>
        <h1 class="mx-5 my-5" style="color:var(--grab-green)"> Welcome, admin<h1>
        <div>
        </div>
    </div>

        <div class="d-flex col-12 col-lg-10 gap-5 mx-auto align-items-center justify-content-center flex-wrap ">
            <a href="add_dish.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-light btn rounded-pill"><h1>Add a Dish</h1></a>
            <a href="add_restaurant.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-green btn rounded-pill"><h1>Add a Restaurant</h1></a>
            <a href="edit_dish.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-green btn rounded-pill"><h1>Edit Dish</h1></a>
            <a href="edit_restaurant.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-light btn rounded-pill"><h1>Edit Restaurant</h1></a>
        </div>

    

    <?php include 'util/footer.php'; ?>