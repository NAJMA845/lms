<?php
$host = 'localhost'; // Use '127.0.0.1' instead of 'localhost' for consistency with phpMyAdmin
$username = 'root';
$password = ''; // No password for root
$database = 'smartlib';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>