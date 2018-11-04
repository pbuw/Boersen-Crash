<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "bc";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>