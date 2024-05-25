<?php 
$id = $_GET['id'];
$table = $_GET['table'];
require_once 'dbconnect.php';
$stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
header("Location: ". $_SERVER['HTTP_REFERER']);
?>
