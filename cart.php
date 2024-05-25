<?php
session_start();
include "header.php";
include "Sign/dbconnection.php";
$cart = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '{$_SESSION['user']['id']}'"));
if (!isset($cart['id'])) {
    die('<p>Your cart is empty.</p>');
}

$result = mysqli_query($connection, "
SELECT sticker.name, sticker.image, sticker.price, cart_item.quantity
FROM cart_item
JOIN sticker ON sticker.id = cart_item.sticker_id
WHERE cart_item.cart_id = {$cart['id']}
");
?>
<div class="container">
    <h1 class="my-4">Your Cart</h1>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $total += $row['price'] * $row['quantity'];
                ?>
                    <tr>
                        <td><img src="<?php echo $row['image'] ?>" class="img-thumbnail" width="100"></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $row['price'] * $row['quantity'] ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" class="text-end">Total</td>
                    <td><?php echo $total ?></td>
                </tr>
            </tbody>
        </table>
        
            <button class="btn btn-primary" type="button">Checkout</button>
        
    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>
</div>