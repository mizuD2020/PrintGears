<?php
$id = $_GET['id'];
$table = $_GET['table'];

// Validate table name
$allowed_tables = ['table1', 'table2', 'sticker']; // Add all valid table names here
if (!in_array($table, $allowed_tables)) {
    die('Invalid table name');
}

require_once 'Sign/dbconnection.php';

// Delete the row in the specified table
$stmt = $connection->prepare("DELETE FROM $table WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

header("Location: " . $_SERVER['HTTP_REFERER']);
?>