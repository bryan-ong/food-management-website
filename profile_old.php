<?php
session_start();
include 'util/db_connect.php';

// if not logged in, send them to login
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}


// fetch past orders
$stmt = $conn->prepare("
SELECT order_id, created_at
FROM orders
WHERE user_id = ?
ORDER BY created_at DESC
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<?php include 'header.php'; ?>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="flex-grow-1">
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 col-xl-4 col-lg-6 col-md-8 col-12">
      <h1>Hello, <?= htmlspecialchars($user['username']) ?>!</h1>
      <hr>

      <div class="card card-body">
        <p>
          <b>Email:</b>
          <?= htmlspecialchars($user['email']) ?>
        </p>
        <p>
          <b>Member since:</b>
          <?= date('M j, Y', strtotime($user['created_at'])) ?>
        </p>
        <a href="settings.php" class="btn btn-light rounded-pill">Edit profile</a>
      </div>


      <h3 class="mt-5">Your orders</h3>
      <hr>
      <?php if (empty($orders)): ?>
        <p>You haven't placed any orders yet.</p>
      <?php else: ?>
        <ul class="list-group">
          <?php foreach ($orders as $o): ?>
            <li class="list-group-item d-flex justify-content-between">
              <span>Order #<?= $o['order_id'] ?> on
                <?= date('M j, Y', strtotime($o['created_at'])) ?>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
  </div>
</body>

</html>