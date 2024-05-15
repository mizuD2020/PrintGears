<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="stylesHeader.css">
    <link rel="stylesheet" href="bodystyle.css">

</head>

<body>
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
                    <li><button class="btnlogin">

                            <a href="../Sign/signIn.php">Login</a></li>
                    </button>
                </ul>
            </nav>
    </header>


    <div class="recently-added">
        <h1>Recently Added</h1>
        <div class="line"></div>
    </div>

    <div class="items-container">
    </div>
    <div class="category">
        <h2 style="text-align: center;">Category</h2>
    </div>

    <script src="scriptphp.js"></script>

</body>

</html>