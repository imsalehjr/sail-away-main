
<main>
        <section class="">
            <h2>Klant Verwijderen</h2>
            <p></p>
        </section>
        <!-- Bevestigingsbericht bij succesvolle verwijdering -->
        <?php if ($klantVerwijderd): ?>
            <p class="feedback success">Klant is succesvol verwijderd.</p>
        <?php endif; ?>

        <!-- Formulier om een klant te selecteren voor verwijdering -->
        <form action="klantverwijderen.php" method="POST" class="boot-form">
            <label for="klantID">Selecteer een klant om te verwijderen:</label>
            <select name="klantID" id="klantID" required>
                <option value="">-- Kies een klant --</option>
                <?php foreach ($klanten as $klant): ?>
                    <option value="<?php echo $klant['klantID']; ?>"><?php echo htmlspecialchars($klant['klantNaam']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="delete" class="cta-button">Verwijderen</button>
        </form>
    </main>
