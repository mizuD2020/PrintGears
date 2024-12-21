<?php
session_start();
include 'header.php';

// Initialize variables
$search_query = isset($_GET['category']) ? $_GET['category'] : ''; // Retrieve category search query
$result = mysqli_query($connection, "SELECT * FROM categories");
$products = [];

// Handle category search
if (!empty($search_query)) {
    // Search for category ID based on category name
    $category_query = mysqli_real_escape_string($connection, $search_query);
    $category_result = mysqli_query($connection, "SELECT id FROM categories WHERE name LIKE '%$category_query%'");
    $category_ids = [];
    while ($row = mysqli_fetch_assoc($category_result)) {
        $category_ids[] = $row['id'];
    }

    // Fetch products with matching category IDs and stock greater than 0
    if (!empty($category_ids)) {
        $category_ids_str = implode(",", $category_ids);
        $product_query = "SELECT * FROM product WHERE category_id IN ($category_ids_str) AND stock > 0 AND is_requested = false";
        $product_query .= " ORDER BY FIELD(category_id, $category_ids_str) DESC";
        $products_result = mysqli_query($connection, $product_query);
        $heading_text = $search_query;
        while ($row = mysqli_fetch_assoc($products_result)) {
            $products[] = $row;
        }
    } else {
        $heading_text = "Prime selections";
    }
} else {
    $heading_text = "Prime selections";
}

// If no specific category search, fetch all products with stock greater than 0
if (empty($products)) {
    $products_result = mysqli_query($connection, "SELECT * FROM product WHERE stock > 0 AND is_requested = false");
    while ($row = mysqli_fetch_assoc($products_result)) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PrintGears</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {
            <?php if (isset($_SESSION['message'])) { ?>
                Swal.fire({
                    title: '<?php echo $_SESSION['message']; ?>',
                    icon: '<?php echo $_SESSION['message'] == "product added to cart!" ? "success" : "warning"; ?>'
                });
                <?php unset($_SESSION['message']); ?>
            <?php } ?>
            $(".category-link").click(function (e) {
                e.preventDefault();
                var category = $(this).text().trim();
                $("#category-heading").text(category);
            });

            $(".category-card").click(function () {
                var category = $(this).data('category');
                window.location.href = 'index.php?category=' + encodeURIComponent(category);
            });
        });
    </script>

    <style>
        body {
            background-color: blanchedalmond;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body::-webkit-scrollbar {
            display: none;
        }

        h1 {
            color: black;
            font-family: cursive;
            font-weight: bolder;
            font-size: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: calc(100vm-280px);
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .category-section {
            width: 280px;
            margin-left: auto;
            margin-right: 20px;
            position: fixed;
            margin-top: 10px;
            right: 0;
            overflow-y: auto;
            padding: 10px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .category-card {
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .category-card:hover {
            background-color: #f0f0f0;
        }

        .category-card img {
            max-width: 80px;
            max-height: 80px;
            margin-right: 10px;
            border-radius: 8px;
        }

        .category-card span {
            flex-grow: 1;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-section {
            width: calc(100% - 320px);
            /* Accounts for category width and margin */
            margin-left: 320px;
            padding: 20px;
        }

        .product_image {
            padding: 10px;
            width: 100%;
            height: 180px;
        }

        .img-fluid {
            max-width: 100%;
            height: 180px;
        }

        .card {
            width: 250px;
            background-color: #333;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-title,
        .card-text {
            color: white;
        }

        .card-body {
            text-align: center;
        }

        .btn-primary {

            background-color: #007bff;
            border-color: #007bff;
            padding: 8px 12px;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .sticky-category {
            position: sticky;
            top: 0;
        }

        .scrollable-categories {
            max-height: calc(100vh - 50px);
            overflow-y: auto;
        }

        .scrollable-categories::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-categories::-webkit-scrollbar-thumb {
            background-color: gray;
            border-radius: 4px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="product-section">
            <h1><?php echo $heading_text; ?></h1>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php foreach ($products as $product) { ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="product_image">
                                <img src="<?php echo $product['image']; ?>" class="card-img-top img-fluid"
                                    alt="product Image">
                            </div>
                            <div class=" card-body">
                                <h4 class="card-title"><?php echo $product['name']; ?></h4>
                                <h6 class="card-title"><?php echo "Rs." . $product['price'] . " per product"; ?></h6>
                                <h6 class="card-title"><?php echo "Stock " . $product['stock']; ?></h6>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="<?php echo 'add_to_cart.php?product_id=' . $product['id']; ?>"
                                        class="btn btn-primary">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="category-section">
            <div class="sticky-category">
                <div class="card-header">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="scrollable-categories">
                    <div class="list-group list-group-flush">
                        <?php
                        $count = 0;
                        while ($category = mysqli_fetch_assoc($result)) {
                            if ($category['name'] != 'Custom') {
                                if ($count > 0 && $count % 5 == 0) {
                                    echo '</div><div class="list-group list-group-flush">';
                                }
                                ?>
                                <div class="list-group-item category-card" data-category="<?php echo $category['name']; ?>">
                                    <img src="<?php echo $category['image']; ?>" class="img-fluid" alt="Category Image">
                                    <span><?php echo $category['name']; ?></span>
                                </div>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>