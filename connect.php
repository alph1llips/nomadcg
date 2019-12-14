<?php
$serverName = "localhost";
$userName = 'root';
$password = "";
$dbname = "nomadcg";

$conn = new mysqli($serverName, $userName, $password, $dbname);
if ($conn->connect_error){
    console.log("Connection failed: " . $conn->connection_error);
echo('Oh No, I fucked up');
    return null;
}else {
echo('We got us a connection');
    return $conn;
}
?>