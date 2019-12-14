<?php
$serverName = "localhost";
$userName = 'root';
$password = "";
$dbname = "nomadcg";

$conn = new mysqli($serverName, $userName, $password, $dbname);
if ($conn->connect_error){
    console.log("Connection failed: " . $conn->connection_error);
    return null;
}else {
    return $conn;
}
?>