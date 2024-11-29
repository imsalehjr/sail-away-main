<main>
<?php if (isset($klant)): ?>
    <form action="klantWijzigen.php?id=<?= htmlspecialchars($klantID) ?>" method="POST">
        <label for="klantNaam">Klant Naam:</label>
        <input type="text" name="klantNaam" value="<?= htmlspecialchars($klant['klantNaam'] ?? '') ?>" required>

        <label for="emailAdres">Email Adres:</label>
        <input type="email" name="emailAdres" value="<?= htmlspecialchars($klant['emailAdres'] ?? '') ?>" required>

        <label for="telefoonNummer">Telefoon Nummer:</label>
        <input type="text" name="telefoonNummer" value="<?= htmlspecialchars($klant['telefoonNummer'] ?? '') ?>" required>

        <label for="straatHuisnummer">Straat en Huisnummer:</label>
        <input type="text" name="straatHuisnummer" value="<?= htmlspecialchars($klant['straatHuisnummer'] ?? '') ?>" required>

        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" value="<?= htmlspecialchars($klant['postcode'] ?? '') ?>" required>

        <label for="regio">Regio:</label>
        <input type="text" name="regio" value="<?= htmlspecialchars($klant['regio'] ?? '') ?>" required>

        <button type="submit" name="update">Wijzigen</button>
    </form>
<?php else: ?>
    <p>Geen klantgegevens gevonden. Controleer het klantID.</p>
<?php endif; ?>

    </main>