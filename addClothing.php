<!DOCTYPE html>
<html>
<head>
    <title>Add Clothing</title>
</head>
<body>

<h1>Add Clothing Item</h1>

<form action="saveClothing.php" method="POST" enctype="multipart/form-data">

    Brand:<br>
    <input type="text" name="brand"><br><br>

    Description:<br>
    <textarea name="description"></textarea><br><br>

    Price:<br>
    <input type="number" name="price"><br><br>

    Image:<br>
    <input type="file" name="image"><br><br>

    <input type="submit" value="Add Clothing">

</form>

</body>
</html>