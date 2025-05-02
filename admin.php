<?php
include 'util/db_connect.php';
// start session so we know who’s here
if (session_status() === PHP_SESSION_NONE) session_start();
// if you’re not an admin, bounce out
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'ADMIN') {
    header('Location: index.php');
    exit;
}
?>

<?php include 'header.php'; ?>
</head>


<body>

    <?php include 'navbar.php'; ?>

    <div>
        <div class="d-flex py-5 mb-5 justify-content-center align-items-center bg-green shadow-xlg">
            <div class="text-white text-center fs-1 w-100 fw-semibold">
                Welcome, <?= htmlspecialchars($_SESSION['username']) ?>
            </div>
        </div>

        <div>
        </div>
    </div>

    <div class="d-flex col-12 col-lg-10 gap-5 mx-auto align-items-center justify-content-center flex-wrap ">
        <a href="add_dish.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-light btn rounded-pill">
            <h1>Add a Dish</h1>
        </a>
        <a href="add_restaurant.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-green btn rounded-pill">
            <h1>Add a Restaurant</h1>
        </a>
        <a href="edit_restaurant.php" class="col-10 col-lg-8 bg-green p-5 text-center text-decoration-none btn-green btn rounded-pill">
            <h1>Edit Restaurant & Dishes</h1>
        </a>
    </div>



    <?php include 'footer.php'; ?>