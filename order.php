<?php
require_once 'util/db_connect.php';

$order_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


$stmt = $conn->prepare('SELECT * FROM order_items WHERE order_id = ?');
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

$orderItemData = [];

if ($result->num_rows > 0) {
    while ($rowData = $result->fetch_assoc()) {
        $orderItemData[] = $rowData;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order #<?= $order_id ?> </title>
    <?php include 'header.php'; ?>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 col-12">
        <div class="d-flex justify-content-between mb-4">
            <h2>Order #<?= $order_id ?> </h2>
            <a href="orders.php">
                <button class="btn-green rounded-pill p-2">Back to My Orders</button>
            </a>
        </div>


        <div class="d-flex align-items flex-wrap mb-5">
            <div class="card mb-4 me-auto col-md-8 col-12">
                <div class="card-body">
                    <h3>Items</h3>
                    <hr>
                    <div class="d-flex flex-wrap gap-3 justify-content-around" id="item-container">

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3 mt-4 ms-lg-3 ms-0 mt-lg-0" style="
                background-image: url('assets/receipt.png');
                background-size: 100% 100%;
                background-repeat: no-repeat;
                background-position: top;
                z-index: -1;">


                <div class="p-4 mx-2 p-lg-5 h-100 text-black">
                    <h1>Receipt</h1>
                    <hr style="border-top: 2px dashed black; opacity: 100;">
                    <div id="receipt"></div>
                </div>
            </div>
        </div>



    </div>

    <?php include 'footer.php'; ?>
</body>

</html>

<script>
    $(document).ready(function() {

        getOrderItems()
    });

    async function getOrderItems() {
        const orderData = <?php echo json_encode($orderItemData) ?>;


        const orderItemPromises = orderData.map(orderData =>
            $.get(`util/get_dish_details.php?id=${orderData.dish_id}`));

        console.log(orderData)

        const orderItems = await Promise.all(orderItemPromises);

        // console.log(orderItems)

        renderOrderItems(orderItems, orderData)
    }

    function renderOrderItems(orderItems, orderData) {
        subTotal = 0;
        orderItems.forEach((orderItem, index) => {
            let quantity = 0

            // Datum is the singular version for data
            orderDatum = orderData[index]

            if (orderItem.dish_id == orderDatum.dish_id) {
                quantity = orderDatum.quantity
            }

            const itemCard = `
            <div class="grub-card mt-3">
                <img src="${orderItem.image_url}" alt="${orderItem.dish_name}" class="grub-card-img object-fit-cover" style="height: 200px; width: 200px; filter: brightness(1);">
                <div class="text-center text-wrap p-2 fw-semibold" style="width: 200px">
                    ${orderItem.dish_name} 
                    <br>
                    <span class="text-muted fw-lighter">QTY: ${quantity}</span>
                </div>
            </div>
        `;
            $("#item-container").append(itemCard);

            subTotal += (orderItem.unit_price * quantity)
        });

        renderReceipt(subTotal)
    }
</script>