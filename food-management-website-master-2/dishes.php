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
                            <input class="form-check-input me-1" type="checkbox" value="<?= $cuisineType ?>">
                            <?= $cuisineType ?>
                        </label>

                    <?php endforeach; ?>

                </div>
            </ul>
        </div>
    </div>



    <script>
        // I'm just gonna do the functions here for better encapsulation
        let criteria = 'dish_name',
            direction = 'ASC';

        function fetchSortedDishes() {
            const selectedCuisines = [];
            $(".form-check-input:checked").each(function() {
                selectedCuisines.push($(this).val());
            });

            $.ajax({
                url: "util/get_dishes.php",
                method: "GET",
                data: {
                    criteria: criteria,
                    direction: direction,
                    selectedCuisines: selectedCuisines
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