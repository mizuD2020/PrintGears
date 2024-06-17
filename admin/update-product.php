<?php
session_start();
require ("dbconnect.php");
require ("../upload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $sticker_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    // Check if a new file was uploaded
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $uploaded_file = upload_file($file);

        if (!$uploaded_file) {
            $_SESSION['error_message'] = "Error occurred while uploading file";
            header("Location: stickkers.php");
            exit();
        }
    } else {
        // Keep existing image if no new file uploaded
        $uploaded_file = $_POST['current_image'];
    }
    if ($stock <= 0) {
        die('<div class="alert alert-danger">Stock must be greater than 0.</div>');
    }
    $sql = "UPDATE sticker SET name = ?, description = ?, price = ?, stock = ?, image = ?, category_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION['error_message'] = "Prepare statement failed: " . $conn->error;
        header("Location: stickkers.php");
        exit();
    }

    $stmt->bind_param("ssiissi", $name, $description, $price, $stock, $uploaded_file, $category, $sticker_id);

    if ($stmt->execute()) {
        // Set success message
        $_SESSION['success_message'] = "Sticker updated successfully";
    } else {
        $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['error_message'] = "Invalid request";
}

// Close the database connection
$conn->close();

// Redirect to stickers.php
header("Location: stickkers.php");
exit();
?>