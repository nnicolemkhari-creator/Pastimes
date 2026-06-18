<?php

include 'DBConn.php';

$id = $_POST['id'];
$brand = $_POST['brand'];
$description = $_POST['description'];
$price = $_POST['price'];

$sql = "UPDATE tblClothes
SET
brand='$brand',
description='$description',
price='$price'
WHERE clothingID=$id";

if($conn->query($sql))
{
    echo "Clothing Updated Successfully!";
}
else
{
    echo "Error: " . $conn->error;
}

?>