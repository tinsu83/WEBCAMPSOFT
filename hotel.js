function addFoodItem() {
    const foodItemsDiv = document.getElementById("foodItems");
    const foodItemDiv = document.createElement("div");
    foodItemDiv.className = "foodItem";
    foodItemDiv.innerHTML = `
        <input type="text" name="itemName[]" placeholder="Item Name" required>
        <input type="number" name="itemPrice[]" placeholder="Item Price" step="0.01" required>
        <input type="url" name="itemImage[]" placeholder="Image URL" required>
        <button type="button" onclick="removeFoodItem(this)">Remove</button>
    `;
    foodItemsDiv.appendChild(foodItemDiv);
}

function removeFoodItem(button) {
    const foodItemDiv = button.parentNode;
    foodItemDiv.parentNode.removeChild(foodItemDiv);
}

document.getElementById("hotelForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const hotelName = document.getElementById("hotelName").value;
    const foodItemNames = document.getElementsByName("itemName[]");
    const foodItemPrices = document.getElementsByName("itemPrice[]");
    const foodItemImages = document.getElementsByName("itemImage[]");

    const foodItems = {};

    for (let i = 0; i < foodItemNames.length; i++) {
        const itemName = foodItemNames[i].value;
        const itemPrice = parseFloat(foodItemPrices[i].value);
        const itemImage = foodItemImages[i].value;

        foodItems[itemName] = {
            price: itemPrice,
            image: itemImage
        };
    }

    const newHotel = {
        name: hotelName,
        foodItems: foodItems
    };

    console.log(newHotel); // You can send the new hotel data to the server for further processing

    // Optionally, you can display a success message or redirect the user to another page
    alert("Hotel added successfully!");
    window.location.href = "index.html"; // Redirect to another page
});