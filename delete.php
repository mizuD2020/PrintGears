<?php
$id = $_GET['id'];
$table = $_GET['table'];
require_once 'Sign/dbconnection.php';
$stmt = $connection->prepare("DELETE FROM $table WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
header("Location: " . $_SERVER['HTTP_REFERER']);
?>