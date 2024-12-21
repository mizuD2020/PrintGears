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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .main-content {
            display: flex;
            flex-wrap: wrap;
        }

        /* Container Styling */
        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Section Styling */
        .section {
            padding: 20px;
        }

        /* Card Styling */
        .card {
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: rgb(135, 170, 207);
            color: #ffffff;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .card-header-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-content {
            padding: 15px;
        }
    </style>


</head>

<body>
    <section class="main-content columns is-fullheight">
        <?php require("sidebar.php"); ?>
        <div class="container column is-10">
            <div class="section">
                <div class="card is-hidden1">
                    <div class="card-header">
                        <p class="card-header-title">User Orders</p><a href="admin_order_history.php"
                            class="text-decoration-none button is-primary">View Order History</a>
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
    <script>function toggleOrderDetails(userId) {
            var orderDetailsDiv = $('#order-details-' + userId);

            if (orderDetailsDiv.is(':empty')) {
                $.ajax({

                    url: 'fetch_orders.php',
                    type: 'GET',
                    data: {
                        user_id: userId
                    }

                    ,
                    success: function (response) {
                        orderDetailsDiv.html(response).slideDown();
                    }

                    ,
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("Error fetching order details. Please try again.");
                    }
                });
            }

            else {
                orderDetailsDiv.slideToggle();
            }
        }
        function updateOrderStatus(orderId, action) {
            $.ajax({
                url: 'update_order_status.php',
                type: 'POST',
                data: { order_id: orderId, action: action },
                success: function (response) {
                    alert(response);
                    location.reload(); // Reload the page to reflect changes
                },
                error: function () {
                    alert("Error updating order status.");
                }
            });
        }

    </script>
</body>

</html>