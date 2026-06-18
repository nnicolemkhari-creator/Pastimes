<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

if (!isset($_SESSION['admin'])) { 
    header("Location: admin_login.php"); 
    exit(); 
}

if (isset($_GET['approve_id'])) {
    $uID = (int)$_GET['approve_id'];
    $stmt = $conn->prepare("UPDATE tbluser SET accountStatus='Approved' WHERE userID=?");
    $stmt->bind_param("i", $uID);
    $stmt->execute();
    header("Location: admin_approve_users.php");
    exit();
}

if (isset($_GET['reject_id'])) {
    $uID = (int)$_GET['reject_id'];
    $stmt = $conn->prepare("UPDATE tbluser SET accountStatus='Rejected' WHERE userID=?");
    $stmt->bind_param("i", $uID);
    $stmt->execute();
    header("Location: admin_approve_users.php");
    exit();
}

$query = "SELECT userID, fullName, email FROM tbluser WHERE accountStatus='Pending'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pending Users</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="navbar"> 
    <div class="logo">P</div> 
    <h2 class="brand">Pastimes Panel</h2> 
    <nav> 
        <a href="admin_panel.php">Dashboard</a> 
        <a href="admin_products.php">Manage Listings</a> 
    </nav> 
</header>

<div class="admin-container">
    <h1>Pending Registrations</h1>
    <p class="subtitle">Review and authorize new user accounts</p>

    <table class="custom-table">
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Action</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['userID'] ?></td>
            <td><?= htmlspecialchars($row['fullName']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <a href="admin_approve_users.php?approve_id=<?= $row['userID'] ?>" class="verify-btn">Verify User</a>
            </td>
        </tr>
        <?php } ?>
        <?php if ($result->num_rows === 0): ?>
        <tr>
            <td colspan="4" style="text-align: center; color: #666; padding: 20px;">No pending registration accounts waiting for approval.</td>
        </tr>
        <?php endif; ?>
    </table>
    
    <div class="bottom-link" style="margin-top: 30px;">
        <a href="admin_panel.php">← Back to Dashboard Overview</a>
    </div>
</div>

</body>
</html>