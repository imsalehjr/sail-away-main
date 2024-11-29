<?php
$servername = "localhost";  // Gebruik de juiste servernaam
$username = "root";         // Jouw databasegebruikersnaam
$password = "";             // Jouw databasewachtwoord
$dbname = "sailaway";       // De naam van jouw database

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
    exit();
}
?>
