<?php
require("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];

    $query = "UPDATE user SET fullname='$fullname', username='$username' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: users.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id=$id");
    $user = mysqli_fetch_assoc($result);
}

?>


<?php
require("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        die("User not found");
    }
} else {
    die("Invalid request");
}
?>
<section class="main-content columns is-fullheight">
    <?php require("sidebar.php"); ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">Edit User</p>
                </div>
                <div class="card-content">
                    <form method="post" action="edit_user.php">

                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <div class="field">
                            <label for="fullname" class="label">Name</label>
                            <input type="text" class="input" name="fullname" value="<?php echo $user['fullname']; ?>"
                                required>
                        </div>
                        <div class="field">
                            <label for="username" class="label">Username</label>
                            <input type="text" class="input" name="username" value="<?php echo $user['username']; ?>"
                                required>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>