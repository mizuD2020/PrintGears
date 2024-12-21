<?php

session_start();
include "Sign/dbconnection.php";

if (!isset($_SESSION['user'])) {
    // Redirect to login page or display a message
    header("Location: Sign/signIn.php");
    exit; // Stop further execution
}

$product_id = $_GET['product_id'];
$quantity = 1;
if (isset($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
}

$user_id = $_SESSION['user']['id'];

// Fetch the product's stock
$product_query = "SELECT stock FROM product WHERE id = '$product_id'";
$product_result = mysqli_query($connection, $product_query);
$product = mysqli_fetch_assoc($product_result);

if ($product['stock'] <= 0) {
    $_SESSION['message'] = "Sorry, out of stock";
} else {
    // Check if the user already has a cart
    $existing_cart_query = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $existing_cart_result = mysqli_query($connection, $existing_cart_query);
    $existing_cart = mysqli_fetch_assoc($existing_cart_result);

    if ($existing_cart) {
        $cart_id = $existing_cart['id'];

        // Check if the product is already in the cart
        $check_item_query = "SELECT * FROM cart_item WHERE cart_id = $cart_id AND product_id = '$product_id'";
        $check_item_result = mysqli_query($connection, $check_item_query);
        $existing_item = mysqli_fetch_assoc($check_item_result);

        if ($existing_item) {
            $_SESSION['message'] = "product is already in the cart!";
        } else {
            // Add the product to the cart
            $sql = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES ('$cart_id', '$product_id', '$quantity')";
            mysqli_query($connection, $sql);
            $_SESSION['message'] = "product added to cart!";
        }
    } else {
        // Create a new cart for the user
        $sql = "INSERT INTO cart(user_id) VALUES ('$user_id')";
        mysqli_query($connection, $sql);
        $cart_id = mysqli_insert_id($connection);

        // Add the product to the new cart
        $sql = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES ('$cart_id', '$product_id', 1)";
        mysqli_query($connection, $sql);
        $_SESSION['message'] = "product added to cart!";
    }
}

header("Location: index.php");
exit();

?>