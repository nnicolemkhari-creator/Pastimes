<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$currentUserID = $_SESSION['user']['userID'];

// Query unique message threads involving the user
$inboxStmt = $conn->prepare("
    SELECT m.*, p.productName, 
           CASE WHEN m.senderID = ? THEN u2.fullName ELSE u1.fullName END AS chatPartnerName,
           CASE WHEN m.senderID = ? THEN m.receiverID ELSE m.senderID END AS chatPartnerID
    FROM tblMessages m
    JOIN tblProducts p ON m.productID = p.productID
    JOIN tblUser u1 ON m.senderID = u1.userID
    JOIN tblUser u2 ON m.receiverID = u2.userID
    WHERE m.messageID IN (
        SELECT MAX(messageID) 
        FROM tblMessages 
        WHERE senderID = ? OR receiverID = ? 
        GROUP BY productID, LEAST(senderID, receiverID), GREATEST(senderID, receiverID)
    )
    ORDER BY m.timestamp DESC
");
$inboxStmt->bind_param("iiii", $currentUserID, $currentUserID, $currentUserID, $currentUserID);
$inboxStmt->execute();
$inboxResult = $inboxStmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Inbox</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="navbar">
    <div class="logo">P</div>
    <h2 class="brand">Pastimes</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="messages.php"><b>Messages</b></a>
        <a href="myListings.php">My Listings</a>
    </nav>
</header>

<div class="admin-container">
    <h1>Your Conversations</h1>
    <table class="custom-table">
        <tr>
            <th>Product</th>
            <th>Chatting With</th>
            <th>Last Message</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $inboxResult->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['productName']) ?></td>
            <td><?= htmlspecialchars($row['chatPartnerName']) ?></td>
            <td><?= htmlspecialchars($row['messageText']) ?></td>
            <td>
                <a href="chat.php?product_id=<?= $row['productID'] ?>&receiver_id=<?= $row['chatPartnerID'] ?>">
                    <button>Open Chat</button>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
        <?php if ($inboxResult->num_rows === 0): ?>
        <tr>
            <td colspan="4" style="text-align:center;">No messages found.</td>
        </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>