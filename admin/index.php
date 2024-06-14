<section class="main-content columns is-fullheight">
    <?php
    require ("sidebar.php");
    require ("dbconnect.php");

    // Correct queries to count rows in sticker and user tables
    $stickers_query = mysqli_query($conn, "SELECT COUNT(*) FROM sticker");
    $stickers_result = mysqli_fetch_row($stickers_query);
    $stickers_count = $stickers_result[0];

    $users_query = mysqli_query($conn, "SELECT COUNT(*) FROM user");
    $users_result = mysqli_fetch_row($users_query);
    $users_count = $users_result[0];

    // Correct the query for counting orders
    $orders_query = mysqli_query($conn, "SELECT COUNT(*) FROM `order`");
    $orders_result = mysqli_fetch_row($orders_query);
    $orders_count = $orders_result[0];
    ?>
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
                                    <p class="card-header-title">Stickers</p>
                                </div>
                                <div class="card-content">
                                    <?php echo $stickers_count; ?>
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