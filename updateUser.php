<?php

include 'DBConn.php';

$id = $_POST['id'];
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$approved = $_POST['approved'];

$sql = "UPDATE tbluser
SET
fullName='$fullName',
email='$email',
approved='$approved'
WHERE userID=$id";

if($conn->query($sql))
{
    echo "User Updated Successfully!";
}
else
{
    echo "Error: " . $conn->error;
}

?>