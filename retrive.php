<?php
// Check if the user is logged in as admin
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Redirect to the login page if not logged in as admin
    header("Location: login.php");
    exit;
}

// Connect to the database and retrieve the data from the event_registration table
$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM event_registration";
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
    <h3>Event Registration Data:</h3>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
               
                <th>Phone</th>
                <th>Event Type</th>
                <th>Attendees</th>
                <th>Duration</th>
                <th>Service Type</th>
                <th>Created At</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['event_type']; ?></td>
                    <td><?php echo $row['attendees']; ?></td>
                    <td><?php echo $row['duration']; ?></td>
                    <td><?php echo $row['service_type']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No event registration data found.</p>
    <?php } ?>
</body>
</html>