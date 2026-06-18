<?php

include 'DBConn.php';

$id = $_GET['id'];

$sql = "DELETE FROM tblClothes
WHERE clothingID=$id";

if($conn->query($sql))
{
    echo "Clothing Deleted Successfully!";
}
else
{
    echo "Error: " . $conn->error;
}

?>