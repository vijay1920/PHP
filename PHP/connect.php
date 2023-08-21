<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vmtex'; // Replace with your actual database name

// Create a new connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";

?>