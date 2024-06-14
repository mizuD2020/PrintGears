<?php
session_start();
include 'header.php';
include 'dbconnect.php';

// Fetch users who have order history
$users_query = mysqli_query($conn, "SELECT DISTINCT user.id, user.username FROM user JOIN order_history ON user.id = order_history.user_id");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Order History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .order-details {
            display: none;
        }
    </style>
</head>

<body>
    <section class="main-content columns is-fullheight">
        <?php require ("sidebar.php"); ?>
        <div class="container column is-10">
            <div class="section">
                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">User Order History</p>
                    </div>
                    <div class="card-content">
                        <div class="list-group">
                            <?php while ($user = mysqli_fetch_assoc($users_query)) {
                                // Fetch total amount and grand total price of stickers purchased by the user
                                $total_query = mysqli_query($conn, "SELECT SUM(order_history.quantity) AS total_amount, SUM(order_history.quantity * sticker.price) AS total_price 
                                                                    FROM order_history 
                                                                    JOIN sticker ON sticker.id = order_history.sticker_id 
                                                                    WHERE order_history.user_id = {$user['id']}");
                                $total_result = mysqli_fetch_assoc($total_query);
                                ?>
                                <a href="#" class="list-group-item list-group-item-action"
                                    onclick="toggleOrderDetails(<?php echo $user['id']; ?>)">
                                    <?php echo $user['username']; ?>
                                    <span class="badge badge-primary badge-pill float-right">Total Stickers:
                                        <?php echo $total_result['total_amount']; ?></span>
                                    <span class="badge badge-secondary badge-pill float-right mr-2">Total Price: Rs
                                        <?php echo $total_result['total_price']; ?></span>
                                </a>
                                <div id="order-details-<?php echo $user['id']; ?>" class="order-details"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleOrderDetails(userId) {
            var orderDetailsDiv = $('#order-details-' + userId);
            if (orderDetailsDiv.is(':empty')) {
                $.ajax({
                    url: 'fetch_history.php',
                    type: 'GET',
                    data: { user_id: userId },
                    success: function (response) {
                        orderDetailsDiv.html(response).slideDown();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("Error fetching order history details. Please try again.");
                    }
                });
            } else {
                orderDetailsDiv.slideToggle();
            }
        }
    </script>

</body>

</html>