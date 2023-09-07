<?php

$hostname = "localhost";
$database = "HR_API";
$username = "root";
$password = "";

$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("Connection error" . mysqli_connect_error());
}

?>