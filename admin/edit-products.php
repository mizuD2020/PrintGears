<?php
require("dbconnect.php");
require "../upload.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        die("Product not found");
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category'];
    $image = $_FILES["image"];
    $target_dir = "uploads/";

    $update_fields = [];
    if (!empty($name)) {
        $update_fields[] = "name='$name'";
    }
    if (!empty($description)) {
        $update_fields[] = "description='$description'";
    }
    if (!empty($price)) {
        $update_fields[] = "price='$price'";
    }
    if (!empty($stock)) {
        $update_fields[] = "stock='$stock'";
    }
    if (!empty($category_id)) {
        $update_fields[] = "category_id='$category_id'";
    }
    if (!empty($image)) {
        $target_file  = upload_file($image);
        $update_fields[] = "image='$target_file'";
    }

    if (!empty($update_fields)) {
        $sql = "UPDATE product SET " . implode(", ", $update_fields) . " WHERE id=$product_id";
        if (mysqli_query($conn, $sql)) {
            header("Location: products.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "No fields to update";
    }
} else {
    die("Invalid request");
}

// Fetch categories from the database
$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                <h2 class="mb-4">Edit Product</h2>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" min="1" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" min="1" id="stock" name="stock" value="<?php echo $product['stock']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
                                        <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $product['category_id']) echo 'selected'; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                <img src="<?php echo $product['image']; ?>" height="50" width="50" class="mt-2">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>