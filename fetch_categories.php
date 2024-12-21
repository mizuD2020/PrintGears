<?php
// Include the database connection file
$servername = "localhost";
$username = "root";
$password = "";
$database = "PrintGears";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items from the database
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$categories = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each item to the $items array
        $categories[] = $row;
    }
}

// Close the database connection
$conn->close();

// Output items as JSON
header('Content-Type: application/json');
echo json_encode($items);
?>