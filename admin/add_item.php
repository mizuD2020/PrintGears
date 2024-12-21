<?php

// Include the database connection file
include "dbconnect.php";
include "../upload.php";

// Fetch categories from the database
$categories = mysqli_query($conn, "SELECT * FROM categories");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category = $_POST['category'];

if ($stock <= 0) {
        echo '<div class="alert alert-danger">Stock must be greater than 0.</div>';
        exit();
    }

    $file = $_FILES['image'];
    $uploaded_file = upload_file($file);

    if (!$uploaded_file) {
        echo "Error occurred while uploading file";
        exit();
    }

    $sql = "INSERT INTO product (name, description, price, stock, image, category_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Prepare statement failed: " . $conn->error;
        exit();
    }

    $stmt->bind_param("ssiiss", $name, $description, $price, $stock, $uploaded_file, $category);

    if ($stmt->execute()) {
        echo "Product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>