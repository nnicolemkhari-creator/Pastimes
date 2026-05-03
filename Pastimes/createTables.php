<?php
include 'DBConn.php';

$conn->query("DELETE FROM tblUser");

$lines = file("userData.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    list($fullName, $email, $username, $password) = explode(",", $line);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tblUser (fullName, email, username, password, isVerified)
            VALUES ('$fullName', '$email', '$username', '$hashedPassword', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Inserted: $fullName <br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

$conn->close();
?>