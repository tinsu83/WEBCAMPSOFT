<?php
// Modify the database connection parameters accordingly
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

// Specify the hotel name for filtering
$hotelName = "vectory"; // Replace with the desired hotel name

// Construct the SQL query to retrieve the data
$query = "SELECT id, name, foodItems, totalPrice, address FROM orders WHERE hotel = '$hotelName'";

// Execute the query
$result = $conn->query($query);

// Check if any results were found
if ($result->num_rows > 0) {
    // Output the data for each row
    while ($row = $result->fetch_assoc()) {
        $orderID = $row['id'];
        $name = $row['name'];
        $foodItems = $row['foodItems'];
        $totalPrice = $row['totalPrice'];
        $address = $row['address'];

        // Display the data
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Food Items:</strong> $foodItems</p>";
        echo "<p><strong>Total Price:</strong> $totalPrice</p>";
        echo "<p><strong>Address:</strong> $address</p>";

        // Display the confirm button and handle the confirmation
        echo "<form method='post'>";
        echo "<input type='hidden' name='orderID' value='$orderID'>";
        echo "<input type='submit' name='confirm' value='Confirm'>";
        echo "</form>";

        echo "<hr>";
    }
} else {
    echo "No orders found for the specified hotel.";
}

// Handle order confirmation
if (isset($_POST['confirm'])) {
    $orderID = $_POST['orderID'];

    // Construct the SQL query to update the order status to "confirmed"
    $updateQuery = "UPDATE orders SET status = 'confirmed' WHERE id = $orderID AND hotel = '$hotelName'";

    // Execute the update query
    if ($conn->query($updateQuery) === true) {
        echo "Order $orderID confirmed successfully.";
    } else {
        echo "Error updating order status: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>