<?php
include 'util/db_connect.php';
session_start();

// Must be logged in to leave feedback
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $restaurant_id = intval($_POST['restaurant_id']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    // Insert into reviews
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, restaurant_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $user_id, $restaurant_id, $rating, $comment);

    if ($stmt->execute()) {
        $message = "Thank you for your feedback!";
    } else {
        $message = "Failed to submit review: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch restaurants
$restaurants = $conn->query("SELECT restaurant_id, restaurant_name FROM restaurants ORDER BY restaurant_name ASC");
?>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Leave Feedback</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="feedback.php">
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Restaurant</label>
            <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                <option value="">-- Choose a restaurant --</option>
                <?php while ($row = $restaurants->fetch_assoc()): ?>
                    <option value="<?= $row['restaurant_id'] ?>"><?= htmlspecialchars($row['restaurant_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1–5)</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="">-- Select a rating --</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment (optional)</label>
            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-green">Submit Feedback</button>
    </form>
</div>

<?php include 'footer.php'; ?>


