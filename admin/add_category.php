<?php
// Include the database connection fileinclude "dbconnect.php";
include "dbconnect.php";
include "../upload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $file = $_FILES['itemImage'];

    $uploaded_file = upload_file($file);

    if (!$uploaded_file) {
        die("Error occured while uploading file");
    }

    $sql = "INSERT INTO items (Name, Images) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssds", $name, $uploaded_file);

    if ($stmt->execute()) {
        echo "Category added added successfully";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>