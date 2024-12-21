<?php
ob_start();
session_start();

include "header.php";
include "upload.php";
$categories = mysqli_query($connection, "SELECT * FROM categories");
function checkCategory($category)
{
    if ($category == 'Custom') {
        return 'selected';
    } else {
        return 'disabled';
    }
}
?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = '50';
    $quantity = $_POST['stock'];
    $image = $_FILES['image'];
    $url = upload_file($image);

    if (!$url) {
        die("Error occured while uploading file");
    }
    $sql = "INSERT INTO product (name, description, category_id, image, price, stock, is_requested) VALUES ('$name', '$description', '$category', '$url', $price, '$quantity', true)";
    mysqli_query($connection, $sql);
    $product_id = mysqli_insert_id($connection);
    header("Location: add_to_cart.php?product_id=$product_id&quantity=$quantity");

}
?>
<style>
    .form-label {
        color: white;
        font-size: 20px;
    }

    .container {
        margin-top: 40px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="int" class="form-control" id="quantity" name="stock" rows="3" required></>
                </div>
                <input type="int" name="is_requested" value="1" hidden id="is_requested" />
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option>--Select One--</option>
                        <?php while ($category = mysqli_fetch_assoc($categories)) { ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo checkCategory($category['name']); ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>