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


$stmt = $conn->prepare("SELECT o.order_id, o.user_id, o.created_at, o.delivery_type, o.address, o.table_number, o.status, u.username,
GROUP_CONCAT(CONCAT(d.dish_name, ' x', i.quantity) SEPARATOR ', ') AS dish_names_with_quantity 
FROM orders AS o
JOIN order_items AS i ON o.order_id = i.order_id
JOIN dishes AS d ON i.dish_id = d.dish_id
JOIN users AS u ON o.user_id = u.user_id
WHERE d.restaurant_id = ? 
GROUP BY o.order_id
ORDER BY o.order_id DESC


");


$stmt->bind_param("i", $user["restaurant_id"]);
$stmt->execute();
$result = $stmt->get_result();

// print_r($result);

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

<body style="overflow-x: auto;">
    <?php include 'navbar.php'; ?>

    <div class="mt-5 d-flex col-12 col-md-10 mx-auto flex-column">

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
                    <th scope="col">Customer</th>
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

            const cancelButton = rowData.status === "PENDING" ? `
                        <td>
                            <form method="POST">
                                <input type="hidden" name="order_id" value="${rowData.order_id}">
                                <input type="submit" name="cancel_order" value="Cancel" class="btn-red rounded-pill">
                            </form>
                        </td>
                    ` : '';

            const dish_names_with_quantity_array = rowData.dish_names_with_quantity.split(", ")

            // console.log(dish_names_with_quantity_array)

            let dish_names_with_quantity_elem = [];


            dish_names_with_quantity_array.forEach(dish => {
                dish_names_with_quantity_elem.push(`<li><input type="checkbox" ${rowData.status == 'COMPLETED' ? 'checked' : ''} ${rowData.status == 'CANCELLED' ? 'disabled' : ''}   class="ms-3 me-2 my-1 form-check-input checkbox-green ${rowData.order_id}">${dish}</input></li>`);
            });


            console.log(dish_names_with_quantity_elem)

            const orderElem = `
                    <tr class="align-middle">
                        <td class="overflow-auto">${rowData.order_id}</td>
                        <td class="overflow-auto">${rowData.username}</td>
                        <td class="overflow-auto">${rowData.created_at}</td>
                        <td class="overflow-auto">${rowData.delivery_type}</td>
                        <td class="overflow-auto">
                            <ul class="text-start list-unstyled my-auto">
                                ${dish_names_with_quantity_elem.join('')}
                            </ul>
                        </td>

                        <td class="destination-col text-truncate" style="max-width:250px">
                            ${destination}
                        </td>

                        <td class="overflow-auto ${color}">${rowData.status}</td>
                        ${cancelButton}
                    </tr>
                    `;

            $("#order-data").append(orderElem);

            $(`input.${rowData.order_id}`).change(function(e) {
                // console.log("Checked one box for Order: " + rowData.order_id)
                let selector = $(`input[type='checkbox'].${rowData.order_id}`);
                if (selector.length == selector.filter(":checked").length) {

                    console.log("All checked for Order: " + rowData.order_id)


                    $.ajax({
                        url: "util/update_order_status.php",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({
                            order_id: rowData.order_id
                        }),
                        success: function(response) {
                            console.log(response);

                            const orderRow = $(`input.${rowData.order_id}`).closest("tr").find("td");

                            orderRow.eq(6)
                                .removeClass("bg-warning bg-danger bg-dark")
                                .addClass("bg-success")
                                .text("COMPLETED");

                            orderRow.eq(7).remove();

                        },
                        error: function() {
                            console.error("Failed to update status of Order" + rowData.order_id);
                        }
                    });
                }
            });


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

        // Now to detect if all items have been filled

    });
</script>