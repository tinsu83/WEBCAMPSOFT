<?php
// Database configuration
$host = 'localhost';
$dbname = 'project';
$user = 'root';
$password = '';

try {
    // Connect to the database
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $user, $password);

    // Fetch all users while removing redundancies
    $query = "SELECT id, name, phoneNumber, address, foodItems, totalPrice, hotel FROM orders GROUP BY phoneNumber";
    $stmt = $conn->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the table
    echo '<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>';

    echo '<table>';
    echo '<thead>';
    echo '<tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Address</th><th>Food Items</th><th>Total Price</th><th>Hotel</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['id'] . '</td>';
        echo '<td>' . $user['name'] . '</td>';
        echo '<td>' . $user['phoneNumber'] . '</td>';
        echo '<td>' . $user['address'] . '</td>';
        echo '<td>' . $user['foodItems'] . '</td>';
        echo '<td>' . $user['totalPrice'] . '</td>';
        echo '<td>' . $user['hotel'] . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Connection failed: ' . $e->getMessage();
}
?>