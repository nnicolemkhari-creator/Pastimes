<?php
include 'DBConn.php';
session_start();

$error = "";
$email = $_POST['email'] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM tbluser WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($user['accountStatus'] !== 'Approved') {
            $error = "Your account is pending admin verification.";
        } elseif (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="red-theme">

<div class="container">
    <div class="logo">P</div>
    <h1 style="margin-top: 15px;">Welcome Back</h1>
    <p class="subtitle">Log in to your account to continue shopping</p>
    
    <?php if (!empty($error)): ?>
        <p style="color: #e60023; font-weight: bold; margin-bottom: 15px;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your Email" value="<?= htmlspecialchars($email) ?>" required>
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your Password" required>
        
        <button type="submit">Sign In</button>
    </form>

    <div class="bottom-link">
        Don't have an Account? <a href="register.php">Sign up for free</a>
    </div>
</div>

</body>
</html>