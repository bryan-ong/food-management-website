<?php
include 'util/db_connect.php';
// if you’re not an admin, bounce out
if (!isset($_SESSION['user_id']) || !(in_array($user['role'] ?? '', ['ADMIN', 'SELLER']))) {
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

        <?php if (($user['role'] ?? '') == 'ADMIN'): ?>
        <a href="add_restaurant.php" class="col-10 col-lg-4 bg-green p-5 text-center text-decoration-none btn-green btn rounded-pill">
            <h1>Add a Restaurant</h1>
        </a>
        <?php endif ?>

        
        <a href="edit_restaurant.php" class="col-10 col-lg-8 bg-green p-5 text-center text-decoration-none btn-green btn rounded-pill">
            <h1>Edit 
            <?php if (($user['role'] ?? '') == 'ADMIN'): ?>
            
            Restaurant &
            
            <?php endif ?> Dishes</h1>
        </a>
    </div>



    <?php include 'footer.php'; ?>