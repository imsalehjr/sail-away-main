<?php
session_start();
require 'db_connect.php';

$foutmelding = "";
$succesmelding = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
    $wachtwoord_bevestiging = $_POST['wachtwoord_bevestiging'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];

    // Validatie van de invoer
    if (empty($gebruikersnaam) || empty($wachtwoord) || empty($wachtwoord_bevestiging) || empty($email) || empty($voornaam) || empty($achternaam)) {
        $foutmelding = "Alle velden zijn verplicht.";
    } elseif ($wachtwoord !== $wachtwoord_bevestiging) {
        $foutmelding = "De wachtwoorden komen niet overeen.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $foutmelding = "Ongeldig e-mailadres.";
    } else {
        // Wachtwoord beveiligen
        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $default_level = 1; // Standaard niveau voor nieuwe registraties

        // Gebruiker toevoegen aan de database met alle velden
        $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, email, telefoonnummer, voornaam, achternaam, level) 
                VALUES (:gebruikersnaam, :wachtwoord, :email, :telefoonnummer, :voornaam, :achternaam, :level)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->bindParam(':wachtwoord', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefoonnummer', $telefoonnummer);
        $stmt->bindParam(':voornaam', $voornaam);
        $stmt->bindParam(':achternaam', $achternaam);
        $stmt->bindParam(':level', $default_level);

        if ($stmt->execute()) {
            $succesmelding = "Registratie succesvol! U kunt nu <a href='inloggen.php'>inloggen</a>.";
        } else {
            $foutmelding = "Er is iets misgegaan, probeer het opnieuw.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="inloggenstyle.css">
</head>
<body>
<header>
    <div class="logo">
        <h1>Sail Away</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="inloggen.php">Inloggen</a></li>
        </ul>
    </nav>
</header>
<div class="register-container">
    <h2>Registreren</h2>
    <form method="POST" action="">
        <div class="input-div">
            <label for="gebruikersnaam">Gebruikersnaam:</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" required>
        </div>
        <div class="input-div">
            <label for="voornaam">Voornaam:</label>
            <input type="text" id="voornaam" name="voornaam" required>
        </div>
        <div class="input-div">
            <label for="achternaam">Achternaam:</label>
            <input type="text" id="achternaam" name="achternaam" required>
        </div>
        <div class="input-div">
            <label for="email">Email-adres:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-div">
            <label for="telefoonnummer">Telefoonnummer:</label>
            <input type="tel" id="telefoonnummer" name="telefoonnummer">
        </div>
        <div class="input-div">
            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>
        </div>
        <div class="input-div">
            <label for="wachtwoord_bevestiging">Bevestig Wachtwoord:</label>
            <input type="password" id="wachtwoord_bevestiging" name="wachtwoord_bevestiging" required>
        </div>
        
        <?php if (!empty($foutmelding)): ?>
            <div class="error-message"><?php echo $foutmelding; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($succesmelding)): ?>
            <div class="success-message"><?php echo $succesmelding; ?></div>
        <?php endif; ?>

        <div class="input-div">
            <button type="submit" class="register-btn">Registreren</button>
        </div>
        <div class="alaccount">Heeft u al een account? <a href="inloggen.php">Log dan hier in!</a></div>
    </form>
</div>

</body>
</html>
