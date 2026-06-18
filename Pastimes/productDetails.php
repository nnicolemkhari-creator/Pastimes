<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

// Get the product ID from the URL parameters
$productID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productID === 0) {
    die("<div style='padding:50px; text-align:center; font-family:sans-serif;'>
            <h2 style='color:#e60023;'>Product Not Found</h2>
            <p>No product identifier specified.</p>
            <a href='products.php' style='color:#e60023; font-weight:bold;'>Return to Marketplace</a>
         </div>");
}

// Fetch details for the specified product along with the seller's names
$query = "SELECT p.*, u.fullName, u.email 
          FROM tblproducts p 
          JOIN tbluser u ON p.sellerID = u.userID 
          WHERE p.productID = ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Database query generation failed: " . $conn->error);
}
$stmt->bind_param("i", $productID);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("<div style='padding:50px; text-align:center; font-family:sans-serif;'>
            <h2 style='color:#e60023;'>Item Unavailable</h2>
            <p>This item listing has either been removed or is pending approval.</p>
            <a href='products.php' style='color:#e60023; font-weight:bold;'>Return to Marketplace</a>
         </div>");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['productName']) ?> - Pastimes</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Small layout adjustments to ensure buttons sit nicely */
        .action-container {
            margin-top: 25px;
        }
        .action-container .sell-btn {
            border: none;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            font-size: 16px;
            padding: 12px 24px;
            text-decoration: none;
        }
        .seller-badge {
            display: inline-block;
            background: #f1f1f1;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<header class="navbar"> 
    <div class="logo">P</div> 
    <h2 class="brand">Pastimes</h2> 
    <nav> 
        <a href="index.php">Home</a> 
        <a href="products.php">Products</a> 
        <a href="messages.php">Messages</a> 
        <a href="myListings.php">My Listings</a>
    </nav> 
</header> 

<div class="details-container">
<img src="images/uploaded/<?= htmlspecialchars($product['image']) ?>" 
class="details-image" 
alt="<?= htmlspecialchars($product['productName']) ?>"
style="width: 100%; max-height: 550px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">

    <div class="details-info">
        <span class="seller-badge">Listed by: <?= htmlspecialchars($product['fullName']) ?></span>
        
        <h1><?= htmlspecialchars($product['productName']) ?></h1>
        
        <?php if (!empty($product['brand'])): ?>
            <h2>Brand: <?= htmlspecialchars($product['brand']) ?></h2>
        <?php endif; ?>
        
        <h3>R <?= number_format($product['price'], 2) ?></h3>
        
        <p><?= nl2br(htmlspecialchars($product['productDescription'])) ?></p>

        <div class="action-container">
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['userID'] != $product['sellerID']): ?>
                    <a href="chat.php?product_id=<?= $product['productID'] ?>&receiver_id=<?= $product['sellerID'] ?>" class="sell-btn">
                        💬 Contact Seller
                    </a>
                <?php else: ?>
                    <a href="editListing.php?id=<?= $product['productID'] ?>" class="sell-btn" style="background-color: #333;">
                        ⚙️ Edit My Listing
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" class="sell-btn">
                    🔒 Log in to Message Seller
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div style="max-width: 1400px; margin: 20px auto; padding: 0 50px;">
    <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">
    <a href="products.php" style="color: #666; text-decoration: none; font-size: 14px;">← Back to Explore All Products</a>
</div>

</body>
</html>