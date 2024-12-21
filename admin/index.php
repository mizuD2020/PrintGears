<section class="main-content columns is-fullheight">
    <?php
    session_start();

    require("sidebar.php");
    require("dbconnect.php");
    if (!isset($_SESSION['user']) && $_SESSION['Role_as'] !== 1) {

        header("Location: ../Sign/SignIn.php"); // Redirect to login page if not logged in or not an admin
        exit();
    }

    // Correct queries to count rows in product and user tables
    $products_query = mysqli_query($conn, "SELECT COUNT(*) FROM product");
    $products_result = mysqli_fetch_row($products_query);
    $products_count = $products_result[0];

    $users_query = mysqli_query($conn, "SELECT COUNT(*) FROM user");
    $users_result = mysqli_fetch_row($users_query);
    $users_count = $users_result[0];

    // Correct the query for counting orders
    $orders_query = mysqli_query($conn, "SELECT COUNT(*) FROM `order`");
    $orders_result = mysqli_fetch_row($orders_query);
    $orders_count = $orders_result[0];
    ?>
    <style>
        /* General container styling */
        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 15px;
            background-color: white;
        }

        /* Section styling */
        .section {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Card styling */
        .card {
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: rgb(135, 170, 207);
            color: #ffffff;
            padding: 10px 15px;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header p {
            margin: 0;
        }

        .card-content {
            padding: 15px;
            font-size: 1rem;
            color: #333;
            text-align: center;
        }

        /* Columns styling */
        .columns {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .column {
            flex: 1;
            min-width: 250px;
        }

        /* Button styling */
        button.nav-item a {
            text-decoration: none;
            color: #fff;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button.nav-item a:hover {
            background-color: #C82333;
        }

        /* Utility classes */
        .is-danger {
            background-color: #DC3545;
            border: none;
            cursor: pointer;
        }

        .is-hidden1 {
            display: block;
            /* Adjust based on visibility logic */
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .columns {
                flex-direction: column;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            button.nav-item a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <div class="container column is-10">
        <div class="section">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Dashboard</p>
                    <button class="nav-item">
                        <a href="logout.php" class="button is-danger"><i
                                class="bi bi-box-arrow-right"></i>&nbsp;Logout</a>
                    </button>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Products</p>
                                </div>
                                <div class="card-content">
                                    <?php echo $products_count; ?>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Users</p>
                                </div>
                                <div class="card-content">
                                    <?php echo $users_count; ?>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Orders</p>
                                </div>
                                <div class="card-content">
                                    <?php echo $orders_count; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>