<?php
session_start();
require_once 'dbconnection.php';

if (isset($_POST["signIn"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `user` WHERE `email` = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            $_SESSION['Role_as'] = $row['Role_as'];
            $_SESSION['message'] = "SignIn successful";
            $_SESSION['message_type'] = "success";

            if ($row['Role_as'] == 1) {
                header('Location: ../admin/index.php');
            } else {
                header('Location: ../index.php');
            }
            exit();
        } else {
            $_SESSION['message'] = "Invalid password";
            $_SESSION['message_type'] = "error";
            header("Location: signIn.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid email address";
        $_SESSION['message_type'] = "error";
        header("Location: signIn.php");
        exit();
    }
}
?>