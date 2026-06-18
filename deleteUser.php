<?php

include 'DBConn.php';

$id = $_GET['id'];

$sql = "DELETE FROM tbluser
WHERE userID=$id";

if($conn->query($sql))
{
    echo "User Deleted Successfully!";
}
else
{
    echo "Error: " . $conn->error;
}

?>