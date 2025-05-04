<?php
require 'util/db_connect.php';

?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<title>Dishes</title>
<?php include 'header.php'; ?>
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10">
        <div class="dropdown px-5 p-3" style="z-index: 1;">
            <button class="btn btn-green rounded-pill dropdown-toggle" type="button" id="sortDropdownMenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                Sort by
            </button>
            <ul class="dropdown-menu dropdown-menu-dark rounded shadow-lg" aria-labelledby="sortDropdownMenu">
                <li class="sort-criteria update-sort dropdown-item active" id="dish_name">Alphabetical</li>
                <li class="sort-criteria update-sort dropdown-item" id="unit_price">Price</li>
                <li class="sort-criteria update-sort dropdown-item" id="date_added">Recently Added</li>
                <li class="sort-criteria update-sort dropdown-item" id="popularity">Popularity</li>
            </ul>
        </div>
        <div class="update-sort my-auto px-3 btn btn-green" id="sort-dir-btn">
            Ascending
        </div>
        <div class="dropdown px-5 p-3" style="z-index: 1;">
            <button class="btn btn-green rounded-pill dropdown-toggle" type="button" id="sortDropdownMenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                Cuisine
            </button>
            <ul class="dropdown-menu dropdown-menu-dark rounded shadow-lg" aria-labelledby="sortDropdownMenu">
                <div class="list-group">
                    <?php
                    $result = $conn->query("SHOW COLUMNS FROM `dishes` LIKE 'cuisine_type'");
                    $row = $result->fetch_assoc();
                    $type = $row['Type'];
                    $type = substr($type, 5, -1); // This will remove the enum( as well as )

                    $enumValues = str_getcsv($type, ',', "'");

                    foreach ($enumValues as $cuisineType):
                    ?>
                        <label class="dropdown-item list-group-item">
                            <input class="form-check-input cuisine-input me-1" type="checkbox" value="<?= $cuisineType ?>">
                            <?= $cuisineType ?>
                        </label>

                    <?php endforeach; ?>

                </div>
            </ul>
        </div>
        <div class="update-sort my-auto px-3 btn btn-green" id="vegetarian-toggle">
            Vegetarian
        </div>

        <div class="ms-5 d-flex align-items-center">
            <label class="me-2 text-white fw-semibold">Food</label>
            <input type="checkbox" class="my-auto form-check-input checkbox-green" name="food" checked style="height: 32px; width: 32px;">
        </div>

        <div class="ms-4 d-flex align-items-center">
            <label class="me-2 text-white fw-semibold">Drinks</label>
            <input type="checkbox" class="my-auto form-check-input checkbox-green" name="drinks" checked style="height: 32px; width: 32px;">
        </div>

        <svg class="search-icon ms-auto my-auto" style="transform: translateX(35px);" width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <input class="update-sort my-auto p-2 me-5 btn-green rounded w-25 dish-search-component" oninput="fetchSortedDishes()" placeholder="Search..." id="dish-search">
    </div>



    <script>
        // I'm just gonna do the functions here for better encapsulation
        let criteria = 'dish_name',
            direction = 'ASC';
        vegetarian = false;
        searchQuery = null;


        function fetchSortedDishes() {
            const selectedCuisines = [];
            $(".cuisine-input:checked").each(function() {
                selectedCuisines.push($(this).val());
            });

            const includeFood = $('input:checkbox[name=food]').is(':checked');
            const includeDrinks = $('input:checkbox[name=drinks]').is(':checked');

            console.log(selectedCuisines)

            const vegetarian = $("#vegetarian-toggle").hasClass("btn-green-pressed") == true ? true : false;

            const searchQuery = $("#dish-search").val();

            $.ajax({
                url: "util/get_dishes.php",
                method: "GET",
                data: {
                    criteria: criteria,
                    direction: direction,
                    selectedCuisines: selectedCuisines,
                    vegetarian: vegetarian,
                    search: searchQuery,
                    include_food: includeFood,
                    include_drinks: includeDrinks
                },
                success: function(response) {
                    const productList = JSON.parse(response);
                    renderProducts(productList);
                }
            });
        }


        $(document).ready(function() {
            fetchSortedDishes();
        });

        $("#sort-dir-btn").click(function() {
            direction = (direction === 'ASC') ? 'DESC' : 'ASC';
            $(this).text(direction === 'ASC' ? "Ascending" : "Descending");
            fetchSortedDishes();
        });


        $("#vegetarian-toggle").click(function() {
            $(this).toggleClass("btn-green-pressed");
            fetchSortedDishes();
        });

        $(".sort-criteria").click(function() {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            criteria = $(this).attr("id");
            fetchSortedDishes();
        });

        $(".form-check-input").change(function() {
            setTimeout(fetchSortedDishes, 50);
        });
    </script>

    <div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10" id="dishes-container">

    </div>


    <?php include 'footer.php'; ?>