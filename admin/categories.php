<section class="main-content columns is-fullheight">
    <?php
    require("sidebar.php");
    require("dbconnect.php");
    $result = mysqli_query($conn, "SELECT * FROM categories");
    ?>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .main-content {
            display: flex;
            flex-wrap: wrap;
        }

        /* Container Styling */
        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Section Styling */
        .section {
            padding: 20px;
        }

        /* Card Styling */
        .card {
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: rgb(135, 170, 207);
            color: #ffffff;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .card-header-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-content {
            padding: 15px;
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1rem;
        }


        .table th {
            background-color: black;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }

        .table td {
            background-color: rgb(255, 255, 255);
            color: black;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table.is-striped tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table.is-hoverable tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styling */
        .button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button.is-primary {
            background-color: rgb(69, 129, 0);
            color: #ffffff;
        }

        .button.is-primary:hover {
            background-color: #0056b3;
        }

        .button.is-danger {
            background-color: rgb(255, 15, 39);
            color: #ffffff;
        }

        .button.is-danger:hover {
            background-color: #a71d2a;
        }

        .button.is-small {
            font-size: 0.8rem;
            padding: 5px 10px;
        }

        /* Image Styling */
        table td img {
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tr {
                display: block;
                margin-bottom: 15px;
            }

            .table td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }

            .buttons {
                justify-content: flex-end;
            }
    </style>

    <div class="container column is-10">
        <div class="section">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Categories</p>
                    <a href="add_category.php" class="button is-primary">Add Category</a>
                </div>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($category = mysqli_fetch_assoc($result)) {
                                $delete_url = '../delete.php?table=categories&id=' . $category['id'];
                                $edit_url = 'edit-category.php?id=' . $category['id'];
                                ?>
                                <tr>
                                    <td data-label="Name"><?php echo $category['name']; ?></td>
                                    <td data-label="Image"><img src="<?php echo $category['image']; ?>" height="30"
                                            width="30"></td>
                                    <td class="is-actions-cell">
                                        <div class="buttons is-right">
                                            <a href="<?php echo $edit_url; ?>" class="button is-small is-primary">
                                                Edit
                                            </a>
                                            <a href="<?php echo $delete_url ?>" class="button is-small is-danger jb-modal"
                                                data-target="sample-modal" type="button">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>