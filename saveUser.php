<?php

include 'DBConn.php';

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO tbluser
(fullName, email, password, approved)

VALUES

('$fullName', '$email', '$password', 0)";

if($conn->query($sql))
{
    echo "User Added Successfully!";
}
else
{
    echo "Error: " . $conn->error;
}

?>