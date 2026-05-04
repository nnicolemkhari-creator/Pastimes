<?php
include 'DBConn.php';

session_start();

$error = "";
$username = $_POST['username'] ?? "";
$email    = $_POST['email'] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password = $_POST['password'];

        // Update the SQL to only check email
    $stmt = $conn->prepare("SELECT * FROM tblUser WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($user['isVerified'] == 0) {
            $error = "Your account is pending admin verification.";
        }
        elseif (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            // Redirect instead of printing data
            header("Location: index.php"); 
            exit();
        }
        else {
            $error = "Incorrect password.";
        }
        } else {
            $error = "User does not exist. Please register.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastimes Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container clearfix">
    <div class="logo">Pastimes</div>

    <h1>Welcome Back</h1>
    <p class="subtitle">Log in to your account to continue shopping</p>

    <p class="error"><?= $error ?></p>

    <div class="form-section">
        <form method="POST">
            <label>Email Address:</label>
            <input type="email" name="email" placeholder="Enter your Email"
                   value="<?= htmlspecialchars($email) ?>" required>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Create your Password" required>

            <button type="submit">Sign In</button>
        </form>

        <div class="bottom-link">
            Don't have an Account? <a href="register.php">Sign up for free</a>
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