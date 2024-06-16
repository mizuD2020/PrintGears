<?php
include 'dbconnect.php';

$user_id = $_GET['user_id'];

$orders = mysqli_query($conn, "SELECT order_item.id, sticker.name, sticker.image, sticker.price, order_item.quantity, `order`.order_date FROM order_item JOIN sticker ON sticker.id = order_item.sticker_id JOIN `order` ON `order`.id = order_item.order_id WHERE `order`.user_id = $user_id");

if (mysqli_num_rows($orders) == 0) {
    die('<div class="alert alert-warning">This user has no current orders.</div>');
}

$order_items = mysqli_fetch_all($orders, MYSQLI_ASSOC);
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Order Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item) { ?>
                <tr>
                    <td><img src="<?php echo $item['image']; ?>" class="img-fluid" style="max-height: 100px;"
                            alt="<?php echo $item['name']; ?>"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>Rs <?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rs <?php echo $item['price'] * $item['quantity']; ?></td>
                    <td><?php echo date('F j, Y', strtotime($item['order_date'])); ?></td>
                    <td>
                        <button class="btn btn-success" onclick="markOrderReceived(<?php echo $item['id']; ?>)">Receive
                            order</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function markOrderReceived(orderItemId) {
        $.ajax({
            url: 'mark_order_received.php',
            type: 'POST',
            data: { order_item_id: orderItemId },
            success: function (response) {
                alert("Order marked as received!");
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("Error marking order as received. Please try again.");
            }
        });
    }
</script>