<?php
// Create a connection using MySQLli
$servername = "localhost";
$username = "root"; 
$password = "MEx1233roses._"; 
$dbname = "smartlib"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
