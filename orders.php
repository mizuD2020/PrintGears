<?php
session_start();
include "header.php";

$user_id = $_SESSION['user']['id'];
$orders = mysqli_query($connection, "SELECT sticker.name, sticker.image, sticker.price, order_item.quantity FROM order_item JOIN sticker ON sticker.id = order_item.sticker_id JOIN `order` ON `order`.id = order_item.order_id WHERE `order`.user_id = $user_id");
if (mysqli_num_rows($orders) == 0) {
    die('<p>You have no orders.</p>');
}
$order_items = mysqli_fetch_all($orders, MYSQLI_ASSOC);
?>
<div class="container">
    <h1 class="my-4">My Orders</h1>
    <?php foreach ($order_items as $item) { ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $item['image'] ?>" class="img-fluid rounded-start"
                        alt="<?php echo $item['name'] ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['name'] ?></h5>
                        <p class="card-text">Price: <?php echo $item['price'] ?></p>
                        <p class="card-text">Quantity: <?php echo $item['quantity'] ?></p>
                        <p class="card-text">Total: <?php echo $item['price'] * $item['quantity'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>