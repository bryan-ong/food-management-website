<?php
require_once 'util/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
    $orderId = $_POST['order_id'] ?? null;

    if ($orderId) {
        $stmt = $conn->prepare('SELECT status FROM `orders` WHERE order_id = ?');
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($row = $result->fetch_assoc()) {
            if ($row['status'] === "PENDING") {

                $stmt = $conn->prepare('UPDATE orders SET status = "CANCELLED" WHERE order_id = ?');
                $stmt->bind_param("i", $orderId);
                $_SESSION['status'] = "CANCELLED";

                if ($stmt->execute()) {
                    $success = "Successfully cancelled Order #$orderId";
                } else {
                    $error = "Couldn't cancel Order #$orderId";
                }

                $stmt->close();
            }
        }
    }
}


$stmt = $conn->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

$error = '';
$success = '';

if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        $orders[] = $order;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <?php include 'header.php'; ?>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 col-md-10 col-12">

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <h2 class="mb-4">My Orders</h2>

        <table class="table table-striped text-center table-hover rounded shadow-lg table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Delivery Type</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Status</th>
                    <th scope="col">Items</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody class="table-group-divider" id="order-data">

            </tbody>

        </table>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<script>
    $(document).ready(function() {
        const ordersData = <?php echo json_encode($orders) ?>;

        let destination = '';
        ordersData.forEach(rowData => {
            if (rowData.delivery_type == 'TAKEAWAY') {
                destination = rowData.address;
            } else {
                destination = "Table ".concat(rowData.table_number)
            }

            const cancelButton = rowData.status === "PENDING" ? `
    <td>
        <form method="POST">
            <input type="hidden" name="order_id" value="${rowData.order_id}">
            <input type="submit" name="cancel_order" value="Cancel" class="btn-red rounded-pill">
        </form>
    </td>
` : '<td></td>';


            let color = 'bg-dark'

            switch (rowData.status) {
                case "PENDING":
                    color = 'bg-warning'
                    break;
                case "CANCELLED":
                    color = 'bg-danger'
                    break;
                case "COMPLETED":
                    color = "bg-success"
                    break;
                default:
                    color = 'bg-dark';
            }


            const orderElem = `
                    <tr class="align-middle">
                        <td class="overflow-auto">${rowData.order_id}</td>
                        <td class="overflow-auto">$${rowData.grand_total}</td>
                        <td class="overflow-auto">${rowData.created_at}</td>
                        <td class="overflow-auto">${rowData.delivery_type}</td>

                        <td class="destination-col text-truncate" style="max-width:250px">
                            ${destination}
                        </td>



                        <td class="overflow-auto ${color}">${rowData.status}</td>
                        <td class="overflow-auto"><a href="order.php?id=${rowData.order_id}" style="text-decoration: none" class="fw-semibold">View Items</a></td>

                        ${cancelButton}
                    </tr>
            `;

            $("#order-data").append(orderElem);
        });

        $(".destination-col").hover(
            function() {
                $(this).addClass("text-wrap");
                $(this).removeClass("text-truncate");
            },
            function() {
                $(this).removeClass("text-wrap");
                $(this).addClass("text-truncate");
            }
        );


    });
</script>