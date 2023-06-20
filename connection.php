<?php
// File connection
// Host name = localhost
// SQL username = root
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lycoshop';

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
