<?php
require ("sidebar.php");
require ("dbconnect.php");
$result = mysqli_query($conn, "SELECT * FROM user");
?>
<div class="container column is-10">
    <div class="section">
        <div class="card is-hidden1">
            <div class="card-header">
                <p class="card-header-title">Users</p>
                <a href="create_user.php" class="button is-primary">Create User</a>
            </div>
            <div class="card-content">
                <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user = mysqli_fetch_assoc($result)) {
                            $delete_url = '../delete.php?table=user&id=' . $user['id'];
                            ?>

                            <tr>
                                <td> <?php echo $user['id']; ?></td>
                                <td> <?php echo $user['fullname']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td class="is-actions-cell">
                                    <div class="buttons is-right">
                                        <a href="edit_user.php?id=<!-- echo $user['id']; -->"
                                            class="button is-small is-primary">Edit</a> |
                                        <a href="<?php echo $delete_url ?>" class="button is-small is-danger jb-modal"
                                            onclick="return confirm('You want to delete it ?')" data-target="sample-modal"
                                            type="button">
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





</div>