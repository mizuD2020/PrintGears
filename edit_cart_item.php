<?php
ob_start();
session_start();
include "header.php";


$id = $_GET['id'];
$cart_item = mysqli_fetch_assoc(mysqli_query($connection, "SELECT *, cart_item.quantity FROM cart_item JOIN sticker ON sticker.id = cart_item.sticker_id WHERE cart_item.id = $id"));
$stock = $cart_item['stock']; // Fetch stock value

if (isset($_POST['update'])) {
    $quantity = $_POST['quantity'];

    // Server-side validation for stock
    if ($quantity > $stock) {
        echo "<script>alert('Quantity exceeds available stock. Available stock: $stock');</script>";
    } else {
        mysqli_query($connection, "UPDATE cart_item SET quantity = $quantity WHERE id = $id");
        header("Location: cart.php");
    }
}

?>
<style>
    .form-label {
        color: white;
        font-size: 20px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <form method="post" onsubmit="return validateQuantity()">
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
                        value="<?php echo $cart_item['quantity'] ?>" data-stock="<?php echo $stock; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    function validateQuantity() {
        var quantityInput = document.getElementById('quantity');
        var quantity = parseInt(quantityInput.value);
        var stock = parseInt(quantityInput.getAttribute('data-stock'));

        if (quantity > stock) {
            alert('Quantity exceeds available stock. Available stock: ' + stock);
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>