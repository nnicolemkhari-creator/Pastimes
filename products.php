<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
        }
        img {
            width: 100%;
        }
        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">P</div>
    <h2 class="brand">Pastimes</h2>

    <input type="text" placeholder="Search for items, brands, or sellers..." class="search">

    <nav>
        <a href="index.php">Home❤️</a>
        <a href="sell.php" class="sell-btn">+ Sell</a>
        <a href="cart.php">Cart🛒</a>
        <a href="login.php">Login👤</a>
    </nav>
</header>

<h1>Available Clothing</h1>

<div class="container">

    <div class="product">
        <a href="productDetails.php?id=1">
            <img src="images/shirt1.jpg">
            <h3>Vintage Shirt</h3>
            <p>R250</p>
        </a>
    </div>

    <div class="product">
        <a href="productDetails.php?id=2">
            <img src="images/hoodie1.jpg">
            <h3>Black Hoodie</h3>
            <p>R350</p>
        </a>
    </div>

    <div class="product">
        <a href="productDetails.php?id=3">
            <img src="images/shoes1.jpg">
            <h3>White Sneakers</h3>
            <p>R500</p>
        </a>
    </div>

</div>

</body>
</html>