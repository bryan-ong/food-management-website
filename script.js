$(document).ready(function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let subTotal = 0;

    $(document).on('click', '.add-to-cart-btn', function () {
        const productId = $(this).data('productId');
        addToCart(productId);
    });

    function addToCart(productId) {
        const existingItem = cart.find(item => item.id == productId);

        if (existingItem) {
            existingItem.quantity += 1
        } else {
            cart.push({ id: productId, quantity: 1 });
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    }

    async function renderCart() {
        subTotal = 0
        
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        
        
        if (cart.length === 0) {
            $("#cart-items").text("Cart is Empty")
            return;
        }
        
        const productPromises = cart.map(item =>
            $.get(`util/get_product_details.php?id=${item.id}`)
        );
        
        
        
        const products = await Promise.all(productPromises);
        $("#cart-items").empty();

        products.forEach((productJSON, index) => {
            if (productJSON.error) {
                return;
            }

            product = JSON.parse(productJSON)
            const quantity = cart[index].quantity
            const itemTotal = product.price * quantity;
            subTotal += itemTotal

            const cartItem = $(`
                    <div class="my-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="${product.image_url}" alt="${product.name}" class="rounded shadow-lg outline cart-image">
                                <div class="mx-auto">
                                    <h5>${product.name}</h5>
                                    <h6 class="mx-2 my-3">$${product.price}</h6>

                                </div>
                            </div>
                            <div class="align-items-center my-auto">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-light cart-increment-btn rounded-pill d-flex justify-content-center align-items-center" 
                                        style="width: 2rem; height: 2rem;" data-id="${product.id}">
                                            <b>-</b>
                                    </button>
                                    <p class="mx-2 my-0">${quantity}</p>
                                    <button class="btn btn-light cart-decrement-btn rounded-pill d-flex justify-content-center align-items-center" 
                                        style="width: 2rem; height: 2rem;" data-id="${product.id}">
                                            <b>+</b>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        </div>
                        <div class="d-flex">
                            <p class="ms-auto me-2"><b>Item Total</b>: $${itemTotal.toFixed(2)}</p>
                        </div>
                    `)



            $("#cart-items").append(cartItem);
        });
    }

    renderCart();

    $(document).on('click', '.cart-increment-btn', function () {
        const productId = $(this).data('id');
        editItem(productId, 1);
    });
    $(document).on('click', '.cart-decrement-btn', function () {
        const productId = $(this).data('id');
        editItem(productId, -1);
    });


    function editItem(productId, amount) {

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const item = cart.find(item => item.id == productId);

        if (item) {
            item.quantity = Math.max(1, item.quantity - amount);
            localStorage.setItem("cart", JSON.stringify(cart))
            renderCart()
        }
    }

    function showAlert(message) {
        const toast = $(".alert").text(message).append("body")

        $(toast).fadeIn().delay(2000).fadeOut().remove();
    }

})