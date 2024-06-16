<?php

include ("./Sign/dbconnection.php");

// Initialize variables
$search_query = "";
$cart_count = 0;

// Check if user is logged in
if (isset($_SESSION['user'])) {
    // Retrieve user's cart count
    $cart = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM cart WHERE user_id = '{$_SESSION['user']['id']}'"));
    if (isset($cart)) {
        $cart_items = mysqli_query($connection, "SELECT * FROM cart_item WHERE cart_id = '{$cart['id']}'");
        $cart_count = mysqli_num_rows($cart_items);
    }
}

// Handle search form submission
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search_query = $_GET['search_query'];
    header("Location: index.php?category=" . urlencode($search_query));
    exit();
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MizuStickers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .navbar .search-form {
            width: 50%;
            margin: auto;
        }

        body {
            background-color: black;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/mizustickers">
                <img src="logo2.png" alt="Logo" width="260">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <form class="d-flex search-form" method="get" action="index.php">
                    <input class="form-control me-2" type="search" placeholder="Search Anime" aria-label="Search"
                        name="search_query" value="<?php echo htmlspecialchars($search_query); ?>" style="width: 250px">
                    <button class="btn btn-outline-primary" type="submit" name="search">Search</button>
                </form>
            </div>
            <div class="collapse navbar-collapse w-100 justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <?php
                    if (!isset($_SESSION['user'])) { ?>
                        <li class="nav-iteam">
                            <a class="nav-link" href="Sign/SignUp.php">
                                <button class="btn btn-primary">
                                    <strong>Sign up</strong>
                                </button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Sign/signIn.php">
                                <button class="btn btn-outline-primary">
                                    Log in
                                </button>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a href="orders.php" class="btn btn-primary"><i class="bi bi-upload"></i>&nbsp;
                                My orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="uploadsticker.php" class="btn btn-primary"><i class="bi bi-upload"></i>&nbsp;Customize
                                Stickers</a>
                        </li>
                        <li class="nav-item position-relative">
                            <a href="cart.php" class="btn btn-primary"><i class="bi bi-cart"></i>&nbsp;View Cart
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $cart_count; ?>
                                    <span class="visually-hidden">cart</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-danger"><i
                                    class="bi bi-box-arrow-right"></i>&nbsp;Logout</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

</body>

</html>