<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Admin Panel</h1>
    <nav class="admin-nav">
        <button class="nav-btn active" data-section="users">Users</button>
        <button class="nav-btn" data-section="items">Items</button>
        <button class="nav-btn" data-section="categories">Categories</button>
    </nav>

    <div class="section active" id="users">
        <h3>List of Users</h3>
        <div id="userList"></div>

        <!-- User list will be displayed here -->
    </div>

    <div class="section" id="items">
        <h3>List of Items</h3>
        <?php include 'get_items.php'; ?>

        <!-- Item list with update and delete buttons will be displayed here -->

        <button id="addItemButton" class="add-item-button">Add Item</button>
        <!-- Add Item Modal -->
        <div id="addItemModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Add New Item</h3>
                <form action="add_item.php" method="POST" enctype="multipart/form-data">
                    <label for="itemName">Name:</label>
                    <input type="text" id="itemName" name="itemName" required><br>
                    <label for="itemDescription">Description:</label>
                    <textarea id="itemDescription" name="itemDescription" required></textarea><br>
                    <label for="itemPrice">Price:</label>
                    <input type="number" id="itemPrice" name="itemPrice" required><br>
                    <label for="itemImage">Image:</label>
                    <input type="file" id="itemImage" name="itemImage" required accept="image/*" single><br>
                    <button type="submit">Add Item</button>
                </form>
            </div>
        </div>
    </div>

    <div class="section" id="categories">
        <h3>List of Categories</h3>
        <!-- Category list with update, delete buttons, and quantity will be displayed here -->
    </div>

    <script src="script.js"></script>
</body>

</html>