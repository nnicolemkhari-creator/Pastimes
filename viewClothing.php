<?php
include 'DBConn.php';

$sql = "SELECT * FROM tblClothes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Clothing</title>
</head>
<body>

<h1>Clothing Management</h1>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Brand</th>
    <th>Description</th>
    <th>Price</th>
    <th>Image</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php
while($row = $result->fetch_assoc())
{
    echo "<tr>";

    echo "<td>".$row['clothingID']."</td>";
    echo "<td>".$row['brand']."</td>";
    echo "<td>".$row['description']."</td>";
    echo "<td>R".$row['price']."</td>";

    echo "<td>
            <img src='images/".$row['image']."'
            width='100'>
          </td>";

    echo "<td>".$row['status']."</td>";

    echo "<td>
            <a href='editClothing.php?id=".$row['clothingID']."'>Edit</a>
            |
            <a href='deleteClothing.php?id=".$row['clothingID']."'>Delete</a>
          </td>";

    echo "</tr>";
}
?>

</table>

</body>
</html>