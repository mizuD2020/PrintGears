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
        die('<div class="alert alert-danger">Stock must be greater than 0.</div>');
    }

    $file = $_FILES['image'];
    $uploaded_file = upload_file($file);

    if (!$uploaded_file) {
        die("Error occurred while uploading file");
    }

    $sql = "INSERT INTO product (name, description, price, stock, image, category_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("ssiiss", $name, $description, $price, $stock, $uploaded_file, $category);

    if ($stmt->execute()) {
        echo "product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<section class="main-content columns is-fullheight">
    <?php require "sidebar.php"; ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">Add product</p>
                </div>
                <div class="card-content">
                    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm(event)">
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" name="name" placeholder="product Name" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <input class="input" type="text" name="description" placeholder="Description" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Price</label>
                            <div class="control">
                                <input class="input" type="text" name="price" placeholder="Price" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Stock</label>
                            <div class="control">
                                <input class="input" type="number" name="stock" placeholder="Stock" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Category</label>
                            <div class="control">
                                <div class="select">
                                    <select name="category" required>
                                        <option value="" disabled selected>Select Category</option>
                                        <?php
                                        while ($row = $categories->fetch_assoc()) {
                                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Image</label>
                            <div class="control">
                                <input class="input" type="file" name="image" required>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary" type="submit">Add product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function validateForm(event) {
        var stock = document.querySelector('input[name="stock"]').value;
        if (stock <= 0) {
            alert("Stock must be greater than 0.");
            event.preventDefault(); // Prevent the form from submitting
            return false;
        }
        return true;
    }
</script>