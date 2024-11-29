<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Adjust as needed
$password = ""; // Adjust as needed
$dbname = "sailaway"; // The database name from the uploaded file

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
