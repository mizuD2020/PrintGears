<?php
require ("sidebar.php");
require ("dbconnect.php");
$result = mysqli_query($conn, "SELECT * FROM user");
?>

<div class="container">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user = mysqli_fetch_assoc($result)) {
                $delete_url = 'delete.php?table=user&id=' . $user['id'];
                ?>

                <tr>
                    <td> <?php echo $user['id']; ?></td>
                    <td> <?php echo $user['fullname']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<!-- echo $user['id']; -->">Edit</a> |
                        <a href="<?php echo $delete_url ?>" onclick="return confirm('You want to delete it ?')"
                            type="button">
                            Delete
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="create_user.php">Create User</a>


</div>

<style>
    .container {
        margin-left: 200px;
    }
</style>