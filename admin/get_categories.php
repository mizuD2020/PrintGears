<?php

include "dbconnect.php";

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table id='item-table'>";
    echo "<tr><th>SN</th><th>Images</th><th>Name</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $image = $row["Images"];
        echo "<tr>";
        echo "<td>" . $row["SN"] . "</td>";
        echo "<td>" . "<img src='$image'>" . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td><div class='button-container'><button class='update'>Update</button><button class='delete'>Delete</button></div></td>";
        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "No items found.";
}

$conn->close();
?>