<main>
    <?php if ($klantToegevoegd): ?>
        <p class="success-message">Klant succesvol toegevoegd!</p>
    <?php endif; ?>

    <form action="klantToevoegen.php" method="POST" class="boot-form">
        <input type="text" name="klantNaam" placeholder="Naam" 
               pattern="[a-zA-Z\s]+" title="Gebruik alleen letters en spaties" required>
        <input type="email" name="emailAdres" placeholder="E-mailadres" required>
        <input type="tel" name="telefoonNummer" placeholder="Telefoonnummer" 
               pattern="[0-9]+" title="Gebruik alleen cijfers" required>
        <input type="text" name="straatHuisnummer" placeholder="Straat + Huisnummer" required>
        <input type="text" name="postcode" placeholder="Postcode" required>
        <input type="text" name="regio" placeholder="Regio" 
               pattern="[a-zA-Z\s]+" title="Gebruik alleen letters en spaties" required>
        <button type="submit" name="save" class="cta-button">Klant Toevoegen</button>
    </form>
</main>
