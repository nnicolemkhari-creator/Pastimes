<?php

include 'DBConn.php';

$id = $_GET['id'];

$sql = "SELECT * FROM tblClothes WHERE clothingID=$id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Clothing</title>
</head>
<body>

<h1>Edit Clothing</h1>

<form action="updateClothing.php" method="POST">

<input type="hidden"
name="id"
value="<?php echo $row['clothingID']; ?>">

Brand:<br>
<input type="text"
name="brand"
value="<?php echo $row['brand']; ?>">
<br><br>

Description:<br>
<textarea name="description"><?php echo $row['description']; ?></textarea>
<br><br>

Price:<br>
<input type="text"
name="price"
value="<?php echo $row['price']; ?>">
<br><br>

<input type="submit"
value="Update Clothing">

</form>

</body>
</html>