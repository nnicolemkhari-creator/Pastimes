<?php
include 'DBConn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = trim($_POST["fullName"]);
    $username = trim($_POST["username"]);
    $email    = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if (!$email) {
        $message = "Invalid email format.";
    } else {
        // THIS IS THE HASH STEP
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Check if email exists
        $check = $conn->prepare("SELECT userID FROM tblUser WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Email already registered.";
        } else {
            // ✅ MAKE SURE TO USE $hash HERE
            $stmt = $conn->prepare("INSERT INTO tblUser (fullName, username, email, password, role, isVerified) VALUES (?, ?, ?, ?, 'user', 0)");
            $stmt->bind_param("ssss", $fullName, $username, $email, $hash); // <--- HASH used, not plain password

            if ($stmt->execute()) {
                $message = "Registration successful! Awaiting admin approval.";
            } else {
                $message = "Something went wrong. Try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Create Account</h1>
    <p><?= $message ?></p>

    <form method="POST">
        <input type="text" name="fullName" placeholder="Full Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
    </form>

    <a href="login.php">Already have an account?</a>
</div>

</body>
</html>