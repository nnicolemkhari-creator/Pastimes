<?php
session_start();
include 'DBConn.php';

$error = "";

if (isset($_SESSION['admin'])) {
    header("Location: admin_panel.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM tblUser WHERE email=? AND role='admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin;
            header("Location: admin_panel.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Not an admin account.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="red-theme">

<div class="container">
    <h1>Admin Login</h1>
    <p style="color:red;"><?php echo $error; ?></p>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login as Admin</button>
    </form>
</div>

</body>
</html>
