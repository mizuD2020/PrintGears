<?php
ob_start();
session_start();
include "header.php";

$cart = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '{$_SESSION['user']['id']}'"));
if (!isset($cart['id'])) {
    die('<p>Your cart is empty.</p>');
}

$result = mysqli_query($connection, "
SELECT sticker.name, sticker.image, sticker.price, cart_item.quantity,cart_item.id 
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
                        <td>
                            <a href="edit_cart_item.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id'] ?>&table=cart_item" class="btn btn-danger" onclick="return confirm('Do you sure want to delete the cart item ?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" class="text-end">Total</td>
                    <td><?php echo $total ?></td>
                </tr>
            </tbody>
        </table>
        <?php
        if (isset($_POST['checkout'])) {
            $order = mysqli_query($connection, "INSERT INTO `order` (user_id, total) VALUES ('{$_SESSION['user']['id']}', '$total')");
            $order_id = mysqli_insert_id($connection);
            $cart_item = mysqli_query($connection, "SELECT * FROM cart_item WHERE cart_id = {$cart['id']}");
            while ($row = mysqli_fetch_assoc($cart_item)) {
                mysqli_query($connection, "UPDATE sticker SET is_sold=true WHERE id = '{$row['sticker_id']}'");
                mysqli_query($connection, "INSERT INTO order_item (order_id, sticker_id, quantity) VALUES ('$order_id', '{$row['sticker_id']}', '{$row['quantity']}')");
            }
            mysqli_query($connection, "DELETE FROM cart_item WHERE cart_id = {$cart['id']}");
            header("Location: orders.php");
            exit();
        } ?>

        <form method="post">
            <button class="btn btn-primary" type="submit" name="checkout">Checkout</button>

        </form>

    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>
</div>