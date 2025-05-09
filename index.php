<?php
require_once 'util/db_connect.php';
?>
<title>Grub. The Someday Something App</title>

<?php include 'header.php'; ?>

</head>


<body class="overflow-hidden">

    <?php include "navbar.php"; ?>

    <div class="image-container" style="z-index: 1;">
        <img src="assets/bg.png" class="background-img">
        <img src="assets/dish1.png" class="slide-up dish1" style="--delay: 0.2s">
        <img src="assets/dish2.png" class="slide-up dish2" style="--delay: 0.6s">
        <img src="assets/dish3.png" class="slide-up dish3" style="--delay: 0.4s">
        <img src="assets/dish4.png" class="slide-up dish4" style="--delay: 0.5s">
        <img src="assets/dish5.png" class="slide-up dish5" style="--delay: 0.3s">
    </div>

    <div>
        <div class="position-fixed top-50 start-0 end-0 d-flex py-5 justify-content-center align-items-center bg-green shadow-xlg"
            style="transform: translateY(-50%); z-index: 2;">
            <div class="text-white d-flex text-center w-100 slide-up my-auto" style="--delay: 1.2s; font-family: Serif; font-size: max(2.5vw, 28px);">
                <p class="my-auto mx-auto">
                    The best meals. Anytime, anywhere.
                </p>
            </div>
        </div>
        <div class="position-fixed top-50 d-none start-0 end-0 d-xl-flex justify-content-between px-4" style="transform: translateY(-50%); pointer-events: auto; z-index: 3;">
            <div style="width: 33%">
                <a href="restaurants.php" class="text-decoration-none">
                    <button class="btn btn-light btn-lg rounded-pill shadow px-4 py-2 mx-auto d-block" style="min-width: 120px;">
                        Order Now
                    </button>
                </a>
            </div>
            <div style="width: 33%">
                <a href="about.php" class="text-decoration-none">
                    <button class="btn btn-green btn-lg rounded-pill shadow px-4 py-2 mx-auto d-block" style="min-width: 120px;">
                        About Us
                    </button>
                </a>
            </div>
        </div>
        <div class="position-fixed bottom-50 start-0 end-0 d-flex d-xl-none justify-content-center gap-3 px-4 pb-4"
            style="z-index: 3; transform: translateY(130%);">
            <a href="restaurants.php" class="text-decoration-none">
                <button class="btn btn-light btn-lg rounded-pill shadow px-4 py-2">
                    Order Now
                </button>
            </a>

            <a href="about.php" class="text-decoration-none">
                <button class="btn btn-green btn-lg rounded-pill shadow px-4 py-2">
                    About Us
                </button>
            </a>
        </div>
    </div>

    <?php include 'footer.php'; ?>