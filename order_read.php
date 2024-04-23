<?php
// Check if the user is logged in as admin
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Redirect to the login page if not logged in as admin
    header("Location: login.php");
    exit;
}

// Connect to the database and retrieve the data from the orders table
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, phoneNumber, address, foodItems, totalPrice, hotel, photo FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <h3>Orders Data:</h3>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Food Items</th>
                <th>Total Price</th>
                <th>Hotel</th>
                <th>Photo</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phoneNumber']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['foodItems']; ?></td>
                    <td><?php echo $row['totalPrice']; ?></td>
                    <td><?php echo $row['hotel']; ?></td>
                    <td><?php echo $row['photo']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No orders data found.</p>
    <?php } ?>
</body>
</html>