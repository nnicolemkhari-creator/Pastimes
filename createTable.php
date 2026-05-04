<?php
include("DBConn.php");

/* Delete old table */
$sql = "DROP TABLE IF EXISTS tblUser";
mysqli_query($conn, $sql);

/* Create new table */
$sql = "CREATE TABLE tblUser (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255),
    approved VARCHAR(10) DEFAULT 'No'
)";

if (mysqli_query($conn, $sql)) {
    echo "Table tblUser created successfully.<br>";
} else {
    die("Error creating table: " . mysqli_error($conn));
}

/* Open text file */
$file = fopen("userData.txt", "r");

if ($file) {
    while (($line = fgets($file)) !== false) {
        $data = explode(",", trim($line));

        $fullName = $data[0];
        $email = $data[1];
        $password = md5($data[2]);

        $insert = "INSERT INTO tblUser (fullName, email, password)
                   VALUES ('$fullName', '$email', '$password')";

        mysqli_query($conn, $insert);
    }

    fclose($file);
    echo "Users loaded successfully!";
} else {
    echo "Could not open userData.txt";
}

mysqli_close($conn);
?>