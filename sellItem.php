<!DOCTYPE html>
<html>
<head>
    <title>Sell Item</title>
</head>
<body>

<h1>Sell Your Clothing Item</h1>

<form action="saveSellerRequest.php" method="POST" enctype="multipart/form-data">

    <label>Brand:</label><br>
    <input type="text" name="brand"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price"><br><br>

    <label>Upload Image:</label><br>
    <input type="file" name="image"><br><br>

    <input type="submit" value="Submit Request">

</form>

</body>
</html>