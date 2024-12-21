<?php
session_start();
$order_id = $_GET['order_id'];
require "Sign/dbconnection.php";
$order = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `order` WHERE id = $order_id"));
if (!$order) {
    die('Order not found.');
}
if (isset($_POST['submit'])) {
    $paymethod = $_POST['payment_method'];
    if ($paymethod == "khalti") {
        $curl = curl_init();
        $data = json_encode(array(
            "return_url" => "http://" . $_SERVER['HTTP_HOST'] . "/PrintGears/purchase.php",
            "website_url" => "http://" . $_SERVER['HTTP_HOST'] . "/PrintGears",
            "amount" => $order['total'] * 100,
            "purchase_order_id" => $_GET['order_id'],
            "purchase_order_name" => "test",
            "customer_info" => array(
                "name" => $_SESSION['user']['fullname'],
                "email" => $_SESSION['user']['email'],
            )
        ));
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: key 7869e37d1d084edda4c12696ca589155',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        header("Location: " . json_decode($response)->payment_url);
        exit();
    } else {
        $order_id = $_GET['order_id'];
        $sql = "UPDATE `order` SET order_status = 'paid', payment_method = 'COD' WHERE id = $order_id";
        if (mysqli_query($connection, $sql)) {
            header("Location: success.php?id=$order_id");
            exit();
        } else {
            header("Location: error.php?id=$order_id");
        }
    }
}
require "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Choose Payment Method</h1>
        <form method="post">
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" required>
                <label class="form-check-label" for="cod">
                    Cash on Delivery
                </label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="khalti" value="khalti" required>
                <label class="form-check-label" for="khalti">
                    Khalti Payment
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Proceed to Payment</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>