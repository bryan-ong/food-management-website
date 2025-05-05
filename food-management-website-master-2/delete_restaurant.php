<?php
include 'util/db_connect.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'ADMIN') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restaurant_id'])) {
    $restaurant_id = intval($_POST['restaurant_id']);

    // Optional: You might want to delete related dishes or handle foreign key constraints.
    $stmt = $conn->prepare("DELETE FROM restaurants WHERE restaurant_id = ?");
    $stmt->bind_param("i", $restaurant_id);

    if ($stmt->execute()) {
        $message = "Restaurant deleted successfully.";
    } else {
        $message = "Error deleting restaurant: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all restaurants
$result = $conn->query("SELECT restaurant_id, restaurant_name FROM restaurants ORDER BY restaurant_name ASC");
?>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Delete a Restaurant</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" action="delete_restaurant.php">
        <div class="mb-3">
            <label for="restaurant_id" class="form-label">Select a restaurant to delete:</label>
            <select name="restaurant_id" id="restaurant_id" class="form-select" required>
                <option value="">-- Choose a restaurant --</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?= $row['restaurant_id'] ?>"><?= htmlspecialchars($row['restaurant_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this restaurant?')">Delete Restaurant</button>
    </form>
</div>

<?php include 'footer.php'; ?>