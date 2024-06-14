<?php
/*
session_start();
include "Sign/dbconnection.php";
$sticker_id = $_GET['sticker_id'];
$existing_cart = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '{$_SESSION['user']['id']}'"));
if ($existing_cart) {
    $sql = "INSERT INTO cart_item(cart_id, sticker_id, quantity) VALUES ('$existing_cart[id]', '$sticker_id', 1)";
    mysqli_query($connection, $sql);
} else {
    $sql = "INSERT INTO cart(user_id) VALUES ({$_SESSION['user']['id']})";
    mysqli_query($connection, $sql);
    $cart_id = mysqli_insert_id($connection);
    $sql = "INSERT INTO cart_item(cart_id, sticker_id, quantity) VALUES ('$cart_id', '$sticker_id', 1)";
    mysqli_query($connection, $sql);
}

header("Location: cart.php")
*/

session_start();
include "Sign/dbconnection.php";

$sticker_id = $_GET['sticker_id'];
$user_id = $_SESSION['user']['id'];

// Check if the user already has a cart
$existing_cart_query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$existing_cart_result = mysqli_query($connection, $existing_cart_query);
$existing_cart = mysqli_fetch_assoc($existing_cart_result);

if ($existing_cart) {
    $cart_id = $existing_cart['id'];

    // Check if the sticker is already in the cart
    $check_item_query = "SELECT * FROM cart_item WHERE cart_id = '$cart_id' AND sticker_id = '$sticker_id'";
    $check_item_result = mysqli_query($connection, $check_item_query);
    $existing_item = mysqli_fetch_assoc($check_item_result);

    if ($existing_item) {
        $_SESSION['message'] = "Sticker is already in the cart!";
    } else {
        // Add the sticker to the cart
        $sql = "INSERT INTO cart_item(cart_id, sticker_id, quantity) VALUES ('$cart_id', '$sticker_id', 1)";
        mysqli_query($connection, $sql);
        $_SESSION['message'] = "Sticker added to cart!";
    }
} else {
    // Create a new cart for the user
    $sql = "INSERT INTO cart(user_id) VALUES ('$user_id')";
    mysqli_query($connection, $sql);
    $cart_id = mysqli_insert_id($connection);

    // Add the sticker to the new cart
    $sql = "INSERT INTO cart_item(cart_id, sticker_id, quantity) VALUES ('$cart_id', '$sticker_id', 1)";
    mysqli_query($connection, $sql);
    $_SESSION['message'] = "Sticker added to cart!";
}

header("Location: index.php");
exit();

?>