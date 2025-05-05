<?php
include 'util/db_connect.php';
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'ADMIN') {
    header('Location: index.php');
    exit;
}

$orders = $conn->query("SELECT o.order_id, o.user_id, u.username, o.grand_total, o.created_at 
                        FROM orders o 
                        JOIN users u ON o.user_id = u.user_id 
                        ORDER BY o.created_at DESC");
?>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Manage Orders</h2>

    <?php if ($orders->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?> (ID: <?= $row['user_id'] ?>)</td>
                    <td>$<?= $row['grand_total'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <a href="edit_order.php?id=<?= $row['order_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_order.php?id=<?= $row['order_id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
