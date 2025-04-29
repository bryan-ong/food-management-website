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

    <div class="d-flex py-5 mb-5 justify-content-center align-items-center bg-green shadow-xlg gap-3">

        <li class="nav-item d-lg-block">
            <svg width="48" height="48" fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve" stroke="#08aa4c">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <g>
                            <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"></path>
                            <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717 c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744 c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742 C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744 c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742 S619.162,694.432,619.162,716.897z"></path>
                        </g>
                    </g>
                </g>
            </svg>
        </li>
        <li class="nav-item d-none d-lg-block text-white">
            <h1>My Cart</h1>
        </li>

    </div>

    <div class="d-flex col-11 mx-auto justify-content-center gap-5 p-5">

        <div class="col-8 p-4 bg-white shadow-lg rounded">
            <h1 class="">Items</h1>
            <hr>
            <div id="cart-items">
            </div>

        </div>
        <div class="col-4 p-4 bg-white shadow-lg rounded">
            dwad
        </div>

    </div>



    <?php include 'util/footer.php'; ?>