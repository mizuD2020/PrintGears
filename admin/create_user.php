<?php

require ("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user (username, password, fullname, email) VALUES ('$username', '$password', '$fullname', '$email')";
    if (mysqli_query($conn, $query)) {
        header("Location: users.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>


<section class="main-content columns is-fullheight">
    <?php require "sidebar.php"; ?>
    <div class="container column is-10">
        <div class="section">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">Create User</p>
                </div>
                <div class="card-content"></div>
                <form method="post">
                    <div class="field">
                        <label for="fullname" class="label">Fullname</label>
                        <div class="control">
                            <input type="text" class="input" placeholder="Name" name="fullname" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="username" class="label">Username</label>
                        <div class="control">
                            <input type="text" class="input" placeholder="Username" name="username" required>
                        </div>
                    </div>
                    <div class="field">
                        <label for="email" class="label">Email</label>
                        <div class="control">
                            <input type="email" name="email" class="input" placeholder="Email" required>
                        </div>
                        <div class="field">

                            <label for="password" class="label">Password</label>
                            <div class="control">
                                <input type="password" name="password" class="input" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary" name="submit">Create User</button>
                            </div>
                        </div>
                </form>

            </div>