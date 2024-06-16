<?php
session_start();
require ("dbconnect.php");
require ("../upload.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $category_id = $_POST['id'];
    $name = $_POST['name'];
    // Check if a new file was uploaded
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        $uploaded_file = upload_file($file);

        if (!$uploaded_file) {
            $_SESSION['error_message'] = "Error occurred while uploading file";
            header("Location: categories.php");
            exit();
        }
    } else {
        // Keep existing image if no new file uploaded
        $uploaded_file = $_POST['current_image'];
    }

    $sql = "UPDATE categories SET name = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION['error_message'] = "Prepare statement failed: " . $conn->error;
        header("Location: categories.php");
        exit();
    }

    $stmt->bind_param("ssi", $name, $uploaded_file, $category_id);

    if ($stmt->execute()) {
        // Set success message
        $_SESSION['success_message'] = "Category updated successfully";
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
header("Location: categories.php");
exit();
?>