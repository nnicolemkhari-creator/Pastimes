<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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

<h1>Available Clothing</h1>

<div class="product">

    <a href="productDetails.php?id=1">

        <img src="images/shirt1.jpg">

        <h3>Vintage Shirt</h3>

        <p>Brand: Nike</p>

        <p>R250</p>

    </a>

    <button>Add To Cart</button>

</div>

<div class="product">

    <a href="productDetails.php?id=2">

        <img src="images/hoodie1.jpg">

        <h3>Black Hoodie</h3>

        <p>R350</p>

    </a>

    <button>Add To Cart</button>

</div>

<div class="product">

    <a href="productDetails.php?id=3">

        <img src="images/shoes1.jpg">

        <h3>White Sneakers</h3>

        <p>Brand: Nike</p>

        <p>R700</p>

    </a>

    <button>Add To Cart</button>
</div>

</div>

</body>
</html>