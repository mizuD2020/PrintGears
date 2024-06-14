<?php

include ("dbconnection.php");

if (isset($_POST["signUp"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $confirmPassword = $_POST['confirmPassword'];

    // check username already exists
    $stmt = $connection->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username already exists, handle accordingly (e.g., show error message)
        echo "Username is already taken. Please choose another one.";
        exit(); // Stop further execution
    }

    if (empty($username) || empty($password) || empty($confirmPassword) || empty($email) || empty($fullname)) {
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
        die("Query Failed" . mysqli_error($connection));
    } else {
        header('location:signIn.php?InsertUser_message=Sign Up successful');
        exit;
    }
}

?>