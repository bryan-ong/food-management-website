$(document).ready(function () {
    let cart = [];
    let subTotal = 0;

    $(document).on('click', '.add-to-cart-btn', function () {
        const productId = $(this).data('productId');
        addToCart(productId);
    });

    function addToCart(productId) {
        const product = products.find(p => p.id == productId);
        const existingItem = cart.find(item => item.id == productId);
        cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (existingItem) {
            existingItem.quantity += 1
        } else {
            cart.push({ ...product, quantity: 1 });
        }

        console.log(product.name, "added to cart");

        localStorage.setItem("cart", JSON.stringify(cart))

        // showAlert("${product.name} added to cart")
    }

    function renderCart() {
        $("#cart-items").empty();

        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        let subTotal = 0

        if (cart.length === 0) {
            $("#cart-items").text("Cart is Empty")
            return;
        }

        cart.forEach(item => {
            const cartItem = $(`
                <div>
                        <img src="${item.image}" style="object-fit: cover; height: 80px; width: 80px;" alt="${item.name}"></img>
                </div>
                
            `)

            $("#cart-items").append(cartItem);
        });

    }

    renderCart();

})