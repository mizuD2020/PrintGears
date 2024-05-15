<?php

include ("dbconnection.php");

if (isset ($_POST["signUp"])) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $ConfirmPassword = $_POST['confirmPassword'];

    // validation
    if (empty ($Username) || empty ($Password) || empty ($ConfirmPassword)) {
        header('location:signup.php?message=All fields are required');
        exit;
    }

    if ($Password !== $ConfirmPassword) {
        header('location:signup.php?message=Passwords do not match');
        exit;
    }

    // Password has for better security
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Data into database
    $query = "INSERT INTO `user` (`username`, `password`) VALUES ('$Username', '$hashedPassword')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die ("Query Failed" . mysqli_error($connection));
    } else {
        header('location:signIn.php?InsertUser_message=Sign Up successful');
        exit;
    }
}

?>