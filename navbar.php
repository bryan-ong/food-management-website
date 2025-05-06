<?php require_once 'util/db_connect.php'; ?>

<nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary shadow-lg" style="z-index: 10;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img
                src="assets/logo.png"
                width="100"
                alt="Grub Logo"
                loading="lazy" />
        </a>

        <div class="d-flex flex-row ms-auto align-items-center d-lg-none my-auto gap-3 me-3">

            <svg class="bg-white rounded-circle" id="switch-theme-btn" width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" stroke="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                    <title>ic_fluent_dark_theme_24_regdivar</title>
                    <desc>Created with Sketch.</desc>
                    <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="ic_fluent_dark_theme_24_regular" fill="#212121" fill-rule="nonzero">
                            <path d="M12,22 C17.5228475,22 22,17.5228475 22,12 C22,6.4771525 17.5228475,2 12,2 C6.4771525,2 2,6.4771525 2,12 C2,17.5228475 6.4771525,22 12,22 Z M12,20.5 L12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 Z" id="🎨-Color"> </path>
                        </g>
                    </g>
                </g>
            </svg>

            <a href="cart.php">
                <svg width="24" height="24" fill="#08aa4c" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve" stroke="#08aa4c">
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
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="dishes.php">Find food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="restaurants.php">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="about.php">About us</a>
                </li>

                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo '
                    <hr>
                <li class="nav-item">
                    <a class="nav-link d-lg-none px-3 btn btn-green btn-lg rounded-pill shadow px-3 mx-auto col-6 bg-green" href="signup.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-lg-none text-center px-3 mx-auto" href="login.php">Login</a>
                </li>
                    ';
                }
                ?>
            </ul>

            <ul class="navbar-nav mw-auto mb-2 mb-lg-0 align-items-center gap-3">

                <li class="nav-item d-none d-lg-block" id="switch-theme-btn">
                    <svg class="bg-white rounded-circle" width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" stroke="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"> <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <title>ic_fluent_dark_theme_24_regular</title>
                            <desc>Created with Sketch.</desc>
                            <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="ic_fluent_dark_theme_24_regular" fill="#212121" fill-rule="nonzero">
                                    <path d="M12,22 C17.5228475,22 22,17.5228475 22,12 C22,6.4771525 17.5228475,2 12,2 C6.4771525,2 2,6.4771525 2,12 C2,17.5228475 6.4771525,22 12,22 Z M12,20.5 L12,3.5 C16.6944204,3.5 20.5,7.30557963 20.5,12 C20.5,16.6944204 16.6944204,20.5 12,20.5 Z" id="🎨-Color"> </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </li>

                <li class="nav-item d-none d-lg-block">
                    <a href="cart.php">
                        <svg width="24" height="24" fill="var(--grab-green)" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve" stroke="#08aa4c">
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
                    </a>
                </li>

                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo "
                    <li class='nav-item d-none d-lg-block'>
                        <!-- Hide if not logged in -->
                        <a class='nav-link btn btn-green btn-lg rounded-pill shadow px-3 mx-3 d-block bg-green' aria-current='page' href='signup.php'>Sign Up</a>
                    </li>
                    <li class='nav-item d-none d-lg-block'>
                        <!-- Hide if not logged in -->
                        <a class='nav-link mx-3' aria-current='page' href='login.php'>Login</a>
                    </li>";
                }
                ?>

                <li class="nav-item dropdown">
                    <?php


                    $src = $user['pfp_url'] ?? "assets/pfp.png";

                    if (isset($_SESSION['user_id'])) {

                        $orderElem = '';

                        if ($user['role'] == 'USER') {
                            $orderElem = '<li><a class="dropdown-item" href="orders.php">My Orders</a></li>';
                        } elseif ($user['role'] == 'SELLER') {
                            $orderElem = '<li><a class="dropdown-item" href="incoming_orders.php">Incoming Orders</a></li>';
                        }

                        echo '
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="' . htmlspecialchars($src) . '" 
                                    class="rounded-circle"
                                    style="height: 32px; width: 32px; object-fit:cover;"
                                    alt="Generic Profile Picture"
                                    loading="lazy" />
                                <span class="d-lg-none ms-2">Account</span>
                            </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                    ' . $orderElem . '
                                    <hr class="dropdown-divider">
                                    <li><a class="dropdown-item" href="util/logout.php">Logout</a></li>
                                    </li>
                                    ';
                    }


                    if (in_array($user['role'] ?? '', ['ADMIN', 'SELLER'])) {

                        echo '
                                    <li>
                                    <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                                    </li>
                                </ul>
                            ';
                    }

                    ?>
                    <!--Somehow hide My Profile if not logged in?-->
                    <!--We can hide these if already logged in-->
                    <!--If we can, also hide this if not logged in-->
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        const currentPage = location.pathname.split('/').pop();

        $('.navbar-nav .nav-link').each(function() {
            const $link = $(this);
            const linkPage = $link.attr('href').split('/').pop();

            if (!$link.hasClass('btn-green') && linkPage === currentPage) {
                $link.addClass('active');
                $link.closest('.nav-item').addClass('active');
            }
        });
    });
</script>