<?php
require("dbconnect.php");

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $query = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    } else {
        die("Category not found");
    }
} 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $category_id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_FILES["image"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    $update_fields = [];
    if (!empty($name)) {
        $update_fields[] = "name='$name'";
    }
    if (!empty($image)) {
        $target_file = upload_file($_FILES["image"]);
        $update_fields[] = "image='$target_file'";
    }

    if (!empty($update_fields)) {
        $sql = "UPDATE categories SET " . implode(", ", $update_fields) . " WHERE id=$category_id";
        if (mysqli_query($conn, $sql)) {
            echo "<script>window.location = 'categories.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "No fields to update";
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="d-flex">
        <?php include("sidebar.php"); ?>
        <div class="main-content">
            <div class="container">
                <h2 class="mb-4">Edit Category</h2>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Category</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $category['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                <img src="<?php echo $category['image']; ?>" height="50" width="50" class="mt-2">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>