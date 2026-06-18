<?php

include 'DBConn.php';

$id = $_GET['id'];

$sql = "SELECT * FROM tbluser WHERE userID=$id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<form action="updateUser.php" method="POST">

<input type="hidden"
name="id"
value="<?php echo $row['userID']; ?>">

Full Name:<br>
<input type="text"
name="fullName"
value="<?php echo $row['fullName']; ?>">
<br><br>

Email:<br>
<input type="email"
name="email"
value="<?php echo $row['email']; ?>">
<br><br>

Approved:<br>
<input type="number"
name="approved"
value="<?php echo $row['approved']; ?>">
<br><br>

<input type="submit"
value="Update User">

</form>

</body>
</html>