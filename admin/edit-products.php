<?php
require("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM product WHERE id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        die("Product not found");
    }
} else {
    die("Invalid request");
}

// Fetch categories from the database
$categories = mysqli_query($conn, "SELECT * FROM categories");
?>

<!-- Your HTML Form -->
<section class="main-content columns is-fullheight">
    <?php require("sidebar.php"); ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">Edit product</p>
                </div>
                <div class="card-content">
                    <form method="post" action="update-product.php" enctype="multipart/form-data"
                        onsubmit="return validateForm(event)">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" name="name" value="<?php echo $product['name']; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Description</label>
                            <div class="control">
                                <input class="input" type="text" name="description"
                                    value="<?php echo $product['description']; ?>" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Price</label>
                            <div class="control">
                                <input class="input" type="text" name="price" value="<?php echo $product['price']; ?>"
                                    required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Stock</label>
                            <div class="control">
                                <input class="input" type="number" name="stock"
                                    value="<?php echo $product['stock']; ?>">
                            </div>
                            <div class="field">
                                <label class="label">Category</label>
                                <div class="control">
                                    <div class="select">
                                        <select name="category" required>
                                            <option value="" disabled>Select Category</option>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($categories)) {
                                                $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';
                                                echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
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
                                    <button class="button is-primary" type="submit">Update product</button>
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