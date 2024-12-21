<?php /*
session_start();
include "header.php";
include "dbconnect.php";

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
SELECT cart_item.id, product.id AS product_id, product.name, product.stock, cart_item.quantity
FROM cart_item
JOIN product ON product.id = cart_item.product_id
WHERE cart_item.cart_id = {$cart['id']}
");

// Process each item in the cart
while ($row = mysqli_fetch_assoc($result)) {
$product_id = $row['product_id'];
$quantity = $row['quantity'];

// Check if sufficient stock is available
if ($row['stock'] < $quantity) {
die("<p>Sorry, there is not enough stock for '{$row['name']}' to fulfill your order.</p>");
}

// Update the stock in the product table
$new_stock = $row['stock'] - $quantity;
$update_query = "UPDATE product SET stock = $new_stock WHERE id = $product_id";
if (!mysqli_query($connection, $update_query)) {
die("Error updating stock for '{$row['name']}': " . mysqli_error($connection));
}
}

// Insert order into database
$insert_order_query = "INSERT INTO `order` (user_id, total_amount) VALUES ({$_SESSION['user']['id']}, $total)";
if (mysqli_query($connection, $insert_order_query)) {
// Clear user's cart
mysqli_query($connection, "DELETE FROM cart_item WHERE cart_id = {$cart['id']}");
// Display success message
echo "<p>Order placed successfully! Total amount: $total</p>";
} else {
// Display error message
echo "Error placing order: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>

<div class="container">
<h1>Order Placed Successfully</h1>
<p>Total Amount: <?php echo $total; ?></p>
<p>Your cart is now empty.</p>
</div>
