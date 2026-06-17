<?php
session_start(); // Important: Always at the top!
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Default values so the form doesn't error out if no product is found
$name = "";
$price = 0;
$found = false;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">P</div>
    <h2 class="brand">Pastimes</h2>

    <input type="text" placeholder="Search for items, brands, or sellers..." class="search">

    <nav>
        <a href="index.php">Home</a>
        <a href="sell.php" class="sell-btn">+ Sell</a>
        <a href="products.php">❤️</a>
        <a href="cart.php">🛒</a>
        <a href="login.php">👤</a>
    </nav>
</header>

<div class="product-detail-container">
    <?php
    if ($id === 1) {
        $name = "Vintage Shirt";
        $price = 250;
        $found = true;
        echo "<h1>$name</h1>";
        echo "<img src='images/shirt1.jpg' width='300'>";
        echo "<p>Price: R$price</p>";
        echo "<p>Condition: Good</p>";
    }
    elseif ($id === 2) {
        $name = "Beige Hoodie";
        $price = 350;
        $found = true;
        echo "<h1>$name</h1>";
        echo "<img src='images/hoodie1.jpg' width='300'>";
        echo "<p>Price: R$price</p>";
        echo "<p>Condition: Excellent</p>";
    }  
    elseif ($id === 3) {
        $name = "White Sneakers";
        $price = 500;
        $found = true;
        echo "<h1>$name</h1>";
        echo "<img src='images/shoes1.jpg' width='300'>";
        echo "<p>Price: R$price</p>";
        echo "<p>Condition: Like New</p>";
    }

    // --- THE UPDATED FORM SECTION ---
    if ($found) {
        ?>
        <form method="POST" action="./cart_logic.php">
            <input type="hidden" name="product_id" value="<?php echo $id; ?>">
            <input type="hidden" name="product_name" value="<?php echo $name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $price; ?>">
            
            <br>
            <!-- We keep the label "Buy Now" but give it the "add_to_cart" name for the PHP -->
            <button type="submit" name="add_to_cart" class="primary-btn">
                Buy Now
            </button>
        </form>
        <?php
    } else {
        echo "<h1>Product not found</h1>";
    }
    ?>
</div>

</body>
</html>