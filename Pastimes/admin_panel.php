<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'DBConn.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

/* ========== DELETE USER ========== */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM tbluser WHERE userID=$id");
}

/* ========== ADD USER ========== */
if (isset($_POST['add_user'])) {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tbluser (fullName,email,password,role,isVerified) VALUES (?,?,?,'user',1)");
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
}

/* ========== UPDATE USER ========== */
if (isset($_POST['update_user'])) {
    $id = $_POST['userID'];
    $name = $_POST['fullName'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE tbluser SET fullName=?, email=? WHERE userID=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();
}

/* ========== GET USER FOR EDIT FORM ========== */
$editUser = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM tbluser WHERE userID=$id");
    $editUser = $result->fetch_assoc();
}

/* ========== FETCH USERS ========== */
$users = $conn->query("SELECT * FROM tbluser WHERE role='user'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="admin-container">
    <h1>Customer Management</h1>

    <!-- ===== ADD / UPDATE FORM ===== -->
    <h2><?= $editUser ? "Update Customer" : "Add New Customer" ?></h2>

    <form method="POST">
        <input type="hidden" name="userID" value="<?= $editUser['userID'] ?? '' ?>">

        <label>Full Name</label>
        <input type="text" name="fullName" required
               value="<?= $editUser['fullName'] ?? '' ?>">

        <label>Email</label>
        <input type="email" name="email" required
               value="<?= $editUser['email'] ?? '' ?>">

        <?php if (!$editUser): ?>
            <label>Password</label>
            <input type="password" name="password" required>
        <?php endif; ?>

        <button type="submit" name="<?= $editUser ? 'update_user' : 'add_user' ?>">
            <?= $editUser ? 'Update Customer' : 'Add Customer' ?>
        </button>
    </form>

    <hr><br>

    <!-- ===== USERS TABLE ===== -->
    <table class="custom-table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php while($u = $users->fetch_assoc()): ?>
        <tr>
            <td><?= $u['fullName'] ?></td>
            <td><?= $u['email'] ?></td>
            <td>
                <a href="?edit=<?= $u['userID'] ?>" class="verify-btn">Edit</a>
                <a href="?delete=<?= $u['userID'] ?>" class="verify-btn">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>
