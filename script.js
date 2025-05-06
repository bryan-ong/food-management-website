$(document).ready(function () {
    //////////////////////////////////////////////////////////////////////////////////
    // START OF DARK MODE FUNCTIONALITY

    $(document).on("click", "#switch-theme-btn", function () {
        if ($("html").attr("data-bs-theme") == "dark") {
            localStorage.setItem('theme', "light")
            $("html").attr("data-bs-theme", "light");
        } else {
            $("html").attr("data-bs-theme", "dark");
            localStorage.setItem('theme', "dark")
        }
    })

    $("html").attr("data-bs-theme", localStorage.getItem("theme"));

    // END OF DARK MODE FUNCTIONALITY
    //////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////
    // CART FUNCTIONALITY
    let cart = JSON.parse(localStorage.getItem("cart")) || [];


    $(document).on('click', '.add-to-cart-btn', function () {
        const productId = $(this).data('productId');
        addToCart(productId);
        $(this).text("Added to Cart");
        $(this).prop("disabled", true);
        setTimeout(() => {
            $(this).text("Add to Cart");
            $(this).prop("disabled", false);

        }, 500);
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



    renderCart();

    $(document).on('click', '.cart-increment-btn', function () {
        const productId = $(this).data('id');
        editItem(productId, 1, $(this));
    });
    $(document).on('click', '.cart-decrement-btn', function () {
        const productId = $(this).data('id');
        editItem(productId, -1, $(this));
    });

    $(document).on('click', '.cart-remove-btn', function () {
        const productId = $(this).data('id');

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const item = cart.find(item => item.id == productId);
        if (item) {
            cart.splice(cart.indexOf(item), 1);
            $(this).closest('.cart-item').remove();
            localStorage.setItem("cart", JSON.stringify(cart))
        }

        if (cart.length === 0) {
            $("#order-details").remove()
        }

        renderCart();
    });





    // END OF CART FUNCTIONALITY
    //////////////////////////////////////////////////////////////////////////////////




})

async function placeOrder() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const data = {
        grand_total: grandTotal.toFixed(2),
        cart: cart,
        destination: $("#destination-input").val(),
        delivery_type: $('input:radio[name=deliveryOption]:checked').val()
    }

    // console.log($('input:radio[name=deliveryOption]:checked').val())


    try {
        const response = await fetch("util/place_order.php", {
            method: 'POST',
            headers: {
                'Content-Type': "application/json",
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        console.log(result); // Log the response to see the parsed object

        if (result.success) {
            console.log('Inserted ID:', result.id);
            localStorage.setItem("cart", JSON.stringify([]));
            $("#cart-items").empty();
            $("#place-order-btn").text("Order Placed!");
            $("#place-order-btn").removeClass("btn btn-lg btn-green");
            $("#place-order-btn").addClass("alert alert-success fs-3 text-white fw-semibold bg-green");
            $("#place-order-btn").attr("disabled", true);
            $("#order-details").empty();
            $('#delivery-option-container').addClass('d-none');
            $('#destination-input').hide();
            $("#place-order-container").append(`
                <h4 class="text-center"><a href="orders.php" class="text-decoration-none">View my Orders</a></h4>
            `)
            renderCart();
        } else {
            console.error('Error:', result.error);
            $("#place-order-btn").text(result.error || "Error");
        }
    } catch (error) {
        console.error(error);
        $("#place-order-btn").text("Error");
    }

}


function renderProducts(productList, edit, showRestaurant) {
    $("#dishes-container").empty();
    // Too lazy to optimize this
    if (edit == true) {
        productList.forEach(dish => {
            $("#dishes-container").append(`
                <div class="col-12 col-md-6 col-xxl-4 gap-5 my-5 px-5">
    
                    <div class="shadow-lg card grub-card">
                        <img src="${dish.image_url}" class="grub-card-img" alt="${dish.name}">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h3 class="card-title mb-3" style="height: max(60px, 2vw)">${dish.name}</h3>
                            <p class="card-text" style="height: clamp(60px, 10vw, 80px)">${dish.description}</p>
                            <h5 class="card-text mb-3">$${dish.price}</h5>
                            <a href="edit_dish.php?id=${dish.id}" style="text-decoration: none" class="d-flex">
                                <button class="btn btn-green btn-lg flex-grow-1 rounded-pill shadow px-3 mx-3 d-block bg-green">
                                    Edit Dish
                                </button>
                            </a>
                        </div>
                    </div>
    
                </div>
            `)
        });
    } else {

        productList.forEach(dish => {
            const vegetarian = dish.vegetarian == true ? (`
                <svg height="24px" width="24px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#0b9e00;} </style> <g> <path class="st0" d="M476.188,24.146c-6.748-3.504-60.728,38.022-185.304,67.086C230.347,105.355,62.5,153.527,65.286,392.815 L0,431.218l20.338,35.598c63.073-40.692,236.014-120.042,409.766-323.621c0,0-26.875,134.419-334.096,311.056 c103.685,53.758,249.604,53.758,360.979-76.806C568.346,246.888,476.188,24.146,476.188,24.146z"></path> </g> </g></svg>
        `) : '';

            let restaurant_name = '';

            if (showRestaurant == true) {
                restaurant_name = dish.restaurant_name != null ? dish.restaurant_name : '';
            }

            $("#dishes-container").append(`
            <div class="col-12 col-md-6 col-xxl-4 gap-5 my-5 px-5">

                <div class="shadow-lg card grub-card" style="height:750px">
                    <img src="${dish.image_url}" class="grub-card-img" alt="${dish.name}">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <h3 class="card-title mb-3">
                            ${dish.name}
                            <br>
                        </h3>
                            <div class="text-muted d-flex justify-content-between" style="font-size: 14px; font-weight: lighter;">
                                <div>
                                    ${dish.cuisine_type} 
                                </div>
                                <div>
                                    ${restaurant_name}
                                </div>
                            </div>


                        <br>
                        <p class="card-text">
                        ${dish.description}
                        </p>

                        <div class="d-flex mt-auto justify-content-between"> 
                            <h5 class="card-text mb-3">
                                $${dish.price}
                            </h5>
                            ${vegetarian}
                        </div>

                        <button class="btn btn-green btn-lg add-to-cart rounded-pill shadow px-3 mx-3 my-1 d-block bg-green add-to-cart-btn"
                            data-product-id="${dish.id}">
                            Add to Cart
                        </button>

                    </div>
                </div>

            </div>
        `)
        });
    }

}

function editItem(productId, amount, button) {

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const item = cart.find(item => item.id == productId);


    if (item) {
        item.quantity -= amount;
        if (item.quantity <= 0) {
            cart.splice(cart.indexOf(item), 1)
            button.closest('.cart-item').remove();
        }
        localStorage.setItem("cart", JSON.stringify(cart))
    }
    renderCart()

    if (cart.length === 0) {
        $("#order-details").remove()
    }

    console.log(item)
}


async function renderCart() {
    subTotal = 0

    const cart = JSON.parse(localStorage.getItem("cart")) || [];


    if (cart.length === 0) {
        $("#cart-items").append(`<h4>Cart is Empty. <a class="text-decoration-none" href="restaurants.php"><b>Add some Items</b></a>.</h4`)
        return;
    }

    const dishPromises = cart.map(item =>
        $.get(`util/get_dish_details.php?id=${item.id}`)
    );

    const dishes = await Promise.all(dishPromises);
    $("#cart-items").empty();


    dishes.forEach((dish, index) => {

        const quantity = cart[index].quantity
        const itemTotal = dish.unit_price * quantity;
        subTotal += itemTotal

        const cartItem = $(`
            <div class="my-3 cart-item">
                <div class="d-flex flex-column flex-md-row justify-content-between">

                <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
                        <img src="${dish.image_url}" alt="${dish.dish_name}" class="rounded shadow-lg outline cart-image">
                        <div class="me-auto">
                            <h5>${dish.dish_name}</h5>
                            <h6 class="mx-2 my-3">$${dish.unit_price}</h6>
                        </div>
                    </div>
        

                    <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-3">
                        <button class="btn cart-remove-btn rounded-circle" style="width: 48px; height: 48px"data-id="${dish.dish_id}">
                            <svg width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff3232"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ff3232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </button>
        

                        <div class="d-flex align-items-center">
                            <button class="btn btn-light cart-increment-btn rounded-pill d-flex justify-content-center align-items-center" 
                                style="width: 2rem; height: 2rem;" data-id="${dish.dish_id}">
                                <b>-</b>
                            </button>
                            
                            <h4 class="mx-2 my-0">${quantity}</h4>
        
                            <button class="btn btn-light cart-decrement-btn rounded-pill d-flex justify-content-center align-items-center" 
                                style="width: 2rem; height: 2rem;" data-id="${dish.dish_id}">
                                <b>+</b>
                            </button>
                        </div>
                    </div>
                </div>
        
                <div class="d-flex justify-content-between mt-3">
                    <h5 class="ms-auto me-2"><b>Item Total</b>: $${itemTotal.toFixed(2)}</h5>
                </div>
        
                <hr class="cart-hr">
            </div>
        `);

        $("#cart-items").append(cartItem);

    });

    renderReceipt(subTotal)

};


function renderReceipt(subTotal) {
    $("#receipt").empty();
    if (subTotal != null) {

        const subTotalDisplay = $(`
            <div class="d-flex justify-content-between">
                <h5>Subtotal</h5>
                <h5>$${subTotal.toFixed(2)}</h5>
            </div>
        `)
        $("#receipt").append(subTotalDisplay)
    }


    const serviceTaxPercent = 0.06
    let serviceTax = subTotal * serviceTaxPercent;

    const serviceTaxDisplay = $(`
        <div class="d-flex justify-content-between">
            <h5>Service Tax (${serviceTaxPercent * 100}%)</h5>
            <h5>$${serviceTax.toFixed(2)}</h5>
        </div>
    `)

    $("#receipt").append(serviceTaxDisplay)

    const salesTaxPercent = 0.08
    let salesTax = subTotal * salesTaxPercent;

    const salesTaxDisplay = $(`
        <div class="d-flex justify-content-between">
            <h5>Sales Tax (${salesTaxPercent * 100}%)</h5>
            <h5>$${salesTax.toFixed(2)}</h5>
        </div>
    `)

    $("#receipt").append(salesTaxDisplay)

    let discount = subTotal * (discountPercentage / 100);
    const discountDisplay = $(`
        <div class="d-flex justify-content-between">
            <h5>Loyalty Discount (${discountPercentage}%)</h5>
            <h5>$${discount.toFixed(2)}</h5>
        </div>
    `)

    $("#receipt").append(discountDisplay)

    grandTotal = salesTax + serviceTax + subTotal - discount;

    const grandTotalDisplay = $(`
        <hr style="border-top: 2px dashed black; opacity: 100;">
        <div class="d-flex justify-content-between">
            <h5>Grand Total</h5>
            <h5>$${(grandTotal).toFixed(2)}</h5>
        </div>
    `)

    $("#receipt").append(grandTotalDisplay)

    // console.log(cart);

}

function renderReviews(reviews, role) {
    console.log(reviews.length)

    $("#review-container").empty();

    if (reviews.length === 0) {
        $("#review-container").text("Looks like no one has made a Review yet. Be the first to make one.");
        return
    }

    let deleteBtn = '';


    reviews.forEach(review => {
        if (role === 'ADMIN') {
            deleteBtn = `
                <form method="POST">
                    <input type="hidden" name="review_id" value="${review.review_id}">
                    <button class="btn cart-remove-btn rounded-circle my-auto w-auto h-auto p-0" type="submit" name="remove-review-btn" style="height: 48px">
                        <svg width="24px" height="24px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ff3232">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#ff3232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                        </svg>
                    </button>
                </form>
            `
        }

        let starCount = '';

        for (i = 0; i < review.rating; i++) {
            starCount += "&#11088"
        }


        const reviewElem = `
        <div class="my-3 bg-dark p-3 rounded shadow-lg flex-grow-1 w-100">
            <div class="d-flex justify-content-between flex-grow-1 w-100 mb-3 align-items-center">
                <div class="d-flex me-auto gap-3">
                    <img src="${review.pfp_url}" style="height:32px; width: 32px; object-fit:cover; pointer-events: none;" class="rounded-circle">
                    <h4>${review.username}</h4>
                </div>
                
                <div class="d-flex gap-3">
                    <h6 class="my-auto">${starCount}</h6>
                    <h6 class="text-muted fw-lighter my-auto">${review.created_at}</h6>
                    ${deleteBtn}
                </div>
            </div>


            ${review.comment}
            </div>
        `

        $("#review-container").append(reviewElem)

    });
}