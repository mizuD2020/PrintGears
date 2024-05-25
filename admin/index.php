<section class="main-content columns is-fullheight">
    <?php
    require("sidebar.php");
    require("dbconnect.php");
    $stickers = mysqli_num_rows(mysqli_query($conn, "SELECT count(*) FROM sticker"));
    $users = mysqli_num_rows(mysqli_query($conn, "SELECT count(*) FROM user"));
    ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Dashboard</p>
                </div>
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Stickers</p>
                                </div>
                                <div class="card-content">
                                    <?php echo $stickers; ?>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Users</p>
                                </div>
                                <div class="card-content">
                                    <?php echo $users; ?>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="card">
                                <div class="card-header">
                                    <p class="card-header-title">Orders</p>
                                </div>
                                <div class="card-content">
                                    3
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>