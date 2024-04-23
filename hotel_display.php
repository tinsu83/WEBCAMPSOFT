<!DOCTYPE html>
<html>
<head>
    <title>Hotel Listing</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        .food-quantity {
            width: 40px;
            margin-right: 10px;
        }
        .food-info {
            margin-left: 10px;
        }
        .food-name {
            font-weight: bold;
        }
        .food-price {
            color: #888;
        }
        .add-to-cart {
            margin-left: auto;
        }
    </style>
</head>
<body>
<h1>Hotel Listing</h1>

<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch hotels from the database
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo '<h2 class="hotel-header">' . $row["name"] . '</h2>';

        $foodItems = json_decode($row["food_items"], true);
        echo '<ul>';
        foreach ($foodItems as $itemName => $itemData) {
            echo '<li>';
            echo '<input type="number" class="food-quantity" min="1" value="0">';
            echo '<img src="./IMG_20240403_141420_023.jpg" alt="Hotel Image">';
            echo '<div class="food-info">';
            echo '<span class="food-name">' . $itemName . '</span>';
            echo '<span class="food-price">$' . $itemData['price'] . '</span>';
            echo '</div>';
            echo '<button class="add-to-cart">Add to Cart</button>';
            echo '</li>';
        }
        echo '</ul>';

        echo '<p><strong>Price:</strong> $' . $row["price"] . '</p>';
        echo '<hr>';
    }

} else {
    echo "No hotels found.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>