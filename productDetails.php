<?php
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
</head>
<body>

<?php
if ($id == 1) {
    echo "<h1>Vintage Shirt</h1>";
    echo "<img src='images/shirt1.jpg' width='300'>";
    echo "<p>Price: R250</p>";
    echo "<p>Condition: Good</p>";
}
elseif ($id == 2) {
    echo "<h1>Baige Hoodie</h1>";
    echo "<img src='images/hoodie1.jpg' width='300'>";
    echo "<p>Price: R350</p>";
    echo "<p>Condition: Excellent</p>";
}
elseif ($id == 3) {
    echo "<h1>White Sneakers</h1>";
    echo "<img src='images/shoes1.jpg' width='300'>";
    echo "<p>Price: R500</p>";
    echo "<p>Condition: Like New</p>";
}
?>

<br><br>
<button>Buy Now</button>

</body>
</html>