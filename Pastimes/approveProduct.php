<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

if (!isset($_SESSION['admin'])) {
    die("You are not logged in as an admin.");
}

if (!isset($_GET['id'])) {
    die("No product ID received.");
}

$id = (int)$_GET['id'];

echo "Product ID received: " . $id . "<br>";

$stmt = $conn->prepare("UPDATE tblProducts SET status='Approved' WHERE productID=?");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Update successful!<br>";
    echo "Rows affected: " . $stmt->affected_rows;
} else {
    echo "Execute failed: " . $stmt->error;
}
?>