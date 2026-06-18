<?php
// 1. Force PHP errors to print out directly on screen instead of showing a blank page
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

// 2. Security Check - Redirect if user is not authenticated
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$senderID = $_SESSION['user']['userID'];

// 3. Fallback check: Ensure both product_id and receiver_id exist in the URL parameters
$productID = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;
$receiverID = isset($_GET['receiver_id']) ? (int)$_GET['receiver_id'] : 0;

if ($productID === 0 || $receiverID === 0) {
    die("<div style='padding:50px; text-align:center; font-family:sans-serif;'>
            <h2 style='color:#e60023;'>Conversation Load Failed</h2>
            <p>Missing product listing details or chat recipient indicators.</p>
            <a href='messages.php' style='color:#e60023; font-weight:bold;'>Return to Inbox Overview</a>
         </div>");
}

// 4. Action: Process incoming form inputs to append new messages
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_text'])) {
    $messageText = trim($_POST['message_text']);
    
    if (!empty($messageText)) {
        // Adjust column names below if your tblmessages database uses sender_id / receiver_id
        $insert_stmt = $conn->prepare("INSERT INTO tblmessages (senderID, receiverID, productID, messageText) VALUES (?, ?, ?, ?)");
        if (!$insert_stmt) {
            die("Message Send Preparation Failed: " . $conn->error);
        }
        $insert_stmt->bind_param("iiis", $senderID, $receiverID, $productID, $messageText);
        $insert_stmt->execute();
        
        // Refresh page to show newly sent message without form re-submission prompts
        header("Location: chat.php?product_id=$productID&receiver_id=$receiverID");
        exit();
    }
}

// 5. Query: Gather historical logs matching this isolated thread block
// Adjust column names if they are named differently inside your local phpMyAdmin database table
$query = "SELECT * FROM tblmessages 
          WHERE (senderID = ? AND receiverID = ? AND productID = ?) 
             OR (senderID = ? AND receiverID = ? AND productID = ?) 
          ORDER BY messageID ASC";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Database Conversation Query Failed: " . $conn->error);
}
$stmt->bind_param("iiiiii", $senderID, $receiverID, $productID, $receiverID, $senderID, $productID);
$stmt->execute();
$chatLogs = $stmt->get_result();

// Get context product details to display at the header card
$prod_stmt = $conn->prepare("SELECT productName, price FROM tblproducts WHERE productID = ?");
$prod_stmt->bind_param("i", $productID);
$prod_stmt->execute();
$productDetails = $prod_stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat - Pastimes</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .chat-layout {
            max-width: 700px;
            margin: 30px auto;
            border: 1px solid #eee;
            border-radius: 14px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .chat-header {
            background: #f5f5f5;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }
        .chat-header h3 { margin: 0; font-size: 18px; color: #333; }
        .chat-header p { margin: 3px 0 0; color: #e60023; font-weight: bold; font-size: 14px; }
        .message-stream {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background: #fafafa;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .msg-bubble {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.4;
        }
        .msg-bubble.sent {
            background: #e60023;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 2px;
        }
        .msg-bubble.received {
            background: #dcdcdc;
            color: #222;
            align-self: flex-start;
            border-bottom-left-radius: 2px;
        }
        .chat-input-area {
            padding: 15px 20px;
            background: white;
            border-top: 1px solid #eee;
        }
        .chat-form {
            display: flex;
            gap: 10px;
            flex-direction: row !important; /* Forces row alignment over global CSS column rule */
        }
        .chat-form input[type="text"] {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f5f5f5;
            margin-bottom: 0 !important;
        }
        .chat-form button {
            padding: 0 24px;
            white-space: nowrap;
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
    </nav> 
</header>

<div class="chat-layout">
    <div class="chat-header">
        <h3>Discussing: <?= htmlspecialchars($productDetails['productName'] ?? 'Item Listing') ?></h3>
        <p><?= isset($productDetails['price']) ? 'R' . number_format($productDetails['price'], 2) : '' ?></p>
    </div>

    <div class="message-stream">
        <?php while ($msg = $chatLogs->fetch_assoc()): ?>
            <?php $isSent = ($msg['senderID'] == $senderID); ?>
            <div class="msg-bubble <?= $isSent ? 'sent' : 'received' ?>">
                <?= htmlspecialchars($msg['messageText']) ?>
            </div>
        <?php endwhile; ?>

        <?php if ($chatLogs->num_rows === 0): ?>
            <div style="text-align: center; color: #888; margin: auto; font-size: 14px;">
                No messages yet. Send an inquiry below to start your conversation thread!
            </div>
        <?php endif; ?>
    </div>

    <div class="chat-input-area">
        <form class="chat-form" method="POST">
            <input type="text" name="message_text" placeholder="Type your message here..." required autocomplete="off">
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<div style="text-align: center; margin-bottom: 40px;">
    <a href="messages.php" style="color: #666; text-decoration: none; font-size: 14px;">← Return to Inbox</a>
</div>

</body>
</html>