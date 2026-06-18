<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Sell Item</title>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<header class="navbar">

<div class="logo">P</div>

<h2 class="brand">Pastimes</h2>

<nav>

<a href="index.php">Home</a>

<a href="products.php">Products</a>

<a href="myListings.php">My Listings</a>

<a href="cart.php">Cart</a>

</nav>

</header>


<div class="container">

<h1>Sell Clothing</h1>

<form action="uploadItem.php"

method="POST"

enctype="multipart/form-data">

<label>Product Name</label>

<input
type="text"
name="productName"
required>

<label>Brand</label>

<input
type="text"
name="brand"
required>

<label>Category</label>

<select name="category">

<option>Tops</option>

<option>Hoodies</option>

<option>Jeans</option>

<option>Jackets</option>

<option>Shoes</option>

<option>Dresses</option>

<option>Accessories</option>

</select>

<label>Condition</label>

<select name="condition">

<option>Brand New</option>

<option>Excellent</option>

<option>Good</option>

<option>Fair</option>

</select>

<label>Price (R)</label>

<input
type="number"
step="0.01"
name="price"
required>

<label>Description</label>

<textarea

name="description"

rows="6"

required>

</textarea>

<label>Upload Image</label>

<input

type="file"

name="image"

accept="image/*"

required>

<br><br>

<button type="submit">

Submit Listing

</button>

</form>

</div>

</body>

</html>