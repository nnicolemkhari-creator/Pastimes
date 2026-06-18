<?php
include 'DBConn.php';

$sql = "SELECT * FROM tbluser";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Users</title>
</head>
<body>

<h1>User Management</h1>

<a href="addUser.php">Add New User</a>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Approved</th>
    <th>Actions</th>
</tr>

<?php

while($row = $result->fetch_assoc())
{
    echo "<tr>";

    echo "<td>".$row['userID']."</td>";
    echo "<td>".$row['fullName']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['approved']."</td>";

    echo "<td>
            <a href='editUser.php?id=".$row['userID']."'>Edit</a>
            |
            <a href='deleteUser.php?id=".$row['userID']."'>Delete</a>
          </td>";

    echo "</tr>";
}

?>

</table>

</body>
</html>