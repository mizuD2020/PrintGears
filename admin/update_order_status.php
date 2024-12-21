<?php
include 'dbconnect.php';

if (isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Update status to "Received"
        $update_order = mysqli_query($conn, "UPDATE `order` SET order_status = 'Received' WHERE id = $order_id");
        if ($update_order) {
            echo "Order has been marked as received.";
        } else {
            echo "Failed to update order.";
        }
    } elseif ($action === 'cancel') {
        // Delete order and notify the user
        $order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM `order` WHERE id = $order_id"));
        $user_id = $order['user_id'];

        // Insert cancellation notification
        $insert_notification = mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, 'Your order has been cancelled.')");

        if ($insert_notification) {
            mysqli_query($conn, "DELETE FROM `order` WHERE id = $order_id");
            echo "Order has been cancelled and the user has been notified.";
        } else {
            echo "Failed to cancel the order.";
        }
    }
}
?>