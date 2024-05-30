<?php
session_start();
include "header.php";

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page or display a message
    header("Location: login.php");
    exit; // Stop further execution
}

// Retrieve user's cart
$cart = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '{$_SESSION['user']['id']}'"));

// Check if the cart exists
if (!isset($cart['id'])) {
    die('<p>Your cart is empty.</p>');
}

// Retrieve cart items
$result = mysqli_query($connection, "
    SELECT sticker.name, sticker.image, sticker.price, cart_item.quantity
    FROM cart_item
    JOIN sticker ON sticker.id = cart_item.sticker_id
    WHERE cart_item.cart_id = {$cart['id']}
");

// Calculate total amount
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $total += $row['price'] * $row['quantity'];
}

// Insert order into database
$insert_order_query = "INSERT INTO order (user_id, total_amount) VALUES ({$_SESSION['user']['id']}, $total)";
if (mysqli_query($connection, $insert_order_query)) {
    // Clear user's cart
    mysqli_query($connection, "DELETE FROM cart_item WHERE cart_id = {$cart['id']}");
    // Display success message
    echo "<p>Order placed successfully! Total amount: $total</p>";
} else {
    // Display error message
    echo "Error placing order: " . mysqli_error($connection);
}
?>

<!-- HTML for displaying success message -->
<div class="container">
    <h1>Order Placed Successfully</h1>
    <p>Total Amount: <?php echo $total; ?></p>
    <p>Your cart is now empty.</p>
</div>