<?php
session_start();
include "dbconnect.php"; // Include your database connection file

$user_id = $_SESSION['user']['id'];

// Perform actions to clear the history (for user's view)
// For demonstration purposes, we will unset a session variable that holds the order history message

// Example action: Unset session variable
unset($_SESSION['order_history']);

// Set a success message to display on orders.php
$_SESSION['message'] = "Order history cleared successfully.";

// Redirect back to orders.php
header("Location: orders.php");
exit();
?>