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

        <p>Description: Stylish second-hand vintage shirt</p>

        <p>Brand: Nike</p>

        <p>Condition: Excellent </p>

        <p>R250</p>

    </a>

    <button>Add To Cart</button>

</div>

<div class="container">
<div class="product">

    <a href="productDetails.php?id=2">

        <img src="images/hoodie1.jpg">

        <h3>Beige Hoodie</h3>

        <p> Description: Comfortable black hoodie perfect for everyday wear.</p>

        <p>Brand: Sumwon</p>

        <p>Condition: Very Good </p>

        <p>R350</p>

    </a>

    <button>Add To Cart</button>

</div>

<div class="container">
<div class="product">

    <a href="productDetails.php?id=3">

        <img src="images/shoes1.jpg">

        <h3>White Sneakers</h3>

        <p> Description: Clean white sneakers with a modern sporty look.</p>

        <p>Brand: New Balance </p>

        <p>Condition: Like New </p>

        <p>R700</p>

    </a>

    <button>Add To Cart</button>

</div>

<div class="container">
<div class="product">

    <a href="productDetails.php?id=4">

        <img src="images/jacket1.jpg">

        <h3>Leather Jacket</h3>

        <p> Description: Burgundy leather jacket suitable for all seasons.</p>

        <p>Brand: Zara </p>

        <p>Condition: Excellent </p>

        <p>R450</p>

    </a>

    <button>Add To Cart</button>
</div>

<div class="container">
<div class="product">

    <a href="productDetails.php?id=5">

        <img src="images/jeans1.jpg">

        <h3>Jeans</h3>

        <p> Description: Stylish denim jeans in great condition.</p>

        <p>Brand: Levis </p>

        <p>Condition: Very Good </p>

        <p>R300</p>

    </a>

    <button>Add To Cart</button>
</div>



</div>

</body>
</html>