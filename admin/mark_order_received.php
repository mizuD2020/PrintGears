<?php
include 'dbconnect.php';

if (isset($_POST['order_item_id'])) {
    $order_item_id = $_POST['order_item_id'];

    // Fetch the order details
    $order_item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM order_item WHERE id = $order_item_id"));
    $order_id = $order_item['order_id'];
    $product_id = $order_item['product_id'];
    $quantity = $order_item['quantity'];

    // Insert into order history
    $order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `order` WHERE id = $order_id"));
    $user_id = $order['user_id'];
    $order_date = $order['order_date'];
    $expected_delivery_date = date('Y-m-d', strtotime($order_date . ' + 7 days'));

    $insert_history = "INSERT INTO order_history (user_id, product_id, quantity, order_date, expected_delivery_date)
                       VALUES ($user_id, $product_id, $quantity, '$order_date', '$expected_delivery_date')";
    mysqli_query($conn, $insert_history);

    // Delete the order item
    mysqli_query($conn, "DELETE FROM order_item WHERE id = $order_item_id");

    // Check if there are any remaining items in the order
    $remaining_items = mysqli_query($conn, "SELECT * FROM order_item WHERE order_id = $order_id");
    if (mysqli_num_rows($remaining_items) == 0) {
        // Delete the order if no remaining items
        mysqli_query($conn, "DELETE FROM `order` WHERE id = $order_id");
    }

    echo "Order marked as received and moved to history.";
}

