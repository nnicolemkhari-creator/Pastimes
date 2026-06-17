<?php

$brand = $_POST['brand'];
$description = $_POST['description'];
$price = $_POST['price'];

echo "<h2>Request Submitted Successfully!</h2>";

echo "Brand: " . $brand . "<br>";
echo "Description: " . $description . "<br>";
echo "Price: R" . $price . "<br>";

?>