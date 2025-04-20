import * as CONSTANTS from "./constants.js";

$(document).ready(function() {
    function displayProducts() {
        CONSTANTS.RESTAURANTS.forEach(restaurant => {
            const restaurantCard = $(`
                <div class="col-12 col-md-6 col-xl-4 gap-5 mb-5 px-2">
                    <div class="shadow-lg card restaurant-card" data-id="${restaurant.id}">
                        <img src="${restaurant.image}" class="restaurant-img" alt="${restaurant.name}">
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h5 class="card-title">${restaurant.name}</h5>
                            <p class="card-text">${restaurant.description || 'No description available'}</p>
                            <p class="card-text"><strong>${(restaurant.price)}</strong></p>
                        </div>
                    </div>
                </div>
            `);
            $("#restaurantList").append(restaurantCard);
        });
    }
    displayProducts();
});