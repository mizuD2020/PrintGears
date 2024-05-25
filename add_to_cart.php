<?php
session_start();
include "Sign/dbconnection.php";
$sticker_id = $_GET['sticker_id'];
$existing_cart = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '{$_SESSION['user']['id']}'"));
if ($existing_cart) {
    $sql = "INSERT INTO cart_item(cart_id, sticker_id, quantity) VALUES ('$existing_cart[id]', '$sticker_id', 1)";
    mysqli_query($connection, $sql);
} else {
    $sql = "INSERT INTO cart(user_id) VALUES ('{$_SESSION['user']['id']}')";
    mysqli_query($connection, $sql);
    $cart_id = mysqli_insert_id($connection);
    $sql = "INSERT INTO cart_item(cart_id, sticker_id, quantity) VALUES ('$cart_id', '$sticker_id', 1)";
    mysqli_query($connection, $sql);
}

header("Location: cart.php")

?>

