<!DOCTYPE html>
<html lang="en">
<?php
include ("./Sign/dbconnection.php");
$result = mysqli_query($connection, "SELECT * FROM categories");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="static/css/stylesHeader.css">
    <link rel="stylesheet" href="static/css/bodystyle.css">

</head>

<body>
    <?php
    include 'header.php';
    ?>


    <div class="recently-added">
        <h1>Recently Added</h1>
        <div class="line"></div>
    </div>

    <div class="items-container">
    </div>
    <div class="category">
        <h2 style="text-align: center;">Category</h2>
        <div class="categoryData">
            <?php
            while ($category = mysqli_fetch_assoc($result)) {
                ?>
                <div class="category">
                    <p><?php echo $category['Name'] ?></p>
                    <img src="<?php echo $category['Images'] ?>" />
                </div>

            <?php }
            if (!mysqli_num_rows($result)) {
                echo "<p> There are no categories </p>";
            }
            ?>
        </div>
    </div>

    <script src="static/js/scriptphp.js"></script>
    <script src="static/js/scriptcategory.js"></script>
</body>

</html>