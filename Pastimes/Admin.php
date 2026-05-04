<?php
include 'DBConn.php';

if (isset($_GET['verify'])) {
    $id = $_GET['verify'];
    // It's a good idea to use prepared statements here for security!
    $conn->query("UPDATE tblUser SET isVerified=1 WHERE userID=$id");
}

$users = $conn->query("SELECT * FROM tblUser WHERE isVerified=0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastimes - Verify Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container admin-container">
    <div class="logo">Pastimes</div>

    <h1>Pending Users</h1>
    <p class="subtitle">Review and authorize new member accounts</p>

    <div class="table-section">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($u = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($u['fullName']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <a href="?verify=<?= $u['userID'] ?>" class="verify-btn">Verify</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="bottom-link">
        <a href="login.php">Back to Login</a>
    </div>
</div>
</body>
</html>