<?php
include 'dbconnect.php';

$user_id = $_GET['user_id'];

$history = mysqli_query($conn, "SELECT sticker.name, sticker.image, sticker.price, order_history.quantity, order_history.order_date, order_history.expected_delivery_date FROM order_history JOIN sticker ON sticker.id = order_history.sticker_id WHERE order_history.user_id = $user_id ORDER BY order_history.order_date DESC");

if (mysqli_num_rows($history) == 0) {
    die('<div class="alert alert-warning">This user has no order history.</div>');
}

$history_items = mysqli_fetch_all($history, MYSQLI_ASSOC);
?>
<div class="container">
    <h2 class="my-4">Order History</h2>
    <div class="table-container">
        <table class="table is-fullwidth is-striped is-hoverable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Expected Delivery Date</th>
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
                        <td><?php echo date('F j, Y', strtotime($item['order_date'])); ?></td>
                        <td><?php echo date('F j, Y', strtotime($item['expected_delivery_date'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>