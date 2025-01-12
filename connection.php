<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mobile';

// Create a new mysqli connection
$mysqli = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Set the character set to UTF-8
mysqli_set_charset($mysqli, "utf8");
?>