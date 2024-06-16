<?php
require ("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $query = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    } else {
        die("category not found");
    }
} else {
    die("Invalid request");
}

// Fetch categories from the database
$categories = mysqli_query($conn, "SELECT * FROM categories");
?>


<section class="main-content columns is-fullheight">
    <?php require ("sidebar.php"); ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">Edit Category</p>
                </div>
                <div class="card-content">
                    <form method="post" action="update-category.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" name="name" value="<?php echo $category['name']; ?>"
                                    required>
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
                                <button class="button is-primary" type="submit">Update Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>