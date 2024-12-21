<?php
session_start();
include 'Sign/dbconnection.php';
$pidx = $_GET['pidx'];
$transaction_id = $_GET['transaction_id'];
$status = $_GET['status'];
$order_id = $_GET['purchase_order_id'];

if ($status == "Completed") {
    $sql = "UPDATE `order` SET order_status = 'paid', payment_method = 'Khalti' WHERE id = $order_id";
    if (mysqli_query($connection, $sql)) {
        header("Location: success.php?id=$order_id");
        exit();
    } else {
        header("Location: error.php?id=$order_id");
    }
} else {
    header("Location: error.php?id=$order_id");
    exit();
}
?>