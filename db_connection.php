<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upwork_campus_connect";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
