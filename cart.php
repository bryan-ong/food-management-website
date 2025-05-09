<?php
require_once 'util/db_connect.php';
?>

<!doctype html>
<html lang="en">

<title>My Cart</title>
<?php include 'header.php'; ?>
</head>


<body>

    <?php include 'navbar.php'; ?>

    <div class="d-flex py-5 mb-5 justify-content-center align-items-center bg-green shadow-xlg gap-3">

        <div class="nav-item d-block">
            <svg width="48" height="48" fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 902.86 902.86" xml:space="preserve" stroke="#08aa4c">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g>
                        <g>
                            <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"></path>
                            <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717 c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744 c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742 C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744 c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742 S619.162,694.432,619.162,716.897z"></path>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="nav-item d-block text-white">
            <h1>My Cart</h1>
        </div>

    </div>

    <div class="row g-0 mb-5">

        <div class="col-12 col-lg-8 pe-lg-3">
            <div class="p-4 ms-lg-5 mx-2 p-lg-5 shadow-lg rounded h-100" id="place-order-container">
                <h1>Items</h1>
                <hr class="cart-hr">
                <div id="cart-items"></div>
                <div class="d-flex justify-content-center flex-column mt-4">

                    <?php if (isset($_SESSION['user_id'])): ?>

                        <div class="d-flex justify-content-center gap-5 mb-4 align-items-center" id="delivery-option-container">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2" type="radio" value="DINE-IN" name="deliveryOption" id="dine-in-option">
                                <label class="form-check-label" for="dineInOption">
                                    <h4 class="mb-0">Dine-In</h4>
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2" type="radio" value="TAKEAWAY" name="deliveryOption" id="takeaway-option" checked>
                                <label class="form-check-label" for="takeawayOption">
                                    <h4 class="mb-0">Delivery</h4>
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="destination-input" onchange="validateDestinationInput()" placeholder="Enter Delivery Address" name="destination" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                        </div>

                        <?php if ($user['role'] == 'ADMIN'): ?>
                            <button class="btn btn-green btn-lg rounded-pill flex-grow-1 px-5" disabled>Admin accounts cannot place orders</button>
                        <?php elseif ($user['role'] == 'SELLER'): ?>
                            <button class="btn btn-green btn-lg rounded-pill flex-grow-1 px-5" disabled>Seller accounts cannot place orders</button>
                        <?php else: ?>
                            <button class="btn btn-green btn-lg rounded-pill flex-grow-1 px-5" id="place-order-btn" onclick="placeOrder()">Place Order</button>
                        <?php endif ?>

                        <script>
                            const $destinationInput = $("#destination-input");

                            function validateDestinationInput() {
                                $destinationInput.val() == '' ? $("#place-order-btn").prop("disabled", true) : $("#place-order-btn").prop("disabled", false);
                            }

                            const cart = JSON.parse(localStorage.getItem("cart") || "[]");
                            console.log(cart)

                            if (cart.length === 0) {
                                $("#place-order-btn").hide();
                                $('#delivery-option-container').addClass('d-none');
                                $('#destination-input').hide();
                            }

                            const discountPercentage = <?= json_encode($user['discount_percentage']) ?>;

                            $("#dine-in-option").click(function(e) {
                                $destinationInput.val('');
                                $destinationInput.attr('placeholder', "Enter Table Number");
                                $destinationInput.attr('type', "number");
                                $destinationInput.attr('step', "1");
                                $destinationInput.attr('min', "0");
                                validateDestinationInput();
                                console.log("DINE IN CICKED")

                            });

                            const address = <?php echo json_encode($user['address']) ?>

                            $("#takeaway-option").click(function(e) {
                                $destinationInput.attr('placeholder', "Enter Delivery Address");
                                $destinationInput.attr('type', "text");
                                $destinationInput.removeAttr("step");
                                $destinationInput.removeAttr("min");
                                $destinationInput.val(address);
                                validateDestinationInput();
                                console.log("TAKEAWAY CLICKED")
                            })
                        </script>
                    <?php else: ?>
                        <h2 class="text-center">You must log in to order</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-3 mt-4 mt-lg-0" style="
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

    <script>
        $(document).ready(function() {
            renderReceipt()
        });
    </script>

    <?php include 'footer.php'; ?>