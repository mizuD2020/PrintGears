<?php
session_start();
include "dbconnect.php"; // Include your database connection file

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch order history of the specified user
    $order_history = mysqli_query($connection, "SELECT sticker.name, sticker.image, sticker.price, order_history.quantity, order_history.expected_delivery_date FROM order_history JOIN sticker ON sticker.id = order_history.sticker_id WHERE order_history.user_id = $user_id");

    $history_items = mysqli_fetch_all($order_history, MYSQLI_ASSOC);

    if (!empty($history_items)) {
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Expected Delivery Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history_items as $item) { ?>
                    <tr>
                        <td><img src="<?php echo $item['image'] ?>" class="img-fluid" style="max-height: 100px;"
                                alt="<?php echo $item['name'] ?>"></td>
                        <td><?php echo $item['name'] ?></td>
                        <td>Rs <?php echo $item['price'] ?></td>
                        <td><?php echo $item['quantity'] ?></td>
                        <td><?php echo $item['expected_delivery_date'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    } else {
        echo '<p>No order history found for this user.</p>';
    }
}
?>