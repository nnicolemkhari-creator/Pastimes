<?php
  include 'DBConn.php';

  $message = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["fullName"];  
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tbluser (fullName, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullName, $username, $email, $password);

    if ($stmt->execute()) {
      $message = "Registration successful! Pending verification approval from admin.";
    } else {
      $message = "Error: User may already exist.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastimes Login</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container clearfix">
    <div class="logo">Pastimes</div>

    <h1>Create Account</h1>
    <p class="subtitle">Join the marketplace and start buying or selling today</p>

    <div class="form-section">
        <form method="POST">
            <label>Full Name:</label>
            <input type="text" name="fullName" placeholder="Insert fullname" required>
    
            <label>Username:</label>
            <input type="text" name="username" placeholder="create username" required>

            <label>Email Address:</label>
            <input type="email" name="email" placeholder="Enter your Email" required>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Create your Password" required>

            <button type="submit">Create Account</button>
        </form>

        <div class="bottom-link">
            Already have an Account? <a href="login.php">Log in</a>
        </div>
    </div>

    <div class="images">
        <img src="img/jacket.jpg">
        <img src="img/model.jpg">
        <img src="img/bag.jpg">
    </div>
</div>
</body>
</html>
