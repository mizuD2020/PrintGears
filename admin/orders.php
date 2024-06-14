<section class="main-content columns is-fullheight">
    <?php
    require ("sidebar.php");
    require ("dbconnect.php");
    $result = mysqli_query($conn, "SELECT * FROM order");
    $result = mysqli_query($conn, "SELECT * FROM order_item");
    ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Stickers</p>
                    <a href="add_item.php" class="button is-primary">Add Stickers</a>
                </div>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Sticker Name</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($sticker = mysqli_fetch_assoc($result)) {
                                $delete_url = '../delete.php?table=sticker&id=' . $sticker['id'];
                                ?>
                                <tr>
                                    <td data-label="Name"><?php echo $sticker['name']; ?></td>
                                    <td data-label="Desciption"><?php echo $sticker['description']; ?></td>
                                    <td data-label="Price"><?php echo $sticker['price']; ?></td>
                                    <td data-label="Stock"><?php echo $sticker['quantity']; ?></td>
                                    <td data-label="Image"><img src="<?php echo $sticker['image']; ?>" height="30"
                                            width="30"></td>
                                    <td class="is-actions-cell">
                                        <div class="buttons is-right">
                                            <button class="button is-small is-primary" type="button">
                                                Edit
                                            </button>
                                            <a href="<?php echo $delete_url ?>" class="button is-small is-danger jb-modal"
                                                data-target="sample-modal" type="button">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>