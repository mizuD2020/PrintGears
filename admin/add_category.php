<?php
include "../upload.php";
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['Role_as']) &&  $_SESSION['Role_as'] !== 1) {
    header("Location: ../Sign/SignIn.php");
    exit();
}
require("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $image = $_FILES["image"]["name"];
    $target_dir = "uploads/";
    $target_file = upload_file($_FILES["image"]);

        $sql = "INSERT INTO categories (name, image) VALUES ('$name', '$target_file')";
        if (mysqli_query($conn, $sql)) {
            echo "Category added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="d-flex">
        <?php include("sidebar.php"); ?>
        <div class="main-content">
            <div class="container">
                <h2 class="mb-4">Add Category</h2>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>