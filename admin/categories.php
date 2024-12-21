<?php
session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['Role_as']) &&  $_SESSION['Role_as'] !== 1) {
    header("Location: ../Sign/SignIn.php");
    exit();
}
require("dbconnect.php");
$result = mysqli_query($conn, "SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        .table img {
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="d-flex">
        <?php include("sidebar.php"); ?>
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Category Management</h2>
                <a href="add_category.php" class="btn btn-primary mb-4">Add Category</a>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($result)) { 
                            $delete_url = '../delete.php?table=categories&id=' . $category['id'];
                            $edit_url = 'edit-category.php?id=' . $category['id'];
                        ?>
                            <tr>
                                <td><?php echo $category['name']; ?></td>
                                <td><img src="<?php echo $category['image']; ?>" height="30" width="30"></td>
                                <td>
                                    <a href="<?php echo $edit_url; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="<?php echo $delete_url; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>