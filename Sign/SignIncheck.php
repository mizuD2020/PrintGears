<?php

session_start();

include ("dbconnection.php");

if (isset($_POST["signIn"])) {
    $email = $_POST['email'];
    $Password = $_POST['password'];

    $query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($connection, $query);


    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($Password, $row['password'])) {
            $_SESSION['user'] = $row;
            header('location: ../index.php');
            exit;
        } else {

            header("location:signIn.php?error=Invalid%20password");

        }
    } else {

        header("location:signIn.php?error=Invalid%20username");

    }
}

?>