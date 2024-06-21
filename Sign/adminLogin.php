<?php
session_start();

if (isset($_GET['role']) && ($_GET['role'] == 'admin' || $_GET['role'] == 'user')) {
    $role = $_GET['role'];
    if ($role == 'admin') {
        $_SESSION['Role_as'] = 1; // Set role as admin
        header('Location: ../admin/index.php'); // Redirect to admin dashboard
    } else {
        $_SESSION['Role_as'] = 0; // Set role as regular user
        header('Location: ../index.php'); // Redirect to regular user page
    }
    exit();
} else {
    header('Location: ../index.php'); // Redirect to regular user page by default
    exit();
}
?>