<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE TABLE usermanagement (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL UNIQUE KEY,
ne VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL UNIQUE KEY,
password VARCHAR(255) NOT NULL,
profilepic VARCHAR(255) NOT NULL,
city VARCHAR(255) NOT NULL,
num BIGINT(10) UNSIGNED NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Table created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
