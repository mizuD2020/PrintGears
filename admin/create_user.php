<?php
ob_start();
require ("sidebar.php");
?>
<div class="container">
    <?php
    require ("dbconnect.php");
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user (username, password, fullname) VALUES ('$username', '$password', '$fullname')";
        if (mysqli_query($conn, $query)) {
            header("Location: users.php");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
    ?>
    <form method="post">
        <label for="fullname">Fullname</label> <br />
        <input type="text" name="fullname" id="fullname" required> <br />
        <label for="username">Username</label> <br />
        <input type="text" name="username" id="username" required> <br />
        <label for="email">Email</label> <br />
        <input type="email" name="email" id="email" required> <br />
        <label for="password">Password</label><br />
        <input type="password" name="password" id="password" required><br />
        <br />
        <button type="submit" name="submit">Create User</button>
    </form>

</div>