<header>
    <div class="logo1">
        <a href="index.html"><img src="logo2.png" alt="Logo"></a>

    </div>
    <div class="search-bar">
        <div class="search-container">
            <form>
                <input type="text" placeholder="Search..." style="background: #302D2D;">
                <button type="submit" style="background-color: #302D2D;"><img src="search.png" alt="Search"
                        style="width: 30px;"></button>
            </form>
        </div>
        <nav class="navigation">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="cart.html"><img src="cart-icon.png" alt="Cart"></a></li>
                <li><a href="#"><img src="upload.png" alt="Upload"></a></li>
                <li><?php
                session_start();
                if (isset($_SESSION['username'])): ?>
                    <li class="profile-menu">
                        <img src="path/to/user-icon.png" alt="User Icon" class="user-icon" onclick="toggleDropdown()">
                        <div class="dropdown-content" id="profileDropdown">
                            <a href="profile.php">My Profile</a>
                            <a href="Sign/logout.php">Logout</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="Sign/signIn.php">Login</a></li>
                <?php endif; ?>
                </li>

            </ul>
        </nav>
</header>