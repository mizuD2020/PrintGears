<?php
session_start();
require_once 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate passwords
    if ($password !== $confirmPassword) {
        $_SESSION['message'] = 'Passwords do not match!';
        $_SESSION['message_type'] = 'warning';
        header('Location: signUpPage.php');
        exit();
    }

    // Check if username already exists
    $stmt = $connection->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = 'Username is already taken!';
        $_SESSION['message_type'] = 'warning';
        header('Location: signUpPage.php');
        exit();
    }

    // Validate phone number (must be exactly 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        $_SESSION['message'] = 'Invalid phone number!';
        $_SESSION['message_type'] = 'warning';
        header('Location: signUpPage.php');
        exit();
    }

    // Insert new user
    $stmt = $connection->prepare(
        "INSERT INTO user (fullname, email, phone, address, username, password) VALUES (?, ?, ?, ?, ?, ?)"
    );
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bind_param("ssssss", $fullname, $email, $phone, $address, $username, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'SignUp successful!';
        $_SESSION['message_type'] = 'success';
        header('Location: signIn.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error during sign-up!';
        $_SESSION['message_type'] = 'error';
        header('Location: signUpPage.php');
        exit();
    }
}
?>