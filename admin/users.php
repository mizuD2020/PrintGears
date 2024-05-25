<?php
require_once 'dbconnect.php';
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
require "sidebar.php";
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
            while ($user = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td> <?php echo $user['id']; ?></td>
                    <td> <?php echo $user['fullname']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<!-- echo $user['id']; -->">Edit</a> |
                        <a href="delete.php?id=<?php echo $user['id'] . "&table=user" ?>" onclick="return confirm('You want to delete it ?')">
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