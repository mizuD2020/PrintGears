<?php
ob_start();
session_start();

include "header.php";
include "upload.php";
?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = '50';
    $image = $_FILES['image'];
    $url = upload_file($image);
    if (!$url) {
        die("Error occured while uploading file");
    }
    $sql = "INSERT INTO customized_stickers (name, description, quantity, price, image) VALUES ('$name', '$description', '$quantity', '$price', '$url')";
    mysqli_query($connection, $sql);
    $sticker_id = mysqli_insert_id($connection);
    $user_id = $_SESSION['user']['id'];
    $existing_order = mysqli_fetch_assoc(mysqli_query($connection, "SELECT id from `order` where user_id = '$user_id'"));
    if ($existing_order) {
        $sql = "INSERT INTO order_item(order_id, sticker_id, quantity) VALUES ('$existing_order[id]', '$sticker_id', 1)";
        mysqli_query($connection, $sql);
    } else {
        $sql = "INSERT INTO `order` (user_id) VALUES ('$user_id')";
        mysqli_query($connection, $sql);
        $order_id = mysqli_insert_id($connection);
        $sql = "INSERT INTO order_item(order_id, sticker_id, quantity) VALUES ('$order_id', '$sticker_id', 1)";
    }

    header("Location: cart.php");
}
?>
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
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>