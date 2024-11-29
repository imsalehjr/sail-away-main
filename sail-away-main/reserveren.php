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

// Ophalen van bootgegevens, inclusief locatie
$sql = "SELECT boot.bootID, boot.bootNaam, boot.merk, boot.capaciteit, boot.bouwjaar, boot.lengte, 
               boot.bootBeschrijving, boottype.typeBeschrijving, locatie.locatieNaam, locatie.adres, boot.prijs
        FROM boot
        INNER JOIN boottype ON boot.bootTypeID = boottype.bootTypeID
        INNER JOIN locatie ON boot.locatieID = locatie.locatieID";
$stmt = $pdo->query($sql);
$boten = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Associatie tussen bootID en afbeeldingen
$bootAfbeeldingen = [
    1 => 'SeaBreeze.png',
    2 => 'OceanExplorer.png',
    3 => 'AquaSerenity.png',
    4 => 'BlueHorizon.png',
    5 => 'SunsetVoyager.png',
    6 => 'RiverRunner.png',
    7 => 'CoralCruiser.png',
    8 => 'GoldenWave.png',
    9 => 'IslandEscape.png',
    10 => 'StormRider.png',
    11 => 'CoastalDreamer.png',
    12 => 'ArcticAdventurer.png',
    13 => 'LagunaWhisper.png',
    14 => 'VoyagerSupreme.png',
    15 => 'MarineMajesty.png',
];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boot Reservering</title>
    <link rel="stylesheet" href=".//style.css">

</head>

<header>
    <img class="logo" src="images/logo.png">
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="registreren.php">Registreren</a></li>
                <li><a href="inloggen.php">Inloggen</a></li>
                <li><a href="reserveren.php">Reserveren</a></li>
                <li><a href="Menu.php">Beheer</a></li>
            </ul>
        </nav>
    </header>
<body class="reservation-body">
<header class="reservation-header">
    <h1 class="reservation-header-title">SailAway Boot Reservering</h1>
</header>
<main>
    <div class="reservation-content-container">
        <?php foreach ($boten as $boot): ?>
            <div class="reservation-card">
                <img class="reservation-card-image" src="afbeelding/<?= htmlspecialchars($bootAfbeeldingen[$boot['bootID']] ?? 'placeholder.png') ?>" alt="Afbeelding van <?= htmlspecialchars($boot['bootNaam']) ?>">
                <div class="reservation-card-body">
                    <h3 class="reservation-card-title"><?= htmlspecialchars($boot['bootNaam']) ?></h3>
                    <p class="reservation-card-text"><strong>Merk:</strong> <?= htmlspecialchars($boot['merk']) ?></p>
                    <p class="reservation-card-text"><strong>Capaciteit:</strong> <?= htmlspecialchars($boot['capaciteit']) ?> personen</p>
                    <p class="reservation-card-text"><strong>Bouwjaar:</strong> <?= htmlspecialchars($boot['bouwjaar']) ?></p>
                    <p class="reservation-card-text"><strong>Lengte:</strong> <?= htmlspecialchars($boot['lengte']) ?> meter</p>
                    <p class="reservation-card-text"><?= htmlspecialchars($boot['bootBeschrijving']) ?></p>
                    <p class="reservation-card-text"><strong>Type:</strong> <?= htmlspecialchars($boot['typeBeschrijving']) ?></p>
                    <p class="reservation-card-text"><strong>Locatie:</strong> <?= htmlspecialchars($boot['locatieNaam']) ?>, <?= htmlspecialchars($boot['adres']) ?></p>
                    <p class="reservation-card-text"><strong>Prijs:</strong> €<?= number_format($boot['prijs'], 2, ',', '.') ?></p>
                </div>
                <div class="reservation-card-footer">
                     <a class="reservation-card-link" href="data.tijden.php?bootID=<?= $boot['bootID'] ?>">Reserveren</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<footer>
    <p style="text-align:center; background-color:#0077b6; color:white; padding:10px 0;">&copy; 2024 SailAway. Alle rechten voorbehouden.</p>
</footer>
</body>
</html>
