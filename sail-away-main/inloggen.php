<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ingevoerde_gebruikersnaam = $_POST['gebruikersnaam'];
    $ingevoerde_wachtwoord = $_POST['wachtwoord'];

    // Controleer gebruikersnaam en wachtwoord in de database
    $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $ingevoerde_gebruikersnaam);
    $stmt->execute();

    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gebruiker && password_verify($ingevoerde_wachtwoord, $gebruiker['wachtwoord'])) {
        $_SESSION['gebruikersnaam'] = $ingevoerde_gebruikersnaam;
        header("Location: index.php");
        exit();
    } else {
        $foutmelding = "Onjuiste gebruikersnaam of wachtwoord.";
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pagina</title>
    <link rel="stylesheet" href="inloggenstyle.css"> <!-- Link naar de CSS-bestand -->
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
<!-- Container voor het inlogformulier -->
<div class="login-container">
    <h2>Login</h2>
    <!-- Login formulier -->
    <form method="POST" action="">
        <div class="input-div">
            <label for="gebruikersnaam">Gebruikersnaam:</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" required>
        </div>
        <div class="input-div">
            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>
        </div>
        <!-- Toon foutmelding indien van toepassing -->
        <?php if (isset($foutmelding)): ?>
            <div class="error-message"><?php echo $foutmelding; ?></div>
        <?php endif; ?>
        <div class="input-div">
            <button type="submit" class="login-btn">Inloggen</button>
        </div>
        <div class="geenaccount">Heeft u geen account? <a href="registreren.php">registreer dan hier!</a></div>

    </form>
</div>

</body>
</html>
