<?php
session_start();
include 'header.php';

// Initialize variables
$search_query = isset($_GET['category']) ? $_GET['category'] : ''; // Retrieve category search query
$result = mysqli_query($connection, "SELECT * FROM categories");
$stickers = [];

// Handle category search
if (!empty($search_query)) {
    // Search for category ID based on category name
    $category_query = mysqli_real_escape_string($connection, $search_query);
    $category_result = mysqli_query($connection, "SELECT id FROM categories WHERE name LIKE '%$category_query%'");
    $category_ids = [];
    while ($row = mysqli_fetch_assoc($category_result)) {
        $category_ids[] = $row['id'];
    }

    // Fetch stickers with matching category IDs and stock greater than 0
    if (!empty($category_ids)) {
        $category_ids_str = implode(",", $category_ids);
        $sticker_query = "SELECT * FROM sticker WHERE category_id IN ($category_ids_str) AND stock > 0 AND is_requested = false";
        $sticker_query .= " ORDER BY FIELD(category_id, $category_ids_str) DESC";
        $stickers_result = mysqli_query($connection, $sticker_query);
        $heading_text = $search_query;
        while ($row = mysqli_fetch_assoc($stickers_result)) {
            $stickers[] = $row;
        }
    } else {
        $heading_text = "Recently Added";
    }
} else {
    $heading_text = "Recently Added";
}

// If no specific category search, fetch all stickers with stock greater than 0
if (empty($stickers)) {
    $stickers_result = mysqli_query($connection, "SELECT * FROM sticker WHERE stock > 0 AND is_requested = false");
    while ($row = mysqli_fetch_assoc($stickers_result)) {
        $stickers[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sticker Shop</title>
    <!-- Add your CSS and other header elements here -->

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
                    icon: '<?php echo $_SESSION['message'] == "Sticker added to cart!" ? "success" : "warning"; ?>'
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
            background-color: black;
            margin: 0;
            padding: 0;
        }

        body::-webkit-scrollbar {
            display: none;
        }


        h1 {
            color: white;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: bolder;
            font-size: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .container {

            display: flex;
            justify-content: space-between;
        }


        .category-section {
            width: 280px;
            margin-left: auto;
            /* Push category section to the right */
            margin-right: 20px;
            right: 0;
            position: fixed;
            /* 20px margin between category and stickers */
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
        }

        .category-card span {
            flex-grow: 1;
            font-weight: bold;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sticky-category {
            width: 280px;
            position: sticky;
            position: right;
            top: 20px;
            z-index: 1000;
        }

        .scrollable-categories {
            max-height: calc(100vh - 50px);
            overflow: scroll;
            padding-right: 5px;
        }

        .scrollable-categories::-webkit-scrollbar {
            width: 10px;
            background-color: gray;
            border-radius: 5px;
        }

        .scrollable-categories .list-group-item {
            cursor: pointer;
            padding: 10px;
            border-radius: 2px;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .scrollable-categories .list-group-item:hover {
            background-color: #f0f0f0;
        }

        .sticker-section {
            width: calc(100% - 280px);
            /* Subtract the width of the category section plus margin */
            margin-right: 20px;
            /* Add margin on the right side to create space */
        }

        .sticker_image {
            padding: 10px;
            width: 100%;
            height: 180px;
        }

        .img-fluid {
            max-width: 100%;
            height: 180px;
        }

        .card-body {
            width: 200px;
        }

        .card {
            width: 200px;
            background-color: #333;
            border: none;
        }

        .card-title,
        .card-text {
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        h5 {
            text-align: center;
            color: white;
            padding-top: 20px;
            padding-bottom: 20px;
            font-size: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sticker-section">
            <h1><?php echo $heading_text; ?></h1>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php foreach ($stickers as $sticker) { ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="sticker_image">
                                <img src="<?php echo $sticker['image']; ?>" class="card-img-top img-fluid"
                                    alt="Sticker Image">
                            </div>
                            <div class=" card-body">
                                <h4 class="card-title"><?php echo $sticker['name']; ?></h4>
                                <h6 class="card-title"><?php echo "Rs." . $sticker['price'] . " per sticker"; ?></h6>
                                <h6 class="card-title"><?php echo "Stock " . $sticker['stock']; ?></h6>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="<?php echo 'add_to_cart.php?sticker_id=' . $sticker['id']; ?>"
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