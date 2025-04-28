<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img
                src="assets/logo.png"
                width="100"
                alt="Grub Logo"
                loading="lazy" />
        </a>
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
                    <a class="nav-link px-3" href="order.php">Find food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="order.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="restaurants.php">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="order.php">About us</a>
                </li>
            </ul>

            <ul class="navbar-nav mw-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item d-none d-lg-block">
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
                </li>
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
                            loading="lazy" />
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

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                const linkPage = link.getAttribute('href').split('/').pop();
                if (linkPage === currentPage) {
                    link.classList.add('active');
                    // Optional: Highlight parent li as well
                    link.closest('.nav-item').classList.add('active');
                }
            });
        });
    </script>