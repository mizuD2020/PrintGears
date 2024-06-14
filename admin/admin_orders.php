<?php
session_start();
include 'header.php';
include 'dbconnect.php'; // Include your database connection file

// Fetch users who have placed orders
$users = mysqli_query($conn, "SELECT DISTINCT user.id, user.username FROM user JOIN `order` ON user.id = `order`.user_id");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Orders</title>
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
                        <p class="card-header-title">User Orders</p>
                        <a href="admin_order_history.php" class="btn btn-secondary ml-auto">View Order History</a>
                    </div>
                    <div class="card-content">
                        <div class="list-group">
                            <?php while ($user = mysqli_fetch_assoc($users)) { ?>
                                <a href="#" class="list-group-item list-group-item-action"
                                    onclick="toggleOrderDetails(<?php echo $user['id']; ?>)">
                                    <?php echo $user['username']; ?>
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
                    url: 'fetch_orders.php',
                    type: 'GET',
                    data: { user_id: userId },
                    success: function (response) {
                        orderDetailsDiv.html(response).slideDown();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("Error fetching order details. Please try again.");
                    }
                });
            } else {
                orderDetailsDiv.slideToggle();
            }
        }
    </script>

</body>

</html>