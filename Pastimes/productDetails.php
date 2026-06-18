<?php
session_start();
include 'DBConn.php';

if (!isset($_GET['id'])) {
    die("No product selected.");
}

$productID = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT
        p.*,
        u.fullName
    FROM tblProducts p
    JOIN tblUser u
    ON p.sellerID = u.userID
    WHERE p.productID = ?
");

$stmt->bind_param("i", $productID);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>

<title><?= htmlspecialchars($product['productName']) ?></title>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<header class="navbar">

<div class="logo">P</div>

<h2 class="brand">Pastimes</h2>

<input
type="text"
class="search"
placeholder="Search...">

<nav>

<a href="index.php">Home</a>

<a href="products.php">Products</a>

<a href="sell.php" class="sell-btn">+ Sell</a>

<a href="cart.php">🛒</a>

</nav>

</header>

<div class="details-container">

<img
class="details-image"
src="images/uploaded/<?= htmlspecialchars($product['image']) ?>">

<div class="details-info">

<h1><?= htmlspecialchars($product['productName']) ?></h1>

<h2>Brand: <?= htmlspecialchars($product['brand']) ?></h2>

<h3>Price: R<?= number_format($product['price'], 2) ?></h3>

<p>

<strong>Category:</strong>

<?= htmlspecialchars($product['category']) ?>

</p>

<p>

<strong>Condition:</strong>

<?= htmlspecialchars($product['productCondition']) ?>

</p>

<p>

<strong>Seller:</strong>

<?= htmlspecialchars($product['fullName']) ?>

</p>

<p>

<strong>Description</strong>

</p>

<p>

<?= nl2br(htmlspecialchars($product['productDescription'])) ?>

</p>

<form action="cart_logic.php" method="POST">

<input
type="hidden"
name="product_id"
value="<?= $product['productID'] ?>">

<input
type="hidden"
name="product_name"
value="<?= htmlspecialchars($product['productName']) ?>">

<input
type="hidden"
name="product_price"
value="<?= $product['price'] ?>">

<button
type="submit"
name="add_to_cart">

Add To Cart

</button>

</form>

<br>

<a href="messages.php?productID=<?= $product['productID'] ?>">

<button>

Contact Seller

</button>

</a>

</div>

</div>

</body>

</html>