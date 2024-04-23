<!DOCTYPE html>
<html>
<head>
    <title>Food Menu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        /* Food category list */
        .food-category ul {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
            list-style: none;
            padding: 0;
        }

        /* Food category list item */
        .food-category li {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
        }

        /* Food category image */
        .food-category img {
            width: 100px;
            height: auto;
            border: 5px solid rgb(255, 255, 255);
        }
    </style>
</head>
<body>

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct hotel names from the hotels table
$query = "SELECT DISTINCT hotel FROM hotelss";
$result = $conn->query($query);

// Check if the query executed successfully
if ($result) {
    // Process each hotel
    while ($row = $result->fetch_assoc()) {
        $hotelName = $row['hotel'];

        // Display the hotel name as a header
        echo "<h3>{$hotelName}</h3>";

        // Retrieve food items for the current hotel
        $foodQuery = "SELECT * FROM hotelss WHERE hotel = '{$hotelName}'";
        $foodResult = $conn->query($foodQuery);

        // Check if the food items query executed successfully
        if ($foodResult) {
            // Display the food items in the desired HTML format
            echo "<ul class='food-category'>";
            while ($foodRow = $foodResult->fetch_assoc()) {
                $foodName = $foodRow['name'];
                $foodPrice = $foodRow['price'];
                $foodDescription = $foodRow['description'];
                $foodImage = $foodRow['image'];

                echo "<li>";
                echo "<img src='{$foodImage}' alt='{$foodName}'>";
                echo "<div class='food-info'>";
                echo "<span class='food-name'>{$foodName}</span>";
                echo "<span class='food-description'>{$foodDescription}</span>";
                echo "<span class='food-price'>{$foodPrice} Birr</span>";
                echo "<button class='add-to-cart'>Add to Cart</button>";
                echo "</div>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "Error retrieving food items: " . $conn->error;
        }
    }
} else {
    echo "Error retrieving hotels: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
</body>
</html>