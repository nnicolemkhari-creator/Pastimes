<?php
session_start();
include 'DBConn.php';

$result = $conn->query("SELECT * FROM tblproducts WHERE status='Approved'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header class="navbar">
    <div class="logo">P</div>
    <h2 class="brand">Pastimes</h2>

    <input type="text"
           placeholder="Search..."
           class="search">

    <nav>
        <a href="index.php">Home</a>
        <a href="messages.php">Messages</a>
        <a href="sell.php" class="sell-btn">+ Sell</a>
        <a href="cart.php">🛒</a>
        <a href="login.php">👤</a>
    </nav>
</header>

<h1 style="text-align:center;margin-top:30px;">
Available Clothing
</h1>

<div class="product-grid">

<?php

if($result->num_rows > 0)
{

while($row = $result->fetch_assoc())
{

?>

<div class="product-card">

<a href="productDetails.php?id=<?=$row['productID']?>">

<img src="images/uploaded/<?=$row['image']?>">

<h3><?=$row['productName']?></h3>

<p><?=$row['brand']?></p>

<p>R<?=$row['price']?></p>

</a>

</div>

<?php

}

}
else
{

echo "<h2>No approved products available.</h2>";

}

?>

</div>

</body>
</html>