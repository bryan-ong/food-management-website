<?php
require_once 'db_connect.php';

?>


<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grub. The Someday Something App</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>


<body class="overflow-hidden">

<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img
                    src="assets/logo.png"
                    width="100"
                    alt="Grub Logo"
                    loading="lazy"
            />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3 active" aria-current="page" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="order.html">Find food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="order.html">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-3" href="restaurants.html">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="order.html">About us</a>
                </li>
            </ul>

            <ul class="navbar-nav mw-auto mb-2 mb-lg-0">
                <li class="nav-item d-none d-lg-block">
                    <!-- Hide if not logged in -->
                    <a class="nav-link btn btn-green btn-lg rounded-pill shadow px-3 mx-3 d-block bg-green" aria-current="page" href="#">Sign Up</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <!-- Hide if not logged in -->
                    <a class="nav-link mx-3" aria-current="page" href="#">Login</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  d-flex align-items-center" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img
                                src="assets/pfp.png"
                                class="rounded-circle"
                                height="22"
                                alt="Generic Profile Picture"
                                loading="lazy"
                        />
                        <span class="d-lg-none ms-2">Account</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!--Somehow hide My Profile if not logged in?-->
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <!--We can hide these if already logged in-->
                        <li class="d-lg-none"><a class="dropdown-item" href="#">Sign Up</a></li>
                        <li class="d-lg-none"><a class="dropdown-item" href="#">Login</a></li>
                        <!--If we can, also hide this if not logged in-->
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="d-flex justify-content-center flex-wrap mt-5 col-12 px-3 col-lg-8 mx-auto" id="restaurantList">
<!--    Restaurants go here-->
</div>
</body>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script type="module" src="script.js"></script>

</html>