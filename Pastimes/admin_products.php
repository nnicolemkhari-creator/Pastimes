<?php
session_start();
include 'DBConn.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$result = $conn->query("
SELECT p.*, u.fullName
FROM tblproducts p
JOIN tblUser u
ON p.sellerID = u.userID
WHERE p.status='Pending'
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Pending Listings</title>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<h1>Pending Listings</h1>

<table border="1" cellpadding="10">

<tr>

<th>Image</th>

<th>Product</th>

<th>Brand</th>

<th>Seller</th>

<th>Price</th>

<th>Action</th>

</tr>

<?php

while($row = $result->fetch_assoc())
{

?>

<tr>

<td>

<img
src="images/uploaded/<?=$row['image']?>"
width="120">

</td>

<td><?=$row['productName']?></td>

<td><?=$row['brand']?></td>

<td><?=$row['fullName']?></td>

<td>R<?=$row['price']?></td>

<td>

<a href="approveProduct.php?id=<?=$row['productID']?>">

<button>Approve</button>

</a>

<br><br>

<a href="rejectProduct.php?id=<?=$row['productID']?>">

<button>Reject</button>

</a>

</td>

</tr>

<?php

}

?>

</table>

</body>

</html>