<?php
ob_start();
session_start();
include "header.php";
$id = $_GET['id'];
$cart_item = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart_item join sticker on sticker.id = cart_item.sticker_id WHERE cart_item.id = $id"));
if (isset($_POST['update'])) {
    $quantity = $_POST['quantity'];
    mysqli_query($connection, "UPDATE cart_item SET quantity = $quantity WHERE id = $id");
    header("Location: cart.php");
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo $cart_item['name'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                        value="<?php echo $cart_item['price'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        value="<?php echo $cart_item['quantity'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>