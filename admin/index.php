<?php 
    session_start();
    if (!isset($_SESSION['user']) && !isset($_SESSION['Role_as']) &&  $_SESSION['Role_as'] !== 1) {
        header("Location: ../Sign/SignIn.php");
        exit();
    }
    require("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .dashboard-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
            padding: 1.5rem;
        }
        .card-header i {
            font-size: 2rem;
            margin-right: 15px;
        }
        .card-value {
            font-size: 2rem;
            font-weight: bold;
            margin: 10px 0;
        }
        .card-label {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 0;
        }
        .products-card { border-left: 4px solid #17a2b8; }
        .users-card { border-left: 4px solid #28a745; }
        .orders-card { border-left: 4px solid #ffc107; }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include("sidebar.php"); ?>
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Dashboard Overview</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card dashboard-card products-card mb-4">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-box text-info"></i>
                                <div>
                                    <?php
                                    $products_query = mysqli_query($conn, "SELECT COUNT(*) FROM product");
                                    $products_count = mysqli_fetch_row($products_query)[0];
                                    ?>
                                    <div class="card-value"><?php echo number_format($products_count); ?></div>
                                    <p class="card-label">Total Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card users-card mb-4">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-users text-success"></i>
                                <div>
                                    <?php
                                    $users_query = mysqli_query($conn, "SELECT COUNT(*) FROM user");
                                    $users_count = mysqli_fetch_row($users_query)[0];
                                    ?>
                                    <div class="card-value"><?php echo number_format($users_count); ?></div>
                                    <p class="card-label">Total Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card orders-card mb-4">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-shopping-cart text-warning"></i>
                                <div>
                                    <?php
                                    $orders_query = mysqli_query($conn, "SELECT COUNT(*) FROM `order`");
                                    $orders_count = mysqli_fetch_row($orders_query)[0];
                                    ?>
                                    <div class="card-value"><?php echo number_format($orders_count); ?></div>
                                    <p class="card-label">Total Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>