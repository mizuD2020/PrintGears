<?php
// Include the database connection fileinclude "dbconnect.php";
include "dbconnect.php";
include "../upload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["itemName"];
    $description = $_POST["itemDescription"];
    $price = $_POST["itemPrice"];


    $file = $_FILES['itemImage'];

    $uploaded_file = upload_file($file);

    if (!$uploaded_file) {
        die("Error occured while uploading file");
    }

    $sql = "INSERT INTO items (Name, Description, Price, Images) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssds", $name, $description, $price, $uploaded_file);

    if ($stmt->execute()) {
        echo "Item added successfully";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>