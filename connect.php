<?php
// session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "opepv2";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
