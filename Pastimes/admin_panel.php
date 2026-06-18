<?php
session_start();
include 'DBConn.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM tblUser WHERE userID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

/* ADD */
if (isset($_POST['add_user'])) {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tblUser (fullName,email,password,role,isVerified) VALUES (?,?,?,'user',1)");
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
}

/* UPDATE */
if (isset($_POST['update_user'])) {
    $id = $_POST['userID'];
    $name = $_POST['fullName'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE tblUser SET fullName=?, email=? WHERE userID=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
}

/* EDIT FETCH */
$editUser = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM tblUser WHERE userID=$id");
    $editUser = $result->fetch_assoc();
}

// Update this query so you don't show users who are still 'Pending' in your active user list
$users = $conn->query("SELECT * FROM tblUser WHERE role='user' AND accountStatus='Approved'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

<h1>Admin Panel</h1>

<p>
    <a href="admin_products.php">
        <button>Manage Listings</button>
    </a>
    
    <a href="admin_approve_users.php">
        <button style="background-color: #007bff; color: white; cursor: pointer;">
            View Pending Registrations
        </button>
    </a>
</p>

<form method="POST">
    <input type="hidden" name="userID" value="<?= $editUser['userID'] ?? '' ?>">

    <input type="text" name="fullName" placeholder="Full Name" value="<?= $editUser['fullName'] ?? '' ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?= $editUser['email'] ?? '' ?>" required>

    <?php if (!$editUser): ?>
        <input type="password" name="password" placeholder="Password" required>
    <?php endif; ?>

    <button type="submit" name="<?= $editUser ? 'update_user' : 'add_user' ?>">
        <?= $editUser ? 'Update User' : 'Add User' ?>
    </button>
</form>

<hr>

<h3>Active Marketplace Users</h3>
<table border="1" cellpadding="5" style="border-collapse: collapse; width: 50%;">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Actions</th>
</tr>

<?php while($u = $users->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($u['fullName']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td>
        <a href="?edit=<?= $u['userID'] ?>">Edit</a> | 
        <a href="?delete=<?= $u['userID'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>