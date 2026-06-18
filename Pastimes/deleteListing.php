<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

if (!isset($_SESSION['user'])) {
    die("You must be logged in.");
}

if (!isset($_GET['id'])) {
    die("No product ID received.");
}

$productID = (int)$_GET['id'];
$sellerID = (int)$_SESSION['user']['userID'];

// Verify the product belongs to the logged-in user
$stmt = $conn->prepare("DELETE FROM tblProducts WHERE productID = ? AND sellerID = ?");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ii", $productID, $sellerID);

if (!$stmt->execute()) {
    die("Delete failed: " . $stmt->error);
}

if ($stmt->affected_rows == 0) {
    die("No product was deleted. Either the product doesn't exist or it doesn't belong to you.");
}

header("Location: myListings.php");
exit();
?>