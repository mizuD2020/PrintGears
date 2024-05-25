<?php
session_start();
include("./Sign/dbconnection.php");
$result = mysqli_query($connection, "SELECT * FROM categories");
$stickers = mysqli_query($connection, "SELECT * FROM sticker");
?>
<?php
include 'header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1 class="display-4">Recently Added</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                while ($sticker = mysqli_fetch_assoc($stickers)) { ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="ratio ratio-1x1">
                                <img src="<?php echo $sticker['image'] ?>" class="card-img-top img-fluid" alt="Sticker Image">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $sticker['name'] ?></h5>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-primary">Buy</button>
                                    <a href="<?php echo 'add_to_cart.php?sticker_id=' . $sticker['id']; ?>" class="btn btn-primary">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    while ($category = mysqli_fetch_assoc($result)) { ?>
                        <li class="list-group-item"><?php echo $category['name'] ?></li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>