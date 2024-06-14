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
            $_SESSION['Role_as'] = $row['Role_as'];

            if ($row['Role_as'] == 1) {
                $_SESSION['message'] = "Logged in successfully";
                header('Location: ../admin/index.php');
            } else {
                header('Location: ../index.php');
            }
            exit;
        } else {
            header("Location: signIn.php?error=Invalid%20password");
        }
    } else {
        header("Location: signIn.php?error=Invalid%20username");
    }
}



?>