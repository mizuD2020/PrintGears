<?php
session_start();
require("dbconnect.php");
if (!isset($_SESSION['user']) && !isset($_SESSION['Role_as']) &&  $_SESSION['Role_as'] !== 1) {
    header("Location: ../Sign/SignIn.php");
    exit();
}
if (isset($_POST['mark_delivered'])) {
    $order_id = $_POST['order_id'];
    $query = "UPDATE `order` SET order_status='Delivered' WHERE id=$order_id";
    if (mysqli_query($conn, $query)) {
        header("Location: orders.php");
        exit();
    } else {
        die("Error updating record: " . mysqli_error($conn));
    }
}
$result = mysqli_query($conn, "SELECT user.fullname, `order`.* FROM `order` join user on `order`.user_id = user.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="d-flex">
        <?php include("sidebar.php"); ?>
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Order Management</h2>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Total</th>
                            <th scope="col">User</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['total']; ?></td>
                                <td><?php echo $order['fullname']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><?php echo $order['order_status']; ?></td>
                                <td><?php echo $order['payment_method']; ?></td>
                                <td>
                                <?php if ($order['order_status'] != 'delivered') { ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            <button type="submit" name="mark_delivered" class="btn btn-sm btn-success">Mark as Delivered</button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>