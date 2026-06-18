<?php

include 'DBConn.php';

$brand = $_POST['brand'];
$description = $_POST['description'];
$price = $_POST['price'];

$imageName = $_FILES['image']['name'];
$tempName = $_FILES['image']['tmp_name'];

move_uploaded_file($tempName, "images/".$imageName);

$sql = "INSERT INTO tblSellerRequest
(brand, description, price, image, status)
VALUES
('$brand', '$description', '$price', '$imageName', 'Pending')";

if($conn->query($sql) === TRUE)
{
    echo "Seller request submitted successfully!";
}
else
{
    echo "Error: " . $conn->error;
}

$conn->close();

?>