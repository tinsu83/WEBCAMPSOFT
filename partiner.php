<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $vehicle = $_POST['vehicle'];
    $license = $_POST['license'];
    $address = $_POST['address'];

    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'project';

    // Establish a connection to the MySQL database
    $connection = mysqli_connect($host, $username, $password, $database);

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the INSERT query
    $query = "INSERT INTO delivery_partnerss (name, email, phone, vehicle, license, address)
              VALUES ('$name', '$email', '$phone', '$vehicle', '$license', '$address')";

    // Execute the INSERT query
    if (mysqli_query($connection, $query)) {
        echo "Registration successful. Data has been inserted into the table.";
    } else {
        echo "Error executing the query: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>