<?php

include ("dbconnection.php");

if (isset ($_POST["signUp"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty ($username) || empty ($password) || empty ($confirmPassword) || empty($email) || empty($fullname)) {
        header('location:signup.php?message=All fields are required');
        exit;
    }

    if ($password !== $confirmPassword) {
        header('location:signup.php?message=Passwords do not match');
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO `user` (`username`, `password`, `email`, `fullname`) VALUES ('$username', '$hashedPassword', '$email', '$fullname')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die ("Query Failed" . mysqli_error($connection));
    } else {
        header('location:signIn.php?InsertUser_message=Sign Up successful');
        exit;
    }
}

?>