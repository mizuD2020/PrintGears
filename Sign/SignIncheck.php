<?php

session_start();

include ("dbconnection.php");

if (isset($_POST["signIn"])) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    // Data fetch gareko based on Username
    $query = "SELECT * FROM `user` WHERE `username` = '$Username'";
    $result = mysqli_query($connection, $query);


    //Password check gareko 
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($Password, $row['password'])) {

            $_SESSION['username'] = $Username;
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