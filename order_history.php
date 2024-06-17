<?php
session_start();
include "header.php";

$user_id = $_SESSION['user']['id'];

// Fetch order history
$order_history = mysqli_query($connection, "SELECT sticker.name, sticker.image, sticker.price, order_history.quantity, order_history.order_date, order_history.expected_delivery_date FROM order_history JOIN sticker ON sticker.id = order_history.sticker_id WHERE order_history.user_id = $user_id");

$history_items = mysqli_fetch_all($order_history, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Order History</h1>

        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-info"><?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?></div>
        <?php } ?>

        <?php if (!empty($history_items)) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Expected Delivery Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history_items as $item) { ?>
                        <tr>
                            <td><img src="<?php echo $item['image'] ?>" class="img-fluid" style="max-height: 100px;"
                                    alt="<?php echo $item['name'] ?>"></td>
                            <td><?php echo $item['name'] ?></td>
                            <td>Rs <?php echo $item['price'] ?></td>
                            <td><?php echo $item['quantity'] ?></td>
                            <td><?php echo date('F j, Y', strtotime($item['order_date'])); ?></td>
                            <td><?php echo date('F j, Y', strtotime($item['expected_delivery_date'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!--
            <form action="clear_history.php" method="post">
                <button type="submit" class="btn btn-danger mt-3">Clear History</button>
            </form>
                    -->
        <?php } else { ?>
            <p class="alert alert-info">You have no order history.</p>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>