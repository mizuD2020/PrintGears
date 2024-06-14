<?php


session_start();
include "header.php";

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Database connection
include "dbconnect.php";

// Retrieve the user's cart
$user_id = $_SESSION['user']['id'];
$cart_query = mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '$user_id'");
$cart = mysqli_fetch_assoc($cart_query);

// Check if the cart exists
if (!$cart) {
    die('<p>Your cart is empty.</p>');
}

$cart_id = $cart['id'];
$cart_items_query = mysqli_query($connection, "
    SELECT sticker.id, sticker.name, sticker.image, sticker.price, sticker.quantity AS stock_quantity, cart_item.quantity AS cart_quantity
    FROM cart_item
    JOIN sticker ON sticker.id = cart_item.sticker_id
    WHERE cart_item.cart_id = $cart_id
");

$cart_items = [];
$total = 0;
while ($row = mysqli_fetch_assoc($cart_items_query)) {
    // Check if enough stock is available
    if ($row['stock_quantity'] < $row['cart_quantity']) {
        die("<p>Not enough stock for {$row['name']}. Available: {$row['stock_quantity']}, Requested: {$row['cart_quantity']}.</p>");
    }

    $cart_items[] = $row;
    $total += $row['price'] * $row['cart_quantity'];
}

// Insert order into the database
$insert_order_query = "INSERT INTO `order` (user_id, total_amount) VALUES ($user_id, $total)";
if (mysqli_query($connection, $insert_order_query)) {
    $order_id = mysqli_insert_id($connection);

    // Insert order items and update stock
    foreach ($cart_items as $item) {
        $sticker_id = $item['id'];
        $cart_quantity = $item['cart_quantity'];
        $price = $item['price'];

        $insert_order_item_query = "
            INSERT INTO order_item (order_id, sticker_id, quantity, price)
            VALUES ($order_id, $sticker_id, $cart_quantity, $price)
        ";

        // Update the stock quantity
        $new_stock_quantity = $item['stock_quantity'] - $cart_quantity;
        $update_stock_query = "UPDATE sticker SET quantity = $new_stock_quantity WHERE id = $sticker_id";

        if (!mysqli_query($connection, $insert_order_item_query) || !mysqli_query($connection, $update_stock_query)) {
            die("Error updating order items or stock: " . mysqli_error($connection));
        }
    }


    mysqli_query($connection, "DELETE FROM cart_item WHERE cart_id = $cart_id");


    echo "<p>Order placed successfully! Total amount: Rs. $total</p>";
} else {

    echo "Error placing order: " . mysqli_error($connection);
}
?>

<!-- HTML for displaying success message -->
<div class="container">
    <h1>Order Placed Successfully</h1>
    <p>Total Amount: Rs. <?php echo $total; ?></p>
    <p>Your cart is now empty.</p>
</div>