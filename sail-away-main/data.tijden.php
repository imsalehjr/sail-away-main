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

// Ophalen van de bootgegevens
$bootID = $_GET['bootID'] ?? null;
if (!$bootID) {
    die("Geen boot geselecteerd.");
}

$sql = "SELECT boot.bootNaam, boot.prijs, locatie.locatieNaam, locatie.adres
        FROM boot
        INNER JOIN locatie ON boot.locatieID = locatie.locatieID
        WHERE boot.bootID = :bootID";
$stmt = $pdo->prepare($sql);
$stmt->execute(['bootID' => $bootID]);
$boot = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$boot) {
    die("Boot niet gevonden.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data en Tijden</title>
    <link rel="stylesheet" href=".//style.css">
    <style>

    </style>
</head>
<body class="time-selection-page">
    <div class="time-selection-container">
        <h1 class="time-selection-header">Reserveren: <?= htmlspecialchars($boot['bootNaam']) ?></h1>
        <p class="time-selection-text"><strong>Prijs:</strong> €<?= number_format($boot['prijs'], 2, ',', '.') ?> per persoon</p>
        <p class="time-selection-text"><strong>Locatie:</strong> <?= htmlspecialchars($boot['locatieNaam']) ?>, <?= htmlspecialchars($boot['adres']) ?></p>
        
        <form method="post" action="bevestig.php?bootID=<?= htmlspecialchars($bootID) ?>" class="time-selection-form">
            <label for="datum">Kies een datum:</label>
            <input type="date" id="datum" name="datum" required>

            <label for="tijd">Kies een tijd:</label>
            <input type="time" id="tijd" name="tijd" required>

            <button type="submit">Verder</button>
        </form>
    </div>
</body>
</html>
