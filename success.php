<?php
session_start();
include 'Sign/dbconnection.php';
$order_id = $_GET['id'];
$sql = "SELECT * FROM `order` WHERE id=$order_id";
$result = mysqli_query($connection, $sql);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    die('Order not found.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Payment Successful!</h4>
            <p>Your payment has been successfully processed.</p>
            <hr>
            <p class="mb-0">Order ID: <?php echo $order['id']; ?></p>
            <p class="mb-0">Payment Method: <?php echo $order['payment_method']; ?></p>
            <p class="mb-0">Status: <?php echo $order['order_status']; ?></p>
        </div>
        <a href="index.php" class="btn btn-primary">Go to Home</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>