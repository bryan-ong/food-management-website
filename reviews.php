<?php
require 'util/db_connect.php';

$restaurant_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$restaurant_id) {
    header("Location: restaurants.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'] ?? '';
    $comment = $_POST['comment'] ?? '';
    $rating = $_POST['rating'] ?? 0;

    if ($comment && $rating) {
        $stmt = $conn->prepare("INSERT INTO reviews (user_id, restaurant_id, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $user_id, $restaurant_id, $rating, $comment);
        if ($stmt->execute()) {
            header("Location: " . $_SERVER['REQUEST_URI'] . "&review_success=1");
            exit();
        } else {
            header("Location: " . $_SERVER['REQUEST_URI'] . "&review_error=1");
            exit();
        }
    }
}

if (isset($_POST['remove-review-btn']) && isset($_POST['review_id'])) {
    $reviewId = $_POST['review_id'];
    
    $resetPfpStmt = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
    $resetPfpStmt->bind_param("i",  $reviewId);
    $resetPfpStmt->execute();
    $resetPfpStmt->close();
}


$stmt = $conn->prepare("SELECT * FROM restaurants WHERE restaurant_id = ?");
$stmt->bind_param("i", $restaurant_id);
$stmt->execute();
$result = $stmt->get_result();
$restaurant = $result->fetch_assoc();

if (!$restaurant) {
    header("Location: restaurants.php");
    exit();
}
$restaurant_name = htmlspecialchars($restaurant['restaurant_name']);

?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<title><?= $restaurant_name ?></title>
<?php include 'header.php'; ?>
</head>

    <?php include "navbar.php"; ?>


    <div class="position-relative">
        <img src="<?= htmlspecialchars($restaurant['image_url']) ?>"
            class="restaurant-banner w-100"
            alt="<?= $restaurant_name ?>"
            style="height: 300px; object-fit: cover;">

        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center px-5">
            <h1 class="text-white fw-bold m-0" style="font-size: max(7.5vw, 56px); text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                <?= $restaurant_name ?>
            </h1>
        </div>
    </div>

    <?php if ($user['role'] == 'USER'): ?>

    <div class="card mb-b mt-5 col-12 col-lg-10 p-3 mx-auto">
        <div class="card-body">
            <h2 class="mb-3">Leave a Review</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea rows="4" class="form-control" name="comment" placeholder="Leave a review here..." required></textarea>
                </div>

                <p class="stars d-flex align-items-center gap-3">
                    <label class="myrating form-label my-auto fs-4">0</label>
                    <span class="stars">
                        <a class="star" id="1">⭐</a><a class="star" id="2">⭐</a><a class="star" id="3">⭐</a><a class="star" id="4">⭐</a><a class="star" id="5">⭐</a>
                    </span>

                    <input type="hidden" name="rating" required>
                </p>

                <div class="d-flex mt-4">
                    <button type="submit" class="flex-grow-1 btn btn-green btn-lg rounded-pill">Leave Review</button>
                </div>
            </form>

            
        </div>
    </div>

    <?php endif ?>
    
    
    <div class="d-flex mx-auto flex-wrap my-5 rounded shadow-lg bg-green col-12 col-lg-10 p-3" id="review-container">
        <?php
        $stmt = $conn->prepare("SELECT reviews.*, users.username, users.pfp_url FROM reviews JOIN users ON users.user_id = reviews.user_id WHERE reviews.restaurant_id = ? ORDER BY reviews.created_at DESC");
        $stmt->bind_param("i", $restaurant_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        // print_r($result);
        
        if ($result->num_rows > 0) {
            echo '<script>';
            echo 'const reviews = [';
            $first = true;
            while ($review = $result->fetch_assoc()) {
                if (!$first) echo ',';
                $first = false;
                
                $review['created_at'] = date("d/m/Y h:i A", strtotime($review['created_at']));
                
                
                echo json_encode($review);
            }
            echo '];';
            echo 'const userRole = ' . json_encode($user['role']) . ';';
            echo '$(document).ready(function() { renderReviews(reviews, userRole); });';
            echo '</script>';
        } else {
            echo '<div class="col-10 mx-auto my-5 py-5 text-white text-center rounded-pill bg-dark shadow-lg"><h1>No reviews found!</h1></div>';
        }
        ?>
    </div>
    
    <!-- https://stackoverflow.com/questions/67131651/how-to-implement-star-rating-using-simple-jquery-and-it-should-show-value-by-its -->
    <script>
        $('.stars a').on('click', function() {
            $('.stars span, .stars a').removeClass('active');
            
            $(this).addClass('active');
            $('.stars span').addClass('active');
                    $('.myrating').html($(this).attr("id"));

                    $(":input[name=rating]").val($(this).attr("id"));
                });

                $(':input[name=remove-review-btn]').click(function (e) { 
                    jqclose
                    
                });
            </script>

    <?php include 'footer.php'; ?>