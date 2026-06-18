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
    echo "<p>Description: Stylish second-hand vintage shirt.</p>";
    echo "<p>Price: R250</p>";
    echo "<p>Condition: Good</p>";
}
elseif ($id == 2) {
    echo "<h1>Baige Hoodie</h1>";
    echo "<img src='images/hoodie1.jpg' width='300'>";
    echo "<p>Description: Clean white sneakers with a modern sporty look.</p>";
    echo "<p>Price: R350</p>";
    echo "<p>Condition: Excellent</p>";
}
elseif ($id == 3) {
    echo "<h1>White Sneakers</h1>";
    echo "<img src='images/shoes1.jpg' width='300'>";
    echo "<p>Description: Clean white sneakers with a modern sporty look.</p>";
    echo "<p>Price: R500</p>";
    echo "<p>Condition: Like New</p>";
}
elseif ($id == 4) {
    echo "<h1>Leather jacket</h1>";
    echo "<img src='images/jacket1.jpg' width='300'>";
    echo "<p>Description: Burgundy leather jacket suitable for all seasons.</p>";
    echo "<p>Price: R450</p>";
    echo "<p>Condition: Excellent</p>";
}
elseif ($id == 5) {
    echo "<h1>Jeans</h1>";
    echo "<img src='images/jeans1.jpg' width='300'>";
    echo "<p>Description: Stylish denim jeans in great condition</p>";
    echo "<p>Price: R300</p>";
    echo "<p>Condition: Excellent</p>";

}
?>

<br><br>
<button>Add to cart</button>

</body>
</html>