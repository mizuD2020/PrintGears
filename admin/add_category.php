<?php
include "dbconnect.php";
include "../upload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];

    $file = $_FILES['image'];

    $uploaded_file = upload_file($file);

    if (!$uploaded_file) {
        die("Error occured while uploading file");
    }

    $sql = "INSERT INTO categories(name, image) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $name, $uploaded_file);

    if ($stmt->execute()) {
        header("Location: categories.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
<section class="main-content columns is-fullheight">
    <?php
    require "sidebar.php"; ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">Add Category</p>
                </div>
                <div class="card-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" name="name" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Image</label>
                            <div class="control">
                                <input class="input" type="file" name="image">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary" type="submit">Add Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>