<?php

// Connect to the database
$servername = "localhost";
$username = "root";  // Change this if necessary
$password = "";      // Change this if necessary
$dbname = "jual_beli";

$conn = mysqli_connect("", $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}