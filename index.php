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

    // Fetch stickers with matching category IDs first
    if (!empty($category_ids)) {
        $category_ids_str = implode(",", $category_ids);
        $sticker_query = "SELECT * FROM sticker WHERE category_id IN ($category_ids_str) AND is_requested = false";
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

// If no specific category search, fetch all stickers
if (empty($stickers)) {
    $stickers_result = mysqli_query($connection, "SELECT * FROM sticker WHERE is_requested = false");
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
            /* Ensure content doesn't overlap with sticky header */
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
            margin: 0;

        }



        .category-card {
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            width: 240px;
            /* Adjusted width */
            margin-bottom: 10px;
            /* Added margin for spacing between cards */
        }

        .category-card:hover {
            background-color: #f0f0f0;
        }

        .card-header {
            margin-bottom: 10px;
            color: white;
            text-align: center;
            width: 240px;
            /* Adjusted width */
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


        /* Sticky category section */
        .sticky-category {
            /* margin-left: 40px; */
            width: 260px;
            margin-top: 20px;
            position: sticky;
            top: 20px;
            /* Adjust as needed */
            z-index: 1000;
        }

        /* Separate scrollable area for categories */
        .scrollable-categories {
            max-height: calc(100vh - 50px);
            /* Adjust height as needed */
            overflow: scroll;
            padding-right: 5px;
            /* Adjust for scrollbar */
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

        .sticker_image {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1><?php echo $heading_text; ?></h1>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php foreach ($stickers as $sticker) { ?>
                        <div>
                            <div class="card h-80">
                                <div class="sticker_image">
                                    <img src="<?php echo $sticker['image']; ?>" class="card-img-top img-fluid"
                                        alt="Sticker Image">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $sticker['name']; ?></h5>
                                    <h5 class="card-title"><?php echo "Rs " . $sticker['price']; ?></h5>

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

            <div class="col-2">
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
    </div>
</body>

</html>