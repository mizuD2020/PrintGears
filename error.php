<?php
$order_id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">An Error Occurred!</h4>
            <p>Something went wrong while processing your request. Please try again.</p>
            <hr>
            <p class="mb-0">If the problem persists, please contact support.</p>
        </div>
        <a href="payment-method.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">Retry</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>