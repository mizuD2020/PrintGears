<?php

include "dbconnect.php";


$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>SN</th><th>Username</th><th>Quantity Purchased</th><th>Total amount</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["SN"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No users found.";
}

$conn->close();
?>