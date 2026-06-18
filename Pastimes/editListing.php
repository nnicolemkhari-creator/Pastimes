<?php 
session_start(); 
include 'DBConn.php'; 

if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
} 

$productID = (int)$_GET['id']; 
$sellerID = $_SESSION['user']['userID']; 

$stmt = $conn->prepare("SELECT * FROM tblProducts WHERE productID = ? AND sellerID = ?"); 
$stmt->bind_param("ii", $productID, $sellerID); 
$stmt->execute(); 
$product = $stmt->get_result()->fetch_assoc(); 

if (!$product) { die("Listing not found."); } 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $productName = $_POST['productName']; 
    $brand = $_POST['brand']; 
    $price = $_POST['price']; 
    $description = $_POST['description']; 
    
    $stmt = $conn->prepare("UPDATE tblProducts SET productName=?, brand=?, price=?, productDescription=?, status='Pending' WHERE productID=?"); 
    $stmt->bind_param("ssdsi", $productName, $brand, $price, $description, $productID); 
    $stmt->execute(); 
    header("Location: myListings.php"); 
    exit(); 
} 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Edit Listing</title> 
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
    </nav> 
</header> 

<div class="container" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #eee; margin-top: 60px;"> 
    <h1>Edit Your Listing</h1> 
    <p class="subtitle">Modifying your product details will return the product status to "Pending" for administrative re-review.</p>
    
    <form method="POST"> 
        <label>Product Name</label> 
        <input type="text" name="productName" value="<?= htmlspecialchars($product['productName']) ?>" required> 
        
        <label>Brand Name</label> 
        <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required> 
        
        <label>Asking Price (R)</label> 
        <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required> 
        
        <label>Item Condition & Description</label> 
        <textarea name="description" required><?= htmlspecialchars($product['productDescription']) ?></textarea> 
        
        <button type="submit">Save Changes</button> 
    </form> 
    
    <div class="bottom-link" style="text-align: center; margin-top: 20px;">
        <a href="myListings.php">Discard Changes and Exit</a>
    </div>
</div> 

</body> 
</html>