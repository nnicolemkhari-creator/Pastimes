<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

// User must be logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sellerID = $_SESSION['user']['userID'];

    $productName = trim($_POST['productName']);
    $brand = trim($_POST['brand']);
    $category = trim($_POST['category']);
    $condition = trim($_POST['condition']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];

    // Image upload
    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFolder = "images/uploaded/";
    $targetFile = $targetFolder . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

        $stmt = $conn->prepare("
            INSERT INTO tblProducts
            (sellerID, productName, brand, category, productDescription, productCondition, price, image, status)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')
        ");

        $stmt->bind_param(
            "isssssds",
            $sellerID,
            $productName,
            $brand,
            $category,
            $description,
            $condition,
            $price,
            $imageName
        );

        if ($stmt->execute()) {

            echo "<h2>Listing submitted successfully!</h2>";
            echo "<p>Your item is awaiting admin approval.</p>";
            echo "<a href='index.php'>Return Home</a>";

        } else {

            echo "Database Error: " . $conn->error;

        }

    } else {

        echo "Image upload failed.";

    }

}
?>