<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 
include 'DBConn.php';

// 1. Double check that the user is actually logged in
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
} 

// 2. Grab the current user's ID safely from the session array
$sellerID = $_SESSION['user']['userID'];

// 3. STRICTLY filter the query using 'WHERE sellerID = ?' so users only see their own items
$stmt = $conn->prepare("SELECT * FROM tblProducts WHERE sellerID = ? ORDER BY productID DESC"); 

if (!$stmt) {
    die("Database Query Preparation Failed: " . $conn->error);
}

$stmt->bind_param("i", $sellerID); 
$stmt->execute();
$result = $stmt->get_result(); 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>My Listings</title> 
    <link rel="stylesheet" href="styles.css"> 
</head> 
<body> 
    <header class="navbar"> 
        <div class="logo">P</div> 
        <h2 class="brand">Pastimes</h2> 
        <nav> 
            <a href="index.php">Home</a> 
            <a href="products.php">Products</a> 
            <a href="messages.php">Messages</a>
            <a href="sell.php" class="sell-btn">+ Sell</a> 
            <a href="cart.php">Cart</a> 
        </nav> 
    </header> 

    <div class="admin-container" style="padding: 20px; max-width: 1000px; margin: auto;"> 
        <h1>My Personal Listings</h1> 
        <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top: 20px;"> 
            <tr> 
                <th>Image</th> 
                <th>Product</th> 
                <th>Brand</th> 
                <th>Price</th> 
                <th>Status</th> 
                <th>Actions</th> 
            </tr> 
            <?php while($row = $result->fetch_assoc()) { ?> 
            <tr> 
                <td> 
                    <img src="images/uploaded/<?= htmlspecialchars($row['image']) ?>" width="100" alt="Product"> 
                </td> 
                <td><?= htmlspecialchars($row['productName']) ?></td> 
                <td><?= htmlspecialchars($row['brand']) ?></td> 
                <td>R<?= number_format($row['price'], 2) ?></td> 
                <td>
                    <?php 
                        $status = htmlspecialchars($row['status']);
                        if ($status == 'Approved') { echo "<span style='color:green; font-weight:bold;'>Approved</span>"; }
                        elseif ($status == 'Rejected') { echo "<span style='color:red; font-weight:bold;'>Rejected</span>"; }
                        else { echo "<span style='color:orange; font-weight:bold;'>Pending</span>"; }
                    ?>
                </td> 
                <td> 
                    <a href="editListing.php?id=<?= $row['productID'] ?>"> 
                        <button>Edit</button> 
                    </a> 
                    <br><br> 
                    <a href="deleteListing.php?id=<?= $row['productID'] ?>" onclick="return confirm('Are you sure you want to delete this listing?');"> 
                        <button style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer;">Delete</button> 
                    </a> 
                </td> 
            </tr> 
            <?php } ?> 
            
            <?php if ($result->num_rows === 0): ?>
            <tr>
                <td colspan="6" style="text-align: center; color: #777;">You haven't listed any items for sale yet.</td>
            </tr>
            <?php endif; ?>
        </table> 
    </div> 
</body> 
</html>