<?php
session_start();
include "header.php";

$user_id = $_SESSION['user']['id'];

// Fetch orders
$orders = mysqli_query($connection, "SELECT sticker.name, sticker.image, sticker.price, order_item.quantity, `order`.order_date FROM order_item JOIN sticker ON sticker.id = order_item.sticker_id JOIN `order` ON `order`.id = order_item.order_id WHERE `order`.user_id = $user_id");

$order_items = mysqli_fetch_all($orders, MYSQLI_ASSOC);

$grand_total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<style>
    body {
        background-color: black;
    }

    h1 {
        color: white;
    }
</style>

<body>
    <div class="container">
        <h1 class="my-4">My Orders</h1>
        <?php if (!empty($order_items)) { ?>
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
                    <?php foreach ($order_items as $item) {
                        $total_price = $item['price'] * $item['quantity'];
                        $grand_total += $total_price;
                        ?>
                        <tr>
                            <td><img src="<?php echo $item['image'] ?>" class="img-fluid" style="max-height: 100px;"
                                    alt="<?php echo $item['name'] ?>"></td>
                            <td><?php echo $item['name'] ?></td>
                            <td>Rs <?php echo $item['price'] ?></td>
                            <td><?php echo $item['quantity'] ?></td>
                            <td>Rs <?php echo $total_price ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title">Grand Total: Rs <?php echo $grand_total; ?></h4>
                </div>
            </div>
            <a href="order_history.php" class="btn btn-info mt-3">History</a>
        <?php } else { ?>
            <p class="alert alert-warning">Your order has been placed. Check history for details.</p>
            <a href="order_history.php" class="btn btn-info mt-3">History</a>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>