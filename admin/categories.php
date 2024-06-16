<section class="main-content columns is-fullheight">
    <?php
    require ("sidebar.php");
    require ("dbconnect.php");
    $result = mysqli_query($conn, "SELECT * FROM categories");
    ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Categories</p>
                    <a href="add_category.php" class="button is-primary">Add Category</a>
                </div>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($category = mysqli_fetch_assoc($result)) {
                                $delete_url = '../delete.php?table=categories&id=' . $category['id'];
                                $edit_url = 'edit-category.php?id=' . $category['id'];
                                ?>
                                <tr>
                                    <td data-label="Name"><?php echo $category['name']; ?></td>
                                    <td data-label="Image"><img src="<?php echo $category['image']; ?>" height="30"
                                            width="30"></td>
                                    <td class="is-actions-cell">
                                        <div class="buttons is-right">
                                            <a href="<?php echo $edit_url; ?>" class="button is-small is-primary">
                                                Edit
                                            </a>
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