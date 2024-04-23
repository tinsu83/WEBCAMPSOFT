<?php
if (isset($_POST['add'])) {
    // Retrieve the form data
    $foodData = $_POST['food_data'];

    // Handle the uploaded image files
    $targetDirectory = "uploads/";

    // Save the form data to the database (modify the database connection parameters accordingly)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the new food items into the hotels table
    foreach ($foodData as $index => $foodItem) {
        if (isset($foodItem['food_name']) && isset($foodItem['food_price']) && isset($foodItem['food_description']) && isset($foodItem['food_category']) && isset($foodItem['hotel_name'])) {
            $foodName = $conn->real_escape_string($foodItem['food_name']);
            $foodPrice = $conn->real_escape_string($foodItem['food_price']);
            $foodDescription = $conn->real_escape_string($foodItem['food_description']);
            $foodCategory = $conn->real_escape_string($foodItem['food_category']);
            $hotelName = $conn->real_escape_string($foodItem['hotel_name']);

            // Handle the uploaded image file
            $fileNames = $_FILES["food_image"]["name"][$index];
            $tmpNames = $_FILES["food_image"]["tmp_name"][$index];

            // Move the uploaded file(s) to the target directory
            $uploadedFiles = array();
            if (is_array($fileNames)) {
                foreach ($fileNames as $key => $fileName) {
                    $tmpName = $tmpNames[$key];
                    $targetFile = $targetDirectory . basename($fileName);

                    if (move_uploaded_file($tmpName, $targetFile)) {
                        $uploadedFiles[] = $targetFile;
                    } else {
                        echo "Error: Failed to move uploaded file.";
                    }
                }
            }

            // Construct the SQL query to insert the food item into the hotels table
            $insertQuery = "INSERT INTO hotelss (name, price, description, category, hotel, image) VALUES ('$foodName', '$foodPrice', '$foodDescription', '$foodCategory', '$hotelName', '" . implode(", ", $uploadedFiles) . "')";

            if ($conn->query($insertQuery) === true) {
                echo "<p>Food item added successfully!</p>";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Error: The form was not submitted correctly.";
}
?>