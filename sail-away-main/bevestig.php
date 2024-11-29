<?php
// Verbinding met de database
$host = 'localhost';
$dbname = 'sailaway';
$username = 'root'; // Pas aan met jouw gebruikersnaam
$password = ''; // Pas aan met jouw wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fout bij verbinden met database: " . $e->getMessage());
}

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ophalen van gegevens uit het formulier
    $datum = $_POST['datum'] ?? null;
    $tijd = $_POST['tijd'] ?? null;
    $bootID = $_GET['bootID'] ?? null;
    $klantNaam = "John Doe"; // Voorbeeldnaam van klant
    $status = 'In behandeling';

    // Valideer invoer
    if (!$datum || !$tijd || !$bootID) {
        die("Vul alle verplichte velden in.");
    }

    // Ophalen van bootgegevens en locatie
    $sql = "SELECT boot.bootNaam, locatie.locatieNaam, locatie.adres 
            FROM boot 
            INNER JOIN locatie ON boot.locatieID = locatie.locatieID
            WHERE boot.bootID = :bootID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['bootID' => $bootID]);
    $boot = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$boot) {
        die("Boot niet gevonden.");
    }

    // Samenvoegen reserveringsdatum en tijd
    $reserveringsDatum = $datum . ' ' . $tijd;

    // Opslaan in de database
    $insertQuery = "INSERT INTO reserveren (klantID, bootID, locatieID, reserveringsDatum, reserveringsStatus)
                    VALUES (1, :bootID, :locatieID, :reserveringsDatum, :status)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([
        'bootID' => $bootID,
        'locatieID' => $boot['locatieNaam'],
        'reserveringsDatum' => $reserveringsDatum,
        'status' => $status
    ]);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bevestiging Reservering</title>
    <link rel="stylesheet" href=".//style.css">

</head>
<body class="confirmation-page">
    <div class="confirmation-container">
        <h1 class="confirmation-header">Bevestiging Reservering</h1>
        <p class="confirmation-text">Bedankt voor uw reservering, <strong><?= htmlspecialchars($klantNaam) ?></strong>! Hieronder vindt u de details van uw reservering:</p>
        
        <div class="confirmation-details">
            <p><strong>Boot:</strong> <?= htmlspecialchars($boot['bootNaam']) ?></p>
            <p><strong>Locatie:</strong> <?= htmlspecialchars($boot['locatieNaam']) ?>, <?= htmlspecialchars($boot['adres']) ?></p>
            <p><strong>Datum:</strong> <?= htmlspecialchars($datum) ?></p>
            <p><strong>Tijd:</strong> <?= htmlspecialchars($tijd) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($status) ?></p>
        </div>

        <div class="confirmation-button-container">
            <a href="reserveren.php">Terug naar reserveringspagina</a>
        </div>
    </div>
</body>
</html>
