<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "decentdonutdb";

$conn = new mysqli($serverName, $userName, $password, $dbname);

if ($conn->connect_error){
    die("The connection has failed: " . $conn->connect_error);
}

?>